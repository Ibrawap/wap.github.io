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
        <div class="col-md-4 mb-4">
          <div class="posts">
            <div class="posts__image-wrapper">
              <img
              class="posts__image"
              src="{{ $post->thumbnail_url }}"
              alt="{{ $post->title }}">
              <div class="posts__image-overlay">
                <div class="posts__label">{{ $post->category->title }}</div>
              </div>
            </div>
            <div class="posts__content">
              <h5 class="posts__title"><a href="{{ $post->permalink }}" class="posts__link stretched-link">{{ $post->title }}</a></h5>
              <div class="posts__meta">
                <img
                src="{{ $post->user->avatar }}"
                width="30px"
                height="30px"
                class="img-thumbnail rounded-circle mr-1 mt-0"
                >
          
                <div class="text-muted">
                  <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
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