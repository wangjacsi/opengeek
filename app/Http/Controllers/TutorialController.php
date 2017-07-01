<?php

namespace App\Http\Controllers;

use App\Tutorial;
use App\Tcategory;
use App\Tlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TutorialController extends Controller
{
    public $tlistStatus = [1=>['status'=>'진행중','css'=>'primary'],
                          2=>['status'=>'완료', 'css'=> 'success'],
                          3=>['status'=>'휴강', 'css'=>'danger'],
                          4=>['status'=>'비공개', 'css'=>'warning']];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        /*$myTlist2 = Tlist::with(['users' => function ($query) use ($userid) {
            $query->where('tlist_user.user_id', $userid);
        }])->get();*/
        //$myTlists = $me->tlists()->with('users')->orderBy('created_at', 'desc')->paginate(config('app.tlists_per_page'))->setPath('/tlist/getTlists/page');
        //->withPath('getTlists/page');
        //dd($myTlists);

        return view('admin.tutorial.create')->with(['tcategories' => $tree,
                    //'myTlists' => $myTlists,
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function show(Tutorial $tutorial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutorial $tutorial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tutorial  $tutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $tutorial)
    {
        //
    }
}
