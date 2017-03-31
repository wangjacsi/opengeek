<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public $tagIds;

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

    public function findGet($query){
        //dd($request->query);
        if($query != ''){
            $tags = Tag::where('name', 'LIKE', '%'.$query.'%')->take(10)->get();
            $names = $tags->map(function ($tag) {
                return $tag->name;
            });
            return response()->json($names);
            /*return response()->json([
                'aaa','aavv','aafgr', 'bbb', 'ccc', 'ddd', 'eee'
            ]);*/
        }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
