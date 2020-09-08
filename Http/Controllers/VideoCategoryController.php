<?php

namespace App\Http\Controllers;

use App\VideoCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('videos.category.index', ['categories' => VideoCategory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.category.create', ['categories' => VideoCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, VideoCategory $videoCategory)
    {
        $request->validate([
            'title' => 'required|unique:video_categories|max:20'
        ]);

        $videoCategory->create($request->all());

        session()->flash(
            'success',
            "{$videoCategory->title} category added"
        );

        return redirect(route('video_categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function show(VideoCategory $videoCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoCategory $videoCategory)
    {
        return view(
            'videos.category.edit', 
            ['category' => $videoCategory],
            ['categories' => VideoCategory::all()]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoCategory $videoCategory)
    {
        $request->validate([
            'title' => 'required|max:20|unique:video_categories,title,'. $videoCategory->title. ',title',
        ]);

         $videoCategory->update($request->all());

        session()->flash(
            'success',
            "{$videoCategory->title} category updated"
        );

        return redirect(route('video_categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoCategory $videoCategory)
    {
        $videoCategory->delete();

        session()->flash(
            'success', 
            "{$videoCategory->title} category removed"
        );

        return redirect(route('video_categories.index'));
    }
}
