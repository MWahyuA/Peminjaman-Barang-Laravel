@extends('layout.master')
@section('content')
    <div class="container">
        <h4>Barang vendor</h4>
        <p>Kode Barang : {{ $data_barang->kode_barang }}</p>
        <p>Nama Barang : {{ $data_barang->nama_barang }}</p>
        <p>Stok Gudang : {{ $data_barang->stok }}</p>
        <table class="table table-bordered table-hover table-light">
            <thead>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Jumlah Yang dipinjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
            </thead>
            <tbody>
            @php $i = 1 @endphp
                @foreach($data_barang->peminjaman as $item)
                    @if($item->status == 1)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->data_peminjam['nama_peminjam'] }}</td>
                            <td>{{ $item->jml_pinjam }}</td>
                            <td>{{ $item->tgl_peminjaman }}</td>
                            <td>{{ $item->tgl_pengembalian }}</td>
                        </tr>
                        @php $i++ @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection