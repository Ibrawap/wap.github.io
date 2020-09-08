<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artiste;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAlbumRequest;

class AlbumController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::paginate(16);

        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        $data = $request->except('thumbnail_url');

        $data['thumbnail'] = $this->remoteUploadFile(
            $request->input('thumbnail_url'),
            'albums',
            $request->input('title')
        );

        $album = auth()->user()->albums()->create($data);
    
        session()->flash('success', 'Album created');

        return view('albums.show', $album->permalink);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $album->views()->create();
        $related = Album::latest()->take(6)->get();

        return view('albums.show', compact('album', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $data =  $request->except('thumbnail_url');

        if ($request->filled('thumbnail_url')) {
            Storage::delete($album->thumbnail);

            $data['thumbnail'] = $this->remoteUploadFile(
                $request->input('thumbnail_url'),
                'albums',
                $request->title
            );
        }

        $album->update($data);

        session()->flash('success', 'album updated');

        return redirect($album->permalink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->views()->delete();
        $album->comments()->delete();
        $album->votes()->delete();
        $album->delete();

        session()->flash('success', 'album deleted');

        return redirect(route('home'));
    }
}
