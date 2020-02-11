@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3 class="page__header">Add Category</h3>
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('video_categories.store') }}">
            @csrf
            <label for="title">Category title</label>
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
            <button type="submit" class="btn btn-dark float-right">Save Category</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection