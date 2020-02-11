@extends('layouts.app')
@section('content')
<div class="container py-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('albums.index') }}">Album</a></li>
      <li class="breadcrumb-item active" aria-current="page">New</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card bd-rd-20">
        <div class="card-body">
          <form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
            @csrf
            <label for="name">Prefix</label>
            <div class="form-group">
              <input
              type="text"
              name="prefix"
              class="form-control  @error('prefix') is-invalid @enderror"
              value="{{ old('prefix') }}"
              placeholder="Download Album"
              >
              @error('prefix')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="title">Album title</label>
            <div class="form-group">
              <input
              type="text"
              name="title"
              class="form-control  @error('title') is-invalid @enderror"
              value="{{ old('title') }}"
              placeholder="African Giant"
              >
              @error('title')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="thumbnail_url">Album art</label>
            <div class="form-group">
              <input
              type="text"
              name="thumbnail_url"
              class="form-control @error('thumbnail_url') is-invalid @enderror"
              value="{{ old('thumbnail_url') }}"
              placeholder="https://www.example.com/we-learn-kate-henshaw-reacts-video.png"
              >
              @error('thumbnail_url')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            
            <label for="artiste">Artiste</label>
            <div class="form-group">
              <input
              type="text"
              name="artiste"
              class="form-control @error('artiste') is-invalid @enderror"
              value="{{ old('artiste') }}"
              placeholder="Burna boy"
              >
              @error('artiste')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="released_date">Released date</label>
            <div class="form-group">
              <input
              type="date"
              name="released_date"
              class="form-control @error('released_date') is-invalid @enderror"
              value="{{ old('released_date') }}"
              >
              @error('released_date')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="desc">Album Desc</label>
            <div class="form-group">
              <textarea name="desc" cols="30" class="form-control @error('desc') is-invalid @enderror" id="summernote">{{ old('desc') }}</textarea>
              @error('desc')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Save album</button>
            {{ dd($errors) }}
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection