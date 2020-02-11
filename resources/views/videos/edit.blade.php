@extends('layouts.app')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('videos.index') }}">Videos</a></li>
      <li class="breadcrumb-item"><a href="{{ $video->permalink }}">{{ $video->title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('videos.update', ['video' => $video->id]) }}">
            @csrf
            @method('PUT')

            <label for="prefix">Prefix</label>
            <div class="form-group">
              <input
              name="prefix"
              type="text"
              class="form-control @error('prefix') is-invalid @enderror"
              value="{{ old('prefix') ?? $video->prefix }}"
              >
              @error('title')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>

            <label for="video_url">Title</label>
            <div class="form-group">
              <input
              name="title"
              type="text"
              class="form-control @error('title') is-invalid @enderror"
              placeholder="Video Title"
              value="{{ old('title') ?? $video->title }}"
              >
              @error('title')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>

            <label for="video_url">Video url</label>
            <div class="form-group">
              <input
              type="text"
              name="video_url"
              class="form-control"
              value="{{ old('video_url') }}"
              >
              @error('video_url')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>

            <div class="form-group">
              <select name="category_id" class="custom-select @error('category_id') is-invalid @enderror">
                <option value="">Choose...</option>
                @foreach($categories as $category)
                <option
                  value="{{ $category->id }}" @if($category->id === $video->category_id) selected @endif>{{ $category->title }}
                </option>
                @endforeach
              </select>
              @error('category_id')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <div class="form-group">
              <textarea name="desc" cols="30" class="form-control @error('desc') is-invalid @enderror" id="summernote">{{ old('desc') ?? $video->desc }}</textarea>
              @error('desc')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary float-right">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection