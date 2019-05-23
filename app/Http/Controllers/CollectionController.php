<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Beeritem;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::where('user_id', Auth::id())->orderBy('id','DESC')->paginate(10);
        $collection_types = Collection::getCollectionTypes();

        return view('backend.collections.index', compact('collections', 'collection_types'));
        //$categories = Category::where('user_id', Auth::id())->orderBy('id','DESC')->paginate(10);
        //dd($tags->isEmpty());
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
        //$this->validate($request, array('name' => 'required|min:3|max:255'));

         $request->validate([
            'collection_name'=> 'required',
            'collection_description'=> 'required',
        ]);

        $collection = new Collection([
            'user_id' => Auth::id(),
            'collection_name' => $request->collection_name,
            'collection_description' => $request->collection_description,
            'collection_type' => strtolower($request->collection_type),
        ]);
        $collection->save();

        $permission = strtolower('manage-' . $request->collection_type);
        Auth::user()->givePermissionTo($permission);


        return redirect('/collections')->with('success', 'Collection has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        $beeritems = Beeritem::where('user_id', Auth::id())->where('collection_id', $collection->id)->paginate(10);
        $name =  ucfirst($collection->collection_type);

        if($collection->user_id == Auth::id()) {

                return view('backend.collections.beeritems.show', compact('name', 'beeritems', 'collection'));


        }
        else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
         try {
            $permission = strtolower('manage-' . $collection->collection_type);
            Auth::user()->revokePermissionTo($permission);
            $collection->delete();

            return redirect('/collections')->with('success', 'Collection has been deleted successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/collections')->with('error', 'Collection cannot be deleted due to integrity constraints (collections are used by certain objects)');

        }
    }
}
