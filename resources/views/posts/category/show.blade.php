@extends('layouts.app')
@section('content')

    <h3 class="page__header">{{ $post->title }}</h3>
    <div class="card">
        <div class="card-body">
            <div class="media">
                <img 
                    src="{{ $post->user->avatar }}" 
                    width="50px" 
                    class="img-thumbnail rounded-circle mr-3"
                >
                <div class="media-body">
                    <h5 class="mt-0">{{ $post->user->name }}</h5>
                    <p class="text-muted">
                        <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                        <i class="fas fa-chart-bar"></i> 22k
                    </p>
                </div>
                <div>
                    <vote :entity="{{ $post }}"></vote>
                </div>
            </div>
            <p>
                @if(isset($post->thumbnail))
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <img 
                                src="{{ $post->getThumbnail() }}" 
                                class="img-thumbnail mb-3"
                            >
                        </div>
                    </div>
                @endif
                {{ $post->description }}
            </p>
            @can('update', $post)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-dark float-right"><i class="fas fa-edit"></i>  Edit</a>
            @endcan
        </div>
    </div>
    <comments :entity="{{ $post }}"></comments>
  
@endsection