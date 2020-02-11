@extends('user.layouts.app')
@section('content')
<div class="container-fluid p-0">
  <h1 class="h3 mb-3">Edit song</h1>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('songs.update', $song) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="prefix">Prefix</label>
            <div class="form-group">
              <input
              name="prefix"
              type="text"
              class="form-control @error('prefix') is-invalid @enderror"
              placeholder="e.g Davido, Popcan"
              value="{{ old('title') ?? $song->prefix }}"
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
              value="{{ old('title') ?? $song->title }}"
              >
              @error('title')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="artiste">Artiste(s)</label>
            <div class="form-group">
              <input
              name="artiste"
              type="text"
              class="form-control @error('artiste') is-invalid @enderror"
              placeholder="e.g Davido, Popcan"
              value="{{ old('artiste') ?? $song->artiste }}"
              >
              @error('artiste')
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
                    value="{{ $album->id }}" @if($album->id == $song->album_id) selected @endif>{{ $album->title }}
                  </option>
                  @endforeach
                </select>
                @error('artiste')
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
                    value="{{ $category->id }}" @if($category->id == $song->category_id) selected @endif>{{ $category->title }}
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
              value="{{ old('tags') ?? $song->tags }}"
              >
              @error('tags')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            <label for="desc">Description</label>
            <div class="form-group">
              <textarea name="desc" cols="30" class="form-control @error('desc') is-invalid @enderror" id="summernote">{{ old('desc') ?? $song->desc }}</textarea>
              @error('desc')
              <small class="form-text text-danger"><b>{{ $message }}</b></small>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary float-right">Save Song</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
$(function() {
// Datatables Responsive
$("#datatables-reponsive").DataTable({
responsive: true
});
});
</script>
@endsection