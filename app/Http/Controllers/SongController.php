<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artiste;
use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Song;
use App\SongCategory;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SongController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs      = Song::latest()->paginate(10);
        $categories = SongCategory::all();

        if (request()->category) {
            $category = request()->category;
            $songs    = Song::where('category_id', $category)->latest()->paginate(10);
        }

        return view('songs.index', compact('songs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = SongCategory::all();
        $albums     = Album::all();

        return view('songs.create', compact('categories', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSongRequest $request)
    {
        $data = $request->except('thumbnail_url', 'song_url');
        $data['path'] = $this->remoteUploadFile(
            $request->input('song_url'),
            'songs',
            $request->input('title')
        );
        
        $data['thumbnail'] = $this->remoteUploadFile(
            $request->input('thumbnail_url'),
            'songs',
            $request->input('title')
        );

        $song = auth()->user()->songs()->create($data);

        $this->dispatchNow(new \App\Jobs\AddSongTags($song));

        session()->flash('success', 'Song uploaded');

        return redirect($song->permalink);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        $song->views()->create();
        $related = Song::where('category_id', $song->category_id)
            ->where('id', '!=', $song->id)
            ->take(6)->get();
        $recent = Song::latest()->take(6)->get();
        return view('songs.show', compact('song', 'related', 'recent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        $categories = SongCategory::all();
        $albums     = Album::all();

        return view('songs.edit', compact('song', 'categories', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
        $validated = $request->validated();

        if ($request->filled('thumbnail_url')) {
            Storage::delete($song->thumbnail);

            $validated['thumbnail'] = $this->remoteUploadFile(
                $request->input('thumbnail_url'),
                'songs',
                $request->input('title')
            );
        }

        if ($request->filled('song_url')) {
            Storage::delete($song->path);

            $validated['path'] = $this->remoteUploadFile(
                $request->input('song_url'),
                'songs',
                $request->input('title')
            );
        }

        $this->dispatchNow(new \App\Jobs\AddSongTags($song));

        $song->update($validated);

        session()->flash('success', 'Song updated');

        return redirect($song->permalink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $song->views()->delete();
        $song->comments()->delete();
        $song->votes()->delete();
        $song->delete();

        session()->flash('success', 'Song deleted');

        return redirect(route('home'));
    }
}
