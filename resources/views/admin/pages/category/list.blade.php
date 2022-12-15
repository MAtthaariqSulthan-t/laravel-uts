@extends('admin.layouts.index')
@section('content')
          <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTablesCategory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTablesCategory</li>
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
                <h3 class="card-title">DataTable Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add+</a>
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>DESCRIPTION</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td>{{ ($data->currentPage() -1) * $data->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('category.edit', ['category'=> $item->id]) }}" class="btn btn-primary">Edit</a>
                            </div>
                        <form action="{{ route('category.destroy', ['category'=> $item->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        </div>
                    </td>
                  </tr>
                @endforeach
                  </tfoot>
                </table>
                <br>
                {{ $data->withQueryString()->links() }}
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
