@extends('user.layouts.app')
@section('content')
<div class="container-fluid p-0">
  <a href="{{ route('songs.create') }}" class="btn btn-primary float-right mt-n1"><i class="fas fa-plus"></i> New song</a>
  <h1 class="h3 mb-3">Songs</h1>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          @if(isset($songs))
          <table id="datatables-reponsive" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($songs as $song)
              <tr>
                <td><img class="" src="{{ $song->thumbnail_url }}" width="60px" height="30px"></td>
                <td><a href="{{ $song->permalink }}" class="card-link">{{ $song->title }}</a></td>
                <td>{{ $song->created_at->diffForHumans() }}</td>
                <td><a href="{{ route('user.songs.edit', $song->id) }}" class="btn btn-info rounded-0 text-white">Edit</a><button class="btn btn-danger rounded-0">Delete</button></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon">
              <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
              <strong>Oops!</strong> No data to display
            </div>
          </div>
          @endif
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