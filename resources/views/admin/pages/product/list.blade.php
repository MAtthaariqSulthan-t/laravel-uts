@extends('admin.layouts.index')
@section('content')
<div class="col-sm-6">
    @if ($message = Session::get('notif'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
</div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $subtitle }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">add+</a>
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Categori</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Waight</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $item)
                        <tr>
                            {{-- <td class="row">{{ ($data->currentPage()-1) * $data->perPage() + $loop->iteration }}</td> --}}
                            <td>{{ $loop->iteration }}</td>
                            {{-- category mengambil dari mana dari tabel category melalui relasi product ke category--}}
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->status }}</td>
                            <td><img src="storage/{{ $item->image }}" alt="" width="50px"></td>
                            <td>{{ $item->weight }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('product.edit',['product'=>$item->id]) }}" class="btn btn-primary">Edit</a>
                                    </div>
                                    <form action="{{ route('product.destroy',['product'=>$item->id]) }}" method="post">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @method('delete')
                                    @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                  </tfoot>
                </table>
                <br>
                {{-- {{ $data->withQueryString()->links() }} --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
@endsection
