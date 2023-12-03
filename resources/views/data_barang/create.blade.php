@extends('layout.master')
@section('content')
    <div class="container">
    <br>
    <h1 style="text-align:center;">Tambah Barang</h1>
        @if (count($errors) >0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}<li>
                @endforeach
            </ul>
        @endif
    <br>
        <form method="POST" action="{{ route('data_barang.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Nama Vendor</label>
                <select name="id_vendor" class="form-control" required>
                    <option value="">Pilih Vendor</option>
                        @foreach ($list_vendor as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                        @endforeach
                </select>
            <div class="form-group">
                <label>Stok</label>
                <input type="text" name="stok" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection