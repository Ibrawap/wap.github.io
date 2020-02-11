@extends('layouts.app')
@section('title', $album->title)
@section('meta')
@include('meta::manager', [
  'title'       =>  $album->title,
  'description' =>  Str::limit($album->desc, 100),
  'image'       =>  $album->thumbnail_url,
])
@endsection
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('songs.index') }}">Albums</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $album->title }}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="single-post">
        <div
          class="single-post__header"
          style="background-image: url({{ $album->thumbnail_url }}); background-size: cover;">
          <div class="single-post__header__content">
            <h1>{{ $album->title }}</h1>
            <div class="row">
              <div class="col">
                <div class="text-primary">Published</div>
                <i class="fas fa-clock"></i> {{ $album->created_at->diffForHumans() }}
              </div>
              <div class="col">
                <div class="text-primary">Views</div>
                <i class="fas fa-chart-bar"></i> {{ $album->views()->count() }}
              </div>
              <div class="col">
                <div class="text-primary">Comment(s)</div>
                <i class="fas fa-comment"></i> {{ $album->comments()->count() }}
              </div>
            </div>
          </div>
          
          {{-- <img src="{{ $album->thumbnail_url }}" alt="{{ $album->thumbnail_url }}"> --}}
        </div>
        <div class="single-post__content">
          <div class="media">
            <img
            src="{{ $album->user->avatar }}"
            width="50px"
            height="50px"
            class="img-thumbnail rounded-circle mr-3"
            >
            <div class="media-body" style="font-size: 15px;">
              <h5 class="mt-2 text-primary">{{ $album->user->username }}</h5>
            </div>
            <div class="mt-2">
              <vote :entity="{{ $album }}"></vote>
            </div>
          </div>
          {!! $album->desc !!}

          @foreach($album->songs as $song)
          <a href="{{ $song->permalink }}" style="text-decoration: none;">
            <div class="shadow bg-white px-3 py-2 m-1 relative d-flex justify-content-between bd-rd-20" style="border-bottom: 2px solid #007bff;">
              <span><i class="fas fa-dot-circle" aria-hidden="true"></i> {{ $song->title }}</span>
              <i class="fas fa-play" aria-hidden="true"></i>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection