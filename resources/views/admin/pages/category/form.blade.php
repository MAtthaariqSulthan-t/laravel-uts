@extends('layouts.dashboard')
@section('content')
<div class="container mt-4"></div>
<h1>{{ $category->id ? "Edit" : "Create" }}</h1>
@if ($category->id)
    <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post">
    @method('PUT')
@else
    <form action="{{ route('category.store') }}" method="post">
@endif
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $category->name }}">
        @error('name')<div class="text-muted">{{$message}}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Description</label>
        <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $category->description }}</textarea>
        @error('description')<div class="text-muted">{{$message}}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="#">All</option>
            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }} >Active</option>
            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }} >Inactive</option>
        </select>
        @error('status')<div class="text-muted">{{$message}}</div> @enderror
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/category" class="btn btn-danger">Back</a>
</form>
@endsection
