@extends('layout.master')
@section('content')
    <div class="container">
        <h4>Barang vendor</h4>
        <p>Kode Vendor : {{ $data_vendor->kode_vendor }}</p>
        <p>Nama Peminjam : {{ $data_vendor->nama_vendor }}</p>
        <table class="table table-bordered table-hover table-light">
            <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok</th>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach($data_vendor->data_barang as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->stok }}</td>
                </tr>
                @php $i++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection