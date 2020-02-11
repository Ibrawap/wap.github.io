@extends('layouts.app')
@section('title', 'All albums')
@section('meta')
@include('meta::manager', [
  'title'       =>  'All albums',
  'description' =>  'Download latest albums',
])
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Albums</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        @forelse($albums as $album)
        <div class="col-md-4">
          <div class="card bd-rd-20">
            <img class="card-img-top bd-rd-20" src="{{ $album->thumbnail_url }}" alt="">
            <div class="card-img-overlay bd-rd-20 overlay-bg d-flex flex-column justify-content-center">
              <h4 class="card-title"><a href="{{ $album->permalink }}" class="card-link stretched-link text-white">{{ $album->title }}</a></h4>
              <span class="badge badge-danger p-1">{{ $album->category->title ?? null}}</span>
            </div>
          </div>
        </div>
        @empty
        <div class="col">
          <div class="alert alert-danger" role="alert"> Oops... Nothing to show</div>
        </div>
        @endforelse
      </div>
      {{ $albums->links() }}
    </div>
    <div class="col-md-4">
      @include('sidebars.albums.index')
    </div>
  </div>
</div>
@endsection