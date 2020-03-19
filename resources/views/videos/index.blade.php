@extends('layouts.app')
@section('title', 'All videos')
@section('meta')
@include('meta::manager', [
  'title'       =>  'All videos',
  'description' =>  'Download latest videos',
])
@endsection
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Videos</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        @forelse($videos as $video)
        <div class="col-md-4 mb-4">
          <div class="videos h-100">
            <div class="videos__image-wrapper">
                <img class="videos__image" src="{{ $video->thumbnail_url }}" alt="">
                <div class="videos__image-overlay">
                  <div class="videos__body">
                    <h4><a href="{{ $video->permalink }}" class="videos__title stretched-link">Video: {{ $video->title }}</a></h4>
                    <div class="videos__meta">
                  <img
                  src="{{ $video->user->avatar }}"
                  width="30px"
                  height="30px"
                  class="img-thumbnail rounded-circle mr-1 mt-0"
                  >
                  <div class="text-mted">
                    <i class="fas fa-clock"></i> {{ $video->created_at->diffForHumans() }}
                  </div>
                </div>
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
      {{ $videos->links() }}
    </div>
    <div class="col-md-4">
      @include('sidebars.videos.index')
    </div>
  </div>
</div>
@endsection