@extends('layouts.app')
@section('title', $song->title)
@section('meta')
@include('meta::manager', [
  'title'         =>  $song->title,
  'description'   =>  Str::limit($song->desc, 100),
  'image'         =>  $song->thumbnail_url,
])
@endsection
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('songs.index') }}">Songs</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $song->title }}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8">
      <div class="single-post">
        <div
          class="single-post__header"
          style="background-image: url({{ $song->thumbnail_url }}); background-size: cover;">
          <div class="single-post__header__content">
            <h1>{{ $song->title }}</h1>
            <div class="row">
              <div class="col">
                <i class="fas fa-clock text-secondary"></i> {{ $song->created_at->diffForHumans() }}
              </div>
              <div class="col">
                <i class="fas fa-chart-bar text-secondary"></i> {{ $song->views()->count() }}
              </div>
              <div class="col">
                <i class="fas fa-comment text-secondary"></i> {{ $song->comments()->count() }}
              </div>
            </div>
          </div>
          
          {{-- <img src="{{ $song->thumbnail_url }}" alt="{{ $song->thumbnail_url }}"> --}}
        </div>
        <div class="single-post__content">
          <div class="media">
            <img
            src="{{ $song->user->avatar }}"
            width="50px"
            height="50px"
            class="img-thumbnail rounded-circle mr-3"
            >
            <div class="media-body">
              <h5 class="mt-2 text-primary">{{ $song->user->username }}</h5>
            </div>
            <div>
              <vote :entity="{{ $song }}"></vote>
            </div>
          </div>
          {!! $song->desc !!}
          <div class="row no-gutters mt-5">
            <div class="col">
              <a href="{{ $song->download }}" class="btn btn-block btn-primary rounded-0"><i class="fa fa-download"></i> Download</a>
            </div>
            <div class="col">
              <button class="btn btn-block btn-outline-primary rounded-0"><i class="fa fa-play"></i> Stream</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      @include('sidebars.posts.show')
    </div>
  </div>
</div>
@endsection