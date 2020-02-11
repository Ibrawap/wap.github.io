@extends('layouts.app')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post</a></li>
      <li class="breadcrumb-item"><a href="{{ $post->permalink }}">{{ $post->title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card rounded-20">
        <div class="card-body">
          <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label for="prefix">Prefix</label>
            <div class="form-group">
              <input
              name="prefix"
              type="text"
              class="form-control @error('prefix') is-invalid @enderror"
              value="{{ old('prefix') ?? $post->prefix }}"
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
              value="{{ old('title') ?? $post->title }}"
              >
              @error('title')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="thumbnail">Choose thumbnail</label>
            <div class="form-group">
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">

                @error('thumbnail')
                <small class="form-text text-danger"><b>{{ $message }}</b></small>
                @enderror
            </div>
            <label for="category_id">Choose category</label>
            <div class="form-group">
              <select name="category_id" class="custom-select @error('category_id') is-invalid @enderror">
                <option value="">Choose...</option>
                @foreach($categories as $category)
                <option
                  value="{{ $category->id }}"
                  @if($category->id == $post->category_id) selected @endif>{{ $category->title }}
                </option>
                @endforeach
              </select>
              @error('category_id')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>

            <label for="tags">Tags (comma seperated)</label>
            <div class="form-group">
              <input
                name="tags"
                type="text"
                class="form-control @error('tags') is-invalid @enderror"
                value="{{ old('tags') ?? $post->tags }}"
                placeholder="wizkid, davido"
              >
              @error('tags')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            
            <label for="desc">Description</label>
            <div class="form-group">
              <textarea name="desc" cols="30" class="form-control @error('desc') is-invalid @enderror" id="summernote">{{ old('desc') ?? $post->desc }}</textarea>
              @error('desc')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save Post</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection