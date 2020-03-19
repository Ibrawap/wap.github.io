@extends('layouts.app')
@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col">
      <h4>latest posts</h4>
    </div>
    <div class="col">
      <a href="{{ route('posts.index') }}" style="float: right"><b>see all <i class="fa fa-arrow-right"></i></b></a>
    </div>
  </div>
  <div class="row">
    @forelse(App\Post::latest()->take(8)->get() as $post)
    <div class="col-md-3 mb-4">
      <div class="posts">
            <div class="posts__image-wrapper">
              <img
              class="posts__image"
              src="{{ $post->thumbnail_url }}"
              alt="{{ $post->title }}">
              <div class="posts__image-overlay">
                <div class="posts__label">{{ $post->category->title }}</div>
              </div>
            </div>
            <div class="posts__content">
              <h5 class="posts__title"><a href="{{ $post->permalink }}" class="posts__link stretched-link">{{ $post->title }}</a></h5>
              <div class="posts__meta">
                <img
                src="{{ $post->user->avatar }}"
                width="30px"
                height="30px"
                class="img-thumbnail rounded-circle mr-1 mt-0"
                >
          
                <div class="text-muted">
                  <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                </div>
              </div>
              
            </div>
          </div>
    </div>
    @empty
    <div class="col">
      <div class="alert alert-danger" role="alert"> Oops... Nothing to show</div>
    </div>
    @endforelse
  </div>
</div>
<div class="container py-4">
  <div class="row">
    <div class="col">
      <h4>Latest songs</h4>
    </div>
    <div class="col">
      <a href="{{ route('songs.index') }}" style="float: right"><b>see all <i class="fa fa-arrow-right"></i></b></a>
    </div>
  </div>
  <div class="row">
    @forelse(App\Song::latest()->take(8)->get() as $song)
    <div class="col-md-3 mb-4">
      <div class="songs h-100">
        <div class="songs__image-wrapper">
            <img class="songs__image" src="{{ $song->thumbnail_url }}" alt="">
            <div class="songs__image-overlay">
              <div class="songs__body">
                <h4 class="songs__title"><a href="{{ $song->permalink }}" class="songs__link stretched-link">Music: {{ $song->title }}</a></h4>
              </div>
            </div>
          </div>
      </div>
    </div>
    @empty
    <div class="col">
      <div class="alert alert-danger" role="alert"> Oops... Nothing to show</div>
    </div>
    @endforelse
  </div>
</div>
<div class="container py-4">
  <div class="row">
    <div class="col">
      <h4>Latest videos</h4>
    </div>
    <div class="col">
      <a href="{{ route('videos.index') }}" style="float: right"><b>see all <i class="fa fa-arrow-right"></i></b></a>
    </div>
  </div>
  <div class="row">
    @forelse(App\Video::latest()->take(8)->get() as $video)
    <div class="col-md-3 mb-4">
      <div class="videos h-100">
        <div class="videos__image-wrapper">
            <img class="videos__image" src="{{ $video->thumbnail_url }}" alt="">
            <div class="videos__image-overlay">
              <div class="videos__body">
                <h4><a href="{{ $video->permalink }}" class="videos__title stretched-link">Video: {{ $video->title }}</a></h4>
              </div>
            </div>
          </div>
      </div>
    </div>
    @empty
    <div class="col">
      <div class="alert alert-danger" role="alert"> Oops... Nothing to show</div>
    </div>
    @endforelse
  </div>
</div>
@endsection