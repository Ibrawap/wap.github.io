<?php

namespace App\Http\Controllers;

use App\SongCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SongCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('songs.category.index', ['categories' => SongCategory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('songs.category.create', ['categories' => SongCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SongCategory $songCategory)
    {
        $request->validate([
            'title' => 'required|unique:song_categories|max:20'
        ]);

        $songCategory->create($request->all());

        session()->flash(
            'success',
            "{$songCategory->title} category added"
        );

        return redirect(route('song_categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SongCategory  $songCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SongCategory $songCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SongCategory  $songCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SongCategory $songCategory)
    {
        return view(
            'songs.category.edit', 
            ['category' => $songCategory],
            ['categories' => SongCategory::all()]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SongCategory  $songCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SongCategory $songCategory)
    {
         $request->validate([
            'title' => 'required|max:20|unique:song_categories,title,'. $songCategory->title. ',title',
        ]);

         $songCategory->update($request->all());

        session()->flash(
            'success',
            "{$songCategory->title} category updated"
        );

        return redirect(route('song_categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SongCategory  $songCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SongCategory $songCategory)
    {
        $songCategory->delete();

        session()->flash(
            'success', 
            "{$songCategory->title} category removed"
        );

        return redirect(route('song_categories.index'));
    }
}
