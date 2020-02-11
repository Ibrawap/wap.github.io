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
        <div class="col-md-4">
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
      {{ $videos->links() }}
    </div>
    <div class="col-md-4">
      @include('sidebars.videos.index')
    </div>
  </div>
</div>
@endsection