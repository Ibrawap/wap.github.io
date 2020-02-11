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
    <div class="col-md-3">
      <div class="card rounded-20 overflow-hidden">
        <div class="position-relative">
          <img
          src="{{ $post->thumbnail_url }}"
          class="card-img-top"
          alt="{{ $post->title }}">
          <div class="card-img-overlay overlay-bg rounded-top">
            <span class="badge badge-info p-1 rounded">{{ $post->category->title }}</span>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title"><a href="{{ $post->permalink }}" class="card-link stretched-link">{{ $post->title }}</a></h5>
          <div class="media">
            <img
            src="{{ $post->user->avatar }}"
            width="30px"
            height="30px"
            class="img-thumbnail rounded-circle mr-1 mt-0"
            >
            <div class="media-body">
              {{-- <h6 class="mt-0 text-primary">{{ $post->user->username }}</h6> --}}
            </div>
            <p class="text-mted">
              <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
            </p>
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
    <div class="col-md-3">
      <div class="card rounded-20">
        <img class="card-img-top rounded-20" src="{{ $song->thumbnail_url }}" alt="">
        <div class="card-img-overlay rounded-20 overlay-bg">
          <div class=" d-flex flex-column justify-content-center">
            <h4 class="card-title"><a href="{{ $song->permalink }}" class="card-link stretched-link text-white">{{ $song->title }}</a></h4>
            <div class="media">
              <img
              src="{{ $song->user->avatar }}"
              width="30px"
              height="30px"
              class="img-thumbnail rounded-circle mr-1 mt-0"
              >
              <div class="media-body">
                {{-- <h6 class="mt-0 text-primary">{{ $song->user->username }}</h6> --}}
              </div>
              <p class="text-mted">
                <i class="fas fa-clock"></i> {{ $song->created_at->diffForHumans() }}
              </p>
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
    <div class="col-md-3">
      <div class="card rounded-20 overflow-hidden">
        <div class="position-relative">
          <img
            src="{{ $video->thumbnail_url }}"
            class="card-img-top"
            alt="{{ $video->title }}"
          >
          <div class="card-img-overlay overlay-bg">
            <span class="badge badge-info p-1 rounded">{{ $video->category->title }}</span>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title"><a href="{{ $video->permalink }}" class="card-link stretched-link">{{ $video->title }}</a></h5>
          <div class="media">
            <img
            src="{{ $video->user->avatar }}"
            width="30px"
            height="30px"
            class="img-thumbnail rounded-circle mr-1 mt-0"
            >
            <div class="media-body">
              {{-- <h5 class="mt-0 text-primary">{{ $video->user->username }}</h5> --}}
              
            </div>
            <p>
              <i class="fas fa-clock"></i> {{ $video->created_at->diffForHumans() }}
            </p>
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