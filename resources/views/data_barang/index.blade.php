@extends('layout.master')
@section('content')
    <div class="container-fluid">
    <br>
    <h1 style="text-align:center;">Data Barang</h1>
    @include('_partial/flash_message')
    <br>
    @if (Auth::check() && Auth::user()->level == 'admin')
    <p align="right"><a href="{{ route('data_barang.create') }}" class="btn btn-primary">Tambah Barang</a></p>
    @endif
        <table class="table table-bordered table-hover table-light">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Nama Vendor</th>
                    <th>Stok</th>
                    <th class="text-center">foto</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                    <th class="text-center">Edit</th>
                    <th class="text-center">Hapus</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;?>
                @foreach($data_barang as $barang)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $barang->kode_barang}}</td>
                    <td>@if (Auth::check() && Auth::user()->level == 'admin')
                            <a href="{{ route('data_barang.detail_barang', $barang->id) }}">
                        @endif
                        {{ $barang->nama_barang}}</td>
                    <td> {{ $barang->data_vendor['nama_vendor'] }}</td>
                    <td>{{ $barang->stok}}</td>
                    <td class="text-center">
                         @if(empty($barang->foto))
                         <img src="{{ asset('foto_barang/foto_barang_kosong.jpg') }}" alt="" style="width:100px; height:100px">
                         @else
                         <img src="{{ asset('foto_barang/'.$barang->foto) }}" alt="" style="width:100px; height:100px">
                         @endif
                    </td>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                    <td class="text-center"><a href="{{ route('data_barang.edit', $barang->id) }}" class="btn btn-success btn-sm">edit</a></td>
                    <td class="text-center">
                        <form action="{{ route('data_barang.destroy', $barang->id) }}" method="POST">
                            @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pull-left">
            <strong>
                Jumlah Barang : {{ $jumlah_barang }}
            </strong>
            <p>{{ $data_barang->links() }}</p>
        </div>

    </div>
@endsection