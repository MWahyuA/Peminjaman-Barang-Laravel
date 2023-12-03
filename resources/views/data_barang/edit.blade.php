@extends('layout.master')
@section('content')
    <div class="container">
    <br>
    <h1 style="text-align:center;">Edit Data Barang</h1>
    <br>
        <form method="POST" action="{{ route('data_barang.update', $barang->id) }}"  enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" readonly class="form-control" value="{{ $barang->kode_barang }}">
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
            </div>
            <div class="form-group">
                <label>Nama Vendor</label><br>
                <select name="id_vendor">
                    <option value="">Pilih Vendor</option>
                    @foreach($list_vendor as $key => $value)
                    <option value="{{ $key }}" {{$barang->id_vendor == $key ? 'selected' : ""}}>
                        {{ $value }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="text" name="stok" class="form-control" value="{{ $barang->stok }}">
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