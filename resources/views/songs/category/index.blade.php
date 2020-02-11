@extends('layouts.app')

@section('content')

    <h3 class="page__header">
        Categories
    </h3>
    <div class="row mb-2">
        <div class="col">
        </div>
        <div class="col">
          <a href="{{ route('song_categories.create') }}" class="btn btn-dark float-right"><i class="fas fa-pencil-alt"></i> Add category</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Parent</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                {{ $category->title }}
                            </td>
                            <td>
                                {{ $category->parent->title ?? null }}
                            </td>
                            <td>
                                <form action="{{ route('song_categories.destroy', $category) }}" method="post">
                                    @method('DELETE')

                                    @csrf
                                    
                                <button type="submit" class="btn btn-sm btn-danger float-right">
                                    <i class="fa fa-trash"></i>
                                </button>
                                </form>
                                <a href="{{ route('song_categories.edit', $category) }}" class="btn btn-sm btn-primary float-right">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                         <tr>
                             <td colspan="3">
                                 <div class="alert alert-danger" role="alert">
                                    Oops... Nothing to show
                                </div>
                             </td>
                         </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection