@extends('layout.master')
@section('content')
    <div class="container">
    <br>
    <h1 style="text-align:center;">Tambah Data Vendor</h1>
        @if (count($errors) >0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}<li>
                @endforeach
            </ul>
        @endif
    <br>
        <form method="POST" action="{{ route('data_vendor.store') }}">
        @csrf
            <div class="form-group">
                <label>Nama Vendor</label>
                <input type="text" name="nama_vendor" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label><br>
                <textarea name="alamat" id="" cols="148" rows="3" required></textarea>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection