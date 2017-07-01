<?php

namespace App\Http\Controllers;

use App\Tlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Tag;
use Carbon\Carbon;
use Image;
use App\Tcategory;

class TlistController extends Controller
{
    public $tagIds;
    public $tlist;
    public $tlistStatus = [1=>['status'=>'진행중','css'=>'primary'],
                          2=>['status'=>'완료', 'css'=> 'success'],
                          3=>['status'=>'휴강', 'css'=>'danger'],
                          4=>['status'=>'비공개', 'css'=>'warning']];


    // Logic Function Here

    // Ajax call, return by JSON
    public function getMyTlists(){
        // Show all the tutorials
        // authorize user
        $me = Auth::user();
        $search  = Input::get('search') ;
        if($search == ''){
            $myTlists = $me->tlists()->with('users')->orderBy('created_at', 'desc')->paginate(config('app.tlists_per_page'));
        } else {
            $myTlists = $me->tlists()->with('users')->where('title', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate(config('app.tlists_per_page'));
        }
        // table view render
        return response()->json(view()->make('admin.tlist.tlistTable', array('myTlists' => $myTlists, 'tlistStatus' => $this->tlistStatus, 'search'=>$search))->render());
    }

    public function createTags($data)
    {
        // make array
        if(!is_array($data)){
            $tags = explode(',', $data);
        } else {
            $tags = $data;
        }

        for ($i = 0; $i < count($tags); $i ++)
        {
            if (! $tag = Tag::firstOrCreate(['name' => $tags[$i]]))
                throw new FailedTagCreateException;
            $this->tagIds[] = $tag->id;
        }
        return true;
    }

    public function attachTags()
    {
        if (! $this->tlist->tags()->sync($this->tagIds))
            throw new FailedAttachTagException;
        return true;
    }

    public function getTlists($order){
        //dd($order);
       return $tlists = Tlist::with(['tcategory' => function ($query) {
           $query->orderBy('created_at', 'desc');
       }])->get();
    }

    /**
     * Display a listing of the category resource
     *
     * @return \Illuminate\Http\Response
     */
     public function category(Tlist $Tlist)
     {
         // authorize user
         $me = Auth::user();

         // find categories
         $tree = Tcategory::get()->toTree();

         // get Tlist
         $tlists = $this->getTlists(array('column' => 'created_at', 'type' => 'desc'));
         //dd($tlists);

         // view render
         return view('admin.tlist.category');
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // authorize user
        $me = Auth::user();

        // find categories
        $tree = Tcategory::with('tlistsCount')->get()->toTree();

        //dd($tree);

//  returns unsigned integer

            /*
            DB::table('usermetas')
             ->select('browser', DB::raw('count(*) as total'))
             ->groupBy('browser')
             ->lists('total','browser');
Usermeta::groupBy('browser')->select('browser', DB::raw('count(*) as total'))->get();

*/
    //    Tcategory::

        // find Tlist
        //$tlists = $this->getTlists(array('column' => 'created_at', 'type' => 'desc'));
        //dd($tlists);

        // view render
        return view('admin.tlist.index')->with(['tcategories' => $tree]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // find categories
        $tree = Tcategory::get()->toTree();
        //$nodes = Tcategory::get()->toFlatTree();

        // authorize user
        $me = Auth::user();

        // find Tlist which are mine
        $myTlists = $me->tlists()->with('users')->orderBy('created_at', 'desc')->paginate(config('app.tlists_per_page'))->setPath('/tlist/getMyTlists/page');

        return view('admin.tlist.create')->with(['tcategories' => $tree,
                    'myTlists' => $myTlists,
                'tlistStatus' => $this->tlistStatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request input
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'category' => 'required',
            'desc' => 'required',
            'status' => 'required',
            'progress' =>'required',
            'photo' => 'required|file|image',
        ]);
        if ($validator->fails()) {
            return response()->json(['result' => 'validerror', 'errors' => $validator->messages()], 200);
        }

        $me = Auth::user();
        // create new tlist
        // check the slug data if exist
        $slug = str_slug($request->title);
        $tlistExist = Tlist::where('slug', $slug)->first();
        if($tlistExist)
            $slug = $slug.'-'.rand(10, 9999);

        // create new tlist
        $this->tlist = Tlist::create([
            'title' => $request->title,
            'slug' => $slug,
            'desc' => $request->desc,
            'video_link' => $request->video_link,
            'tcategory_id' => $request->category,
            'status' => $request->status,
            'progress' => $request->progress,
        ]);
        if(! $this->tlist)
            return response()->json(['result' => 'fail', 'errors' => 'Tutorial list creation failed.']);

        // tlist photo update
        $image = $request->file('photo');
        #PATH
        $path='tlist/'.$this->tlist->id.'/';
        $mime = explode('/', $image->getClientMimeType() );

        $ext = strtolower( end($mime)); //$image->getClientOriginalExtension();
        $filename=str_shuffle(md5(rand() . microtime()));//$path.'thumb_'.time();
        $fullname = $filename.'.'.$ext;

        // for s3
        $img_n = Image::make($image)->resize(500, 370)->encode($ext);
        $img_m = Image::make($image)->resize(300, 222)->encode($ext);
        $img_s = Image::make($image)->resize(150, 111)->encode($ext);
        $path = Storage::disk('s3')->put( $fullname, (string) $img_n );
        Storage::disk('s3')->put( $filename.'_m.'.$ext, (string) $img_m );
        Storage::disk('s3')->put( $filename.'_s.'.$ext, (string) $img_s );
        // DB update image path
        $url = Storage::disk('s3')->url($fullname);
        $this->tlist->photo = $url;
        $this->tlist->save();

        $errors = [];
        // user insert to tlist users
        $this->tlist->users()->attach($me);

        // category insert to tlist categories
        //if(! $this->tlist->tcategory()->associate($request->category) )//tcategory()->attach($request->category))
        //    $errors['tcategory table'] = 'update category table fail';

        // tags insert
        if($this->createTags($request->tags)){
            if(! $this->attachTags()){
                $errors['tag table'] = 'update tag table fail';
            }
        } else {
            $errors['tag table'] = 'insert tag table fail';
        }

        // data modify for display
        //$this->tlist->created_at = Carbon::parse($this->tlist->created_at)->format('jS F Y');
        /*$avatar_s = explode('.', $me->avatar);
        $ext = end($avatar_s);
        $sliced = array_slice($avatar_s, 0, -1);
        $string = implode(".", $sliced);
        $avatar_s = $string.'_s.'.$ext;*/

        return response()->json([
            'result' => 'success',
            /*'data' => $this->tlist,
            'founder' => $me,
            'created_at' => Carbon::parse($this->tlist->created_at)->format('jS F Y'),
            'avatar_s' => $avatar_s,*/
            'errors' => $errors,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tlist  $Tlist
     * @return \Illuminate\Http\Response
     */
    public function show(Tlist $Tlist)
    {
        // get tutorials
        $tutorials = $Tlist->tutorials()->with('users')->get();

        // get users
        $users = $Tlist->users()->get();

        // get tags
        $tags = $Tlist->tags()->get();

        // get category
        $tree = Tcategory::get()->toTree();
        //$nodes = Tcategory::get()->toFlatTree();

        // authorize user
        $me = Auth::user();

        return view('admin.tlist.show')->with([
                    'tcategories' => $tree,
                    'tlist' => $Tlist,
                    'users' => $users,
                    'tags' => $tags]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tlist  $Tlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Tlist $Tlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tlist  $Tlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tlist $Tlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tlist  $Tlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tlist $Tlist)
    {
        //
    }
}
