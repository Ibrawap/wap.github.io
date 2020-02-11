@extends('layouts.app')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('videos.index') }}">Videos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add new</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12">
      <div class="card bd-rd-20">
        <div class="card-body">
          <form method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
            @csrf
            <label for="prefix">Prefix</label>
            <div class="form-group">
              <input
              name="prefix"
              type="text"
              class="form-control @error('prefix') is-invalid @enderror"
              value="{{ old('prefix') }}"
              >
              @error('prefix')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>

            <label for="title">Title</label>
            <div class="form-group">
              <input
              name="title"
              type="text"
              class="form-control @error('title') is-invalid @enderror"
              value="{{ old('title') }}"
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

            <label for="category_id">Choose category</label>
            <div class="form-group">
              <select name="category_id" class="custom-select @error('category_id') is-invalid @enderror">
                <option value="">Choose...</option>
                @foreach($categories as $category)
                <option
                  value="{{ $category->id }}" @if($category->id == old('category_id')) selected @endif>{{ $category->title }}
                </option>
                @endforeach
              </select>
              @error('category_id')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="desc">Write A Description</label>
            <div class="form-group">
              <textarea name="desc" cols="30" class="form-control @error('desc') is-invalid @enderror" id="summernote">{{ old('desc') }}</textarea>
              @error('desc')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary float-right">Save Video</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection