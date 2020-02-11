<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artiste;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAlbumRequest;

class AlbumController extends Controller
{
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
        $file = $this->copyFileFromLinkAs($request->thumbnail_url, 'albums', $request->title);

        $album = auth()->user()->albums()->create([
            'prefix' => $request->prefix,
            'title' => $request->title,
            'artiste' => $request->artiste,
            'thumbnail' => $file->path,
            'released_date' => $request->released_date,
            'desc' => $request->desc
        ]);
    
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
        // $album->views()->create();
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
        $album->update($request->all());

        session()->flash('success', 'album updated');

        return redirect(route('albums.show', $album->id));
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
