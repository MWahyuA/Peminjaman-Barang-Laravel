@extends('layout.master')
@section('content')
    <div class="container">
        <br>
        <h1 style="text-align:center;">Tambah Transaksi Peminjaman</h1>
         @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}<li>
                @endforeach
            </ul>
        @endif
        <br>
        <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf
            <div class="form-group">
                <input type="hidden" name="tgl_peminjaman" class="form-control" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="tgl_pengembalian" class="form-control" value="{{ date('Y-m-d', strtotime('+15 day', strtotime(date('Y-m-d')))) }}">
                <input type="hidden" name="status" class="form-control" value="1">
            </div>
            <div class="form-group">
                <label>Nama Peminjam</label>
                @if (auth()->user()->level == 'admin')
                <select name="id_peminjam" class="form-control" required>
                    <option value="">Pilih Nama Peminjam</option>
                    @foreach ($list_data_peminjam as $key => $value)
                        <option value="{{ $key }}">
                           {{ $value }}
                        </option>
                    @endforeach
                </select>
                @else
                <input readonly class="form-control" value="{{ $nama_peminjam }}">
                <input type="hidden" name="id_peminjam" value="{{ $list_data_peminjam }}">
                @endif
                
            </div>
            <div class="form-group">
                <label for="">Nama Barang</label>
                <select name="id_barang" class="form-control" required>
                    <option value="">Pilih Nama Barang</option>
                        @foreach ($list_data_barang as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah Pinjam</label>
                <input type="text" name="jml_pinjam" class="form-control" required>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>

@endsection