@extends('layouts.app')
@section('title', $video->title)
@section('meta')
@include('meta::manager', [
'title'         =>  $video->title,
'description'   =>  Str::limit($video->desc, 100),
'image'         =>  $video->thumbnail_url,
])
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('videos.index') }}">Videos</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $video->title }}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8">
      <div class="single-post">
        <div
          class="single-post__header"
          style="background-image: url({{ $video->thumbnail_url }}); background-size: cover;">
          <div class="single-post__header__content">
            <h1>{{ $video->title }}</h1>
            <div class="row">
              <div class="col">
                <i class="fas fa-clock text-secondary"></i> {{ $video->created_at->diffForHumans() }}
              </div>
              <div class="col">
                <i class="fas fa-chart-bar text-secondary"></i> {{ $video->views()->count() }}
              </div>
              <div class="col">
                <i class="fas fa-comment text-secondary"></i> {{ $video->comments()->count() }}
              </div>
            </div>
          </div>
          
          {{-- <img src="{{ $video->thumbnail_url }}" alt="{{ $video->thumbnail_url }}"> --}}
        </div>
        <div class="single-post__content">
          <div class="media">
            <img
            src="{{ $video->user->avatar }}"
            width="50px"
            height="50px"
            class="img-thumbnail rounded-circle mr-3"
            >
            <div class="media-body" style="font-size: 15px;">
              <h5 class="mt-2 text-primary">{{ $video->user->username }}</h5>
            </div>
            <div>
              <vote :entity="{{ $video }}"></vote>
            </div>
          </div>
          {!! $video->desc !!}
          <div class="row no-gutters mt-5">
            <div class="col">
              <a href="{{ $video->download }}" class="btn btn-block btn-primary rounded-0"><i class="fa fa-download"></i> Download</a>
            </div>
            <div class="col">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      @include('sidebars.videos.show')
    </div>
  </div>
</div>
@endsection