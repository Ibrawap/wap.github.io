<?php

namespace App\Http\Controllers;

use App\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.category.index', ['categories' => PostCategory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.category.create', ['categories' => PostCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PostCategory $postCategory)
    {
        $request->validate([
            'title' => 'required|unique:post_categories|max:20'
        ]);

        $postCategory->create($request->all());

        session()->flash(
            'success',
            "{$postCategory->title} category added"
        );

        return redirect(route('post_categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $postCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        return view(
            'posts.category.edit', 
            ['category' => $postCategory],
            ['categories' => PostCategory::all()]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $postCategory)
    {
        $request->validate([
            'title' => 'required|max:20|unique:post_categories,title,'. $postCategory->title. ',title',
        ]);

         $postCategory->update($request->all());

        session()->flash(
            'success',
            "{$postCategory->title} category updated"
        );

        return redirect(route('post_categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();

        session()->flash(
            'success', 
            "{$postCategory->title} category removed"
        );

        return redirect(route('post_categories.index'));
    }
}
