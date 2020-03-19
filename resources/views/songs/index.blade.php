@extends('layouts.app')
@section('title', 'All songs')
@section('meta')
@include('meta::manager', [
  'title'       =>  'All songs',
  'description' =>  'Download latest songs',
])
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Songs</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        @forelse($songs as $song)
        <div class="col-md-4">
          <div class="songs mb-4">
            <div class="songs__image-wrapper">
              <img class="songs__image" src="{{ $song->thumbnail_url }}" alt="">
              <div class="songs__image-overlay">
                <div class="songs__body">
                  <h4 class="songs__title"><a href="{{ $song->permalink }}" class="songs__link stretched-link">Music: {{ $song->title }}</a></h4>
                  <div class="songs__meta">
                  <img
                  src="{{ $song->user->avatar }}"
                  width="30px"
                  height="30px"
                  class="img-thumbnail rounded-circle mr-1 mt-0"
                  >
                  <div class="text-mted">
                    <i class="fas fa-clock"></i> {{ $song->created_at->diffForHumans() }}
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
      {{ $songs->links() }}
    </div>
    <div class="col-md-4">
      @include('sidebars.songs.index')
    </div>
  </div>
</div>
@endsection