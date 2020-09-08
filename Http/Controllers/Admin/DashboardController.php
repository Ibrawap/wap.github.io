<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Song;
use App\User;
use App\Video;

class DashboardController extends Controller
{
    public function index()
    {
        $posts  = Post::all();
        $songs  = Song::all();
        $videos = Video::all();
        $users  = User::all();

        return view('admin.dashboard', compact('posts', 'songs', 'videos', 'users'));
    }
}
