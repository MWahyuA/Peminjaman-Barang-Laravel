@extends('layout.master')
@section('content')
    <div class="container">
    <br>
    <h1 style="text-align:center;">Edit Vendor</h1>
    <br>
        <form method="POST" action="{{ route('data_vendor.update', $vendor->id) }}">
        @csrf
            <div class="form-group">
                <label>Kode Vendor</label>
                <input type="text" name="kode_vendor" class="form-control" value="{{ $vendor->kode_vendor }}" readonly>
            </div>
            <div class="form-group">
                <label>Nama Vendor</label>
                <input type="text" name="nama_vendor" class="form-control" value="{{ $vendor->nama_vendor }}">
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" value="{{ $vendor->nomor_telepon }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="{{ $vendor->email }}">
            </div>
            <div class="form-group">
                <label>Alamat</label><br>
                <textarea name="alamat" id="" cols="148" rows="3">{{ $vendor->alamat }}</textarea>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection