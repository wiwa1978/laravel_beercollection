<?php

namespace App\Http\Controllers;

use App\Category;
use App\Beeritem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->orderBy('id','DESC')->paginate(10);
        //dd($tags->isEmpty());
        return view('backend.categories.index', compact('categories'));
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
        $request->validate([
            'category_name'=> 'required|min:3|max:255',
            'category_description'=> 'required',
        ]);

        $category = new Category([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
        ]);
        $category->save();

        return redirect('/categories')->with('success', 'Category has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $beeritems = Beeritem::where('user_id', Auth::id())->where('category_id', $category->id)->orderBy('id','DESC')->paginate(10);
        //dd($tags->isEmpty());
        return view('backend.categories.show', compact('category', 'beeritems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect('/categories')->with('success', 'Category has been deleted successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/categories')->with('error', 'Category cannot be deleted due to integrity constraints (categories are used by certain beerglasses)');

        }
    }
}
