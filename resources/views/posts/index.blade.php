@extends('layouts.app')
@section('title', 'All forum posts')
@section('meta')
@include('meta::manager', [
  'title'       =>  'All forum posts',
  'description' =>  'read all latest forum posts, gossip, news, etc.',
])
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Forum</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        @forelse($posts as $post)
        <div class="col-md-4">
          <div class="card rounded-20 overflow-hidden">
            <div class="position-relative">
              <img
              src="{{ $post->thumbnail_url }}"
              class="card-img-top"
              alt="{{ $post->title }}"
              style="border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; object-fit: cover;">
              <div class="card-img-overlay overlay-bg">
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
      <div class="mt-2">
        {{ $posts->links() }}
      </div>
    </div>
    <div class="col-md-4">
      @include('sidebars.posts.index')
    </div>
  </div>
</div>
@endsection