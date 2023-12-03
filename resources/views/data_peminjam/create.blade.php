@extends('layout.master')
@section('content')
    <div class="container">
    <br>
    <h1 style="text-align:center;">Tambah Data Peminjam</h1>
        @if (count($errors) >0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}<li>
                @endforeach
            </ul>
        @endif
    <br>
        <form method="POST" action="{{ route('data_peminjam.store') }}" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        @csrf
            <div class="form-group">
                <label>Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" value="{{ $name }}">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label><br>
                <textarea name="alamat" id="" cols="148" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="id_jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                        @foreach ($list_jenis_kelamin as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <br>
            <div>
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
    </div>
@endsection