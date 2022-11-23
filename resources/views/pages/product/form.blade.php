@extends('layouts.dashboard')
@section('content')
<div class="container mt-4">
<h1>{{ $product->id ? "Edit" : "Create" }}</h1>
@if ($product->id)
    <form action="{{ route('product.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">

@endif
    @csrf
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="{{ $product->title }}">
    @error('title') <div class="text-muted">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Category Product</label>
    <select name="category_id" id="category_id" class="form-select">
        @foreach ($categories as $category)
        <option value=" {{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id') <div class="text-muted">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Status</label>
    <select name="status" id="status" class="form-select">
        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
    </select>
    @error('status') <div class="text-muted">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
    @error('description') <div class="text-muted">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="formFile" class="form-label">Input Image</label>
    <input class="form-control" name="image" type="file" id="formFile">
    @error('image') <div class="text-muted">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Weight</label>
    <input type="text" class="form-control" name="weight" id="exampleFormControlInput1" value="{{ $product->weight }}">
    @error('weight') <div class="text-muted">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Price</label>
    <input type="text" class="form-control" name="price" id="exampleFormControlInput1" value="{{ $product->price }}">
    @error('price') <div class="text-muted">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-primary mb-3">Confirm</button>
  </div>
</form>
</div>
@endsection
