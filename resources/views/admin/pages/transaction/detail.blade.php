@extends('admin.layouts.index')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaction detail</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <h5>Nama Pembeli : {{ $transaction->customer }}</h5>
                <h5>Alamat : {{ $transaction->address }}</h5>
                <h5>Total Harga : Rp. {{ $transaction->total_amount }} </h5>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>id</th>
                            <th>transaction_id</th>
                            <th>product</th>
                            <th>QTY</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->transaction_id }}</td>
                            <td>{{ $item->product->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
