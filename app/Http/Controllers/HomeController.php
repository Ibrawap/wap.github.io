<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = auth()->user()->posts;
        $songs = auth()->user()->songs;
        $videos = auth()->user()->videos;
        $albums = auth()->user()->albums;
     
        return view('home', compact('posts', 'songs', 'videos', 'albums'));
    }
}
