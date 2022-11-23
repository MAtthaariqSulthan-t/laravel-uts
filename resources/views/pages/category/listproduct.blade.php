@extends('layouts.dashboard')
@section('content')
<div class="container-fluid mt-4">
<h3>Product {{ $data->name }}</h3>
<p>Jumlah Product : {{ count($data->products) }}</p>
{{-- caralain penggunaan count --}}
{{-- <p>Jumlah Siswa : {{ $data->students->count() }}</p> --}}
<table class="table mt-2 table-hover">
    <thead>
      <tr>
        <th scope="col" class="table-dark radius-1">#</th>
        <th scope="col" class="table-dark">Product Name</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
    @foreach ($data->products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product ->title }}</td>
        </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection
