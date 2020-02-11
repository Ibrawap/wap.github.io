<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Video;
use App\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
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
        $file = $this->copyFileFromLinkAs(
            $request->video_url, 'videos', $request->title
        );

        $video = auth()->user()->videos()->create([
            'category_id' => $request->category_id,
            'prefix'      => $request->prefix,
            'title'       => $request->title,
            'desc'        => $request->desc,
            'path'        => $file->path,
        ]);

        $this->dispatch(new \App\Jobs\GenerateVideoThumbnail($file, $video));

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
        $data = $request->only(['title', 'category_id', 'desc', 'prefix']);

        if ($request->filled('video_url')) {
            Storage::delete([$video->path, $video->thumbnail]);

            $file = $this->copyFileFromLinkAs(
                $request->video_url, 'videos', $request->title
            );

            $data['path'] = $file->path;

            $this->dispatch(new \App\Jobs\GenerateVideoThumbnail($file, $video));
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

    public function copyFileFromLinkAs($source, $folder, $name)
    {
        $extension = pathinfo($source, PATHINFO_EXTENSION) ?: 'mp4';
        $basename  = Str::slug($name, '_');
        $path      = "{$folder}/{$basename}.{$extension}";
        $content   = file_get_contents($source);
        Storage::disk('public')->put($path, $content);

        return (object) [
            'extension' => $extension,
            'basename'  => $basename,
            'path'      => $path,
        ];
    }
}
