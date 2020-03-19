@extends('layouts.app')
@section('title', $post->title)
@section('meta')
@include('meta::manager', [
  'title'       =>  "{{ $post->title }}",
  'description' =>  "{{ Str::limit($post->desc, 100) }}",
  'image'       =>  $post->thumbnail_url,
])
@endsection
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Posts</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8">
      <div class="single-post">
        <div
          class="single-post__header"
          style="background-image: url({{ $post->thumbnail_url }}); background-size: cover;">
          <div class="single-post__header__content">
            <h1>{{ $post->title }}</h1>
            <div class="row">
              <div class="col">
                <i class="fas fa-clock text-secondary"></i> {{ $post->created_at->diffForHumans() }}
              </div>
              <div class="col">
                <i class="fas fa-chart-bar text-secondary"></i> {{ $post->views()->count() }}
              </div>
              <div class="col">
                <i class="fas fa-comment text-secondary"></i> {{ $post->comments()->count() }}
              </div>
            </div>
          </div>
          
          {{-- <img src="{{ $post->thumbnail_url }}" alt="{{ $post->thumbnail_url }}"> --}}
        </div>
        <div class="single-post__content">
          <div class="media">
            <img
            src="{{ $post->user->avatar }}"
            width="50px"
            height="50px"
            class="img-thumbnail rounded-circle mr-3"
            >
            <div class="media-body" style="font-size: 15px;">
              <h5 class="mt-2 text-primary">{{ $post->user->username }}</h5>
            </div>
            <div>
              <vote :entity="{{ $post }}"></vote>
            </div>
          </div>
          {!! $post->desc !!}
        </div>
      </div>
      <comments :entity="{{ $post }}"></comments>
    </div>
    <div class="col-md-4">
      @include('sidebars.posts.show')
    </div>
  </div>
</div>
@endsection