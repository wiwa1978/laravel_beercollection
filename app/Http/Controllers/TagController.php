<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Beeritem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::where('user_id', Auth::id())->orderBy('id','DESC')->paginate(10);
        return view('backend.tags.index', compact('tags'));
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
        $this->validate($request, array('name' => 'required|min:3|max:255'));

        $tag = new Tag([
            'tag_name' => $request->name,
            'user_id' => Auth::id()
        ]);
        $tag->save();

        return redirect('/tags')->with('success', 'Tag has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //$beerglasses = Beerglass::where('user_id', Auth::id())->where('id', $tag->id)->orderBy('id','DESC')->paginate(10);
        $beeritems = $tag->beeritems()->get();


        return view('backend.tags.show', compact('tag', 'beeritems'));
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
        //if($beerglass->user_id == auth()->user()->id) {
        try {
            $tag->delete();
            return redirect('/tags')->with('success', 'Tag has been deleted successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/tags')->with('error', 'Tag cannot be deleted due to integrity constraints (tags are used by certain beerglasses)');

        }




        //}
        //else {
        //    abort('403');
        //}
    }
}
