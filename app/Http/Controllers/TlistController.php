<?php

namespace App\Http\Controllers;

use App\Tlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Tag;
use Carbon\Carbon;


class TlistController extends Controller
{
    public $tagIds;
    public $tlist;

    // Logic Function Here
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'category' => 'required',
            'desc' => 'required',
            'status' => 'required',
            'progress' =>'required',
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
        $avatar_s = explode('.', $me->avatar);
        $ext = end($avatar_s);
        $sliced = array_slice($avatar_s, 0, -1);
        $string = implode(".", $sliced);
        $avatar_s = $string.'_s.'.$ext;

        return response()->json([
            'result' => 'success',
            'data' => $this->tlist,
            'founder' => $me,
            'created_at' => Carbon::parse($this->tlist->created_at)->format('jS F Y'),
            'avatar_s' => $avatar_s,
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
        //
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
