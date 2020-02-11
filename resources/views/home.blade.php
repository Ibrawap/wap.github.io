@extends('layouts.app')
@section('content')
<div class="container py-4">
  <div class="row d-flex justify-content-center">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card rounded-20 border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Posts</div>
              <div class="h5 mb-0 font-weight-bold text-dark">{{ $posts->count() }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comment fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card rounded-20 border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Songs</div>
              <div class="h5 mb-0 font-weight-bold text-dark">{{ $songs->count() }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-music fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card rounded-20 border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Videos</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-dark">{{ $videos->count() }}</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-video fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card rounded-20 border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Albums</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-dark">{{ $albums->count() }}</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-folder fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card rounded-20 shadow">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-1">
            <h1 class="h3 mb-0 text-dark">Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary">
              <i class="fas fa-plus"></i>
              Add new
            </a>
          </div>
          @if(count($posts))
          @foreach($posts->take(5) as $post)
          <div class="d-flex justify-content-between align-items-center p-2 shadow-sm mb-1 rounded-bottom">
            <a href="{{ $post->permalink }}" class="card-link">{{ $post->title }}</a>
            <div class="d-flex">
              <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info rounded-0 text-white">Edit</a>
              <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger rounded-0 d-inline">Delete</button>
              </form>
            </div>
          </div>
          @endforeach
          @else
          <div class="alert alert-info mt-5 rounded" role="alert">
            <div class="alert-message">
              <i class="far fa-fw fa-bell"></i>No data to display<strong><a href="{{ route('posts.create') }}" class="alert-link"> Add new posts
            </a></strong>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card rounded-20 shadow">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-1">
            <h1 class="h3 mb-0 text-dark">Songs</h1>
            <a href="{{ route('songs.create') }}" class="btn btn-sm btn-primary">
              <i class="fas fa-plus"></i>
              Add new
            </a>
          </div>
          @if(count($songs))
          @foreach($songs->take(5) as $song)
          <div class="d-flex justify-content-between align-items-center p-2 shadow-sm mb-1 rounded-bottom p-2 shadow-sm mb-1 rounded-bottom">
            <a href="{{ $song->permalink }}" class="card-link">{{ $song->title }}</a>
            <div class="d-flex">
              <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-sm btn-info rounded-0 text-white">Edit</a>
              <form action="{{ route('songs.destroy', $song->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger rounded-0 d-inline">Delete</button>
              </form>
            </div>
          </div>
          @endforeach
          @else
          <div class="alert alert-info mt-5 rounded" role="alert">
            <div class="alert-message">
              <i class="far fa-fw fa-bell"></i>No data to display<strong><a href="{{ route('songs.create') }}" class="alert-link"> Add new song
            </a></strong>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card rounded-20 shadow">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-1">
            <h1 class="h3 mb-0 text-dark">Videos</h1>
            <a href="{{ route('videos.create') }}" class="btn btn-sm btn-primary">
              <i class="fas fa-plus"></i>
              Add new
            </a>
          </div>
          @if(count($videos))
          @foreach($videos->take(5) as $video)
          <div class="d-flex justify-content-between align-items-center p-2 shadow-sm mb-1 rounded-bottom">
            <a href="{{ $video->permalink }}" class="card-link">{{ $video->title }}</a>
            <div class="d-flex">
              <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-sm btn-info rounded-0 text-white">Edit</a>
              <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger rounded-0 d-inline">Delete</button>
              </form>
            </div>
          </div>
          @endforeach
          @else
          <div class="alert alert-info mt-5 rounded" role="alert">
            <div class="alert-message">
              <i class="far fa-fw fa-bell"></i>No data to display<strong><a href="{{ route('videos.create') }}" class="alert-link"> Add new video
            </a></strong>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card rounded-20 shadow">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-1">
            <h1 class="h3 mb-0 text-dark">Albums</h1>
            <a href="{{ route('albums.create') }}" class="btn btn-sm btn-primary">
              <i class="fas fa-plus"></i>
              Add new
            </a>
          </div>
          @if(count($albums))
          @foreach($albums->take(5) as $video)
          <div class="d-flex justify-content-between align-items-center p-2 shadow-sm mb-1 rounded-bottom">
            <a href="{{ $video->permalink }}" class="card-link">{{ $video->title }}</a>
            <div class="d-flex">
              <a href="{{ route('albums.edit', $video->id) }}" class="btn btn-sm btn-info rounded-0 text-white">Edit</a>
              <form action="{{ route('albums.destroy', $video->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger rounded-0 d-inline">Delete</button>
              </form>
            </div>
          </div>
          @endforeach
          @else
          <div class="alert alert-info mt-5 rounded" role="alert">
            <div class="alert-message">
              <i class="far fa-fw fa-bell"></i>No data to display<strong><a href="{{ route('albums.create') }}" class="alert-link"> Add new albums
            </a></strong>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endsection