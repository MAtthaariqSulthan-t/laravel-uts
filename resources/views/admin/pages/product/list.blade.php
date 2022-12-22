@extends('admin.layouts.index')
@section('content')
          <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @if ($message = Session::get('notif'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
            <h1>DataTablesProduct</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTablesProduct</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable Product</h3>
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
                            <td class="row">{{ $loop->iteration }}</td>
                            {{-- category mengambil dari mana --}}
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->description }}</td>
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
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
