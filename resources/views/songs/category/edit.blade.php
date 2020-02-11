@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page__header">Edit Category: {{ $category->title }}</h3>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('song_categories.update', ['song_category' => $category]) }}">
                        @csrf
                        @method('PUT')

                        <label for="title">Category title</label>
                        <div class="form-group">
                            <input
                            name="title"
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') ?? $category->title }}"
                            >
                            @error('title')
                            <small class="form-text text-danger"><b>{{ $message }}</b></small>
                            @enderror
                        </div>

                        <label for="parent">Parent</label>
                        <div class="form-group">
                            <select class="custom-select" name="parent">
                                <option value="">None</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-dark float-right">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection