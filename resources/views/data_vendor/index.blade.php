@extends('layout.master')
@section('content')
    <div class="container-fluid">
    <br>
    <h1 style="text-align:center;">Data Vendor</h1>
    @include('_partial/flash_message')
    <br>
    <p align="right"><a href="{{ route('data_vendor.create') }}" class="btn btn-primary">Tambah Vendor</a></p>
        <table class="table table-bordered table-hover table-light">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Vendor</th>
                    <th>Nama Vendor</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;?>
                @foreach($data_vendor as $vendor)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $vendor->kode_vendor}}</td>
                    <td><a href="{{ route('data_vendor.detail_vendor', $vendor->id) }}">{{ $vendor->nama_vendor}}</a></td>
                    <td>{{ $vendor->nomor_telepon}}</td>
                    <td>{{ $vendor->email}}</td>
                    <td>{{ $vendor->alamat}}</td>
                    <td class="text-center"><a href="{{ route('data_vendor.edit', $vendor->id) }}" class="btn btn-success btn-sm">edit</a>
                    <td class="text-center">
                        <form action="{{ route('data_vendor.delete', $vendor->id) }}" method="POST">
                            @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pull-left">
            <strong>
                Jumlah vendor : {{ $jumlah_vendor }}
            </strong>
            <p>{{ $data_vendor->links() }}</p>
        </div>

    </div>
@endsection