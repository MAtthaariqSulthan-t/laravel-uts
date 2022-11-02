@extends('layouts.dashboard')
@section('content')
<div class="container-fluid mt-4"></div>
@if ($message = Session::get('notif'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
<a href="{{ route('category.create') }}" class="btn btn-primary">Add+</a>
<table class="table mt-2 table-hover">
    <thead>
      <tr>
        <th scope="col" class="table-dark radius-1">#</th>
        <th scope="col" class="table-dark">Name</th>
        <th scope="col" class="table-dark">Description</th>
        <th scope="col" class="table-dark">status</th>
        <th scope="col" class="table-dark">Action</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
    @foreach ($data as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->status }}</td>
            <td>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('category.edit', ['category' => $item->id]) }}" class="btn btn-primary col-md-12">Edit</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('category.show', ['category' => $item->id]) }}" class="btn btn-info col-md-12">Products</a>
                    </div>
                <div class="col-md-4">
                    <form action="{{ route('category.destroy', ['category' => $item->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger col-md-12">Delete</button>
                    </form>
                </div>
                </div>
            </div>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
@endsection
