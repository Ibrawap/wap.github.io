@extends('layouts.app')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('songs.index') }}">Song</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add new</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12">
      <div class="card bd-rd-20">
        <div class="card-body">
          <form method="POST" action="{{ route('songs.store') }}" enctype="multipart/form-data">
            @csrf
            <label for="prefix">Prefix</label>
            <div class="form-group">
              <input
              name="prefix"
              type="text"
              class="form-control @error('prefix') is-invalid @enderror"
              placeholder="Music"
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
              placeholder="e.g Davido - Risky feat. Popcan"
              value="{{ old('title') }}"
              >
              @error('title')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="song_url">Mp3 Url</label>
            <div class="form-group">
              <input
              type="text"
              name="song_url"
              class="form-control  @error('song_url') is-invalid @enderror"
              value="{{ old('song_url') }}"
              placeholder="https://www.example.com/we-learn-kate-henshaw-reacts-video.mp3"
              >
            </div>
            <label for="thumbnail_url">Thumbnail Url</label>
            <div class="form-group">
              <input
              type="text"
              name="thumbnail_url"
              class="form-control @error('thumbnail_url') is-invalid @enderror"
              value="{{ old('thumbnail_url') }}"
              placeholder="https://www.example.com/we-learn-kate-henshaw-reacts-video.png"
              >
            </div>
            
            <label for="artiste">Artiste</label>
            <div class="form-group">
              <input
              name="artiste"
              type="text"
              class="form-control @error('artiste') is-invalid @enderror"
              placeholder="e.g Wizkid"
              value="{{ old('artiste') }}"
              >
              @error('artiste')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>

            <label for="featuring">featuring</label>
            <div class="form-group">
              <input
              name="featuring"
              type="text"
              class="form-control @error('featuring') is-invalid @enderror"
              placeholder="e.g Davido, Popcan"
              value="{{ old('featuring') }}"
              >
              @error('featuring')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>

            <div class="form-row">
              <div class="form-group col-6">
              <label for="album">Album</label>
                <select
                  name="album_id"
                  class="custom-select @error('album_id') is-invalid @enderror"
                  >
                  <option value="">Choose...</option>
                  @foreach($albums as $album)
                  <option
                    value="{{ $album->id }}">{{ $album->name }}
                  </option>
                  @endforeach
                </select>
                @error('album')
                <small class="form-text text-danger"><b>{{ $message }}</b></small>
                @enderror
              </div>
              
              <div class="form-group col-6">
                <label for="category_id">Category</label>
                <select
                  name="category_id"
                  class="custom-select @error('category_id') is-invalid @enderror"
                  >
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
            </div>
            <label for="tags">Tag(s)</label>
            <div class="form-group">
              <input
              name="tags"
              type="text"
              class="form-control @error('tags') is-invalid @enderror"
              placeholder="e.g Davido, Popcan"
              value="{{ old('tags') }}"
              >
              @error('tags')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="desc">Description</label>
            <div class="form-group">
              <textarea name="desc" cols="30" class="form-control @error('desc') is-invalid @enderror" id="summernote">{{ old('desc') }}</textarea>
              @error('desc')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Save song</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection