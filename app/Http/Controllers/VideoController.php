<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreVideoRequest;

class VideoController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos     = Video::paginate(10);
        $categories = VideoCategory::all();

        return view('videos.index', compact('videos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = VideoCategory::all();

        return view('videos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $data = $request->except('video_url');
        $data['path'] = $this->remoteUploadFile(
            $request->input('video_url'),
            'videos',
            $request->input('title')
        );

        $video = auth()->user()->videos()->create($data);

        $this->dispatch(new \App\Jobs\GenerateVideoThumbnail($video));

        session()->flash('success', 'Video uploaded');

        return redirect($video->permalink);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $video->views()->create();
        $recent  = Video::latest()->take(6)->get();
        $related = Video::where('category_id', $video->category_id)
            ->where('id', '!=', $video->id)
            ->take(6)->get();

        return view('videos.show', compact('video', 'related', 'recent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $categories = VideoCategory::all();

        return view('videos.edit', compact('video', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $data = $request->except('video_url', 'files');

        if ($request->filled('video_url')) {
            Storage::delete([$video->path, $video->thumbnail]);

            $data['path'] = $this->remoteUploadFile(
                $request->input('video_url'),
                'videos',
                $request->input('title')
            );

            $this->dispatch(new \App\Jobs\GenerateVideoThumbnail($video));
        }

        $video->update($data);

        session()->flash('success', 'Video updated');

        return redirect($video->permalink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->views()->delete();
        $video->comments()->delete();
        $video->votes()->delete();
        $video->delete();

        session()->flash('success', 'Video deleted');

        return redirect(route('home'));
    }
}
