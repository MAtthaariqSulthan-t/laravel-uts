@extends('layouts.dashboard')
@section('content')
<div class="container mt-4">
@if ($message = Session::get('notif'))
    <div class="alert alert-success" role="alert">
        <strong>{{ $message }}</strong>
    </div>
@endif
<a href="{{ route('product.create') }}" class="btn btn-primary">Add+</a>
<form class="row g-3 mt-3" action="{{ route('product.index') }}" method="GET">
    <div class="col-auto">
        <select name="filter" id="filter" class="form-select">
            <option value="">All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('filter') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <label for="search" class="visually-hidden"></label>
        <input type="text" name="search" class="form-control" id="search" placeholder="Search"
            value="{{ request('search') }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Cari</button>
    </div>
</form>
<table class="table mt-3">
    <thead>
      <tr>
        <th scope="col" class="table-dark">#</th>
        <th scope="col" class="table-dark">Title</th>
        <th scope="col" class="table-dark">Category</th>
        <th scope="col" class="table-dark">Status</th>
        <th scope="col" class="table-dark">Description</th>
        <th scope="col" class="table-dark">Image</th>
        <th scope="col" class="table-dark">Weight</th>
        <th scope="col" class="table-dark">Price</th>
        <th scope="col" class="table-dark">Action</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($data as $item)
      <tr>
        {{-- iteration untuk auto number --}}
        <th scope="row">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</th>
        <td>{{ $item->title }}</td>
        <td>{{ $item->category->name }}</td>
        <td>{{ $item->status }}</td>
        <td>{{ $item->description }}</td>
        <td><img src="storage/{{ $item->image }}" alt="" width="50px"></td>
        <td>{{ $item->weight }}</td>
        <td>{{ $item->price }}</td>
        <td>
            {{-- route untuk  --}}
            <div class="row">
                <div class="col">
                    <a href="{{ route('product.edit', ['product' => $item->id]) }}" class="btn btn-primary">Edit</a>
                </div>
                <div class="col">
            <form action="{{ route('product.destroy', ['product' => $item->id]) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
                </div>
            </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{-- {{ $data->links() }} --}}
  {{ $data->withQueryString()->links() }}
</div>
@endsection
