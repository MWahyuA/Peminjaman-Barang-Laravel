@extends('layout.master')
@section('content')
    <div class="container">
        <br>
        <h1 style="text-align:center;">Peminjaman</h1>
        @include('_partial/flash_message')
        <br>
        <p align="right"><a href="{{ route('peminjaman.create') }}" class="btn btn-primary">Tambah Data Peminjaman</a></p>
        <table class="table table-bordered table-hover table-light">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Pinjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                    <th class="text-center">Update</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;?>
                @foreach($data_peminjaman as $peminjaman)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $peminjaman->kode_peminjaman}}</td>
                    <td>{{ $peminjaman->data_peminjam['nama_peminjam']}}</td>
                    <td>{{ $peminjaman->data_barang['nama_barang']}}</td>
                    <td>{{ $peminjaman->jml_pinjam }}</td>
                    <td>{{ $peminjaman->tgl_peminjaman}}</td>
                    <td>{{ $peminjaman->tgl_pengembalian}}</td>
                    <td>@if ($peminjaman->status == 1)
                            <?php
                                $tanggal_hari_ini = date('d F Y');
                                $tanggal_kembali1 = $peminjaman->tgl_pengembalian;
                                if (strtotime($tanggal_hari_ini) < strtotime($tanggal_kembali1)) {
                                    echo "<b>Belum Dikembalikan.<b>";
                                } else {
                                    $waktu_kembali2 = date_create($tanggal_kembali1);
                                    $tanggal_hari_ini2 = date_create($tanggal_hari_ini);
                                    $diff = date_diff($waktu_kembali2, $tanggal_hari_ini2);
                                    echo "<span style='color: red; font-weight: bold;'>Belum Dikembalikan. (terlambat " . $diff->days . " hari)</span>";
                                }
                            ?>
                        @else
                            Telah Dikembalikan
                        @endif</td>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                    <td class="text-center">
                    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                            @csrf
                            @if ($peminjaman->status == 1)
                                <button class="btn btn-success btn-sm" onclick="return confirm('Anda yakin ingin mengupdate data ini?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </button>
                            @else
                                <button class="btn btn-success btn-sm" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>      
                                </button>
                            @endif
                    </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pull-left">
            <strong>
                Jumlah Peminjaman : {{ $jumlah_peminjaman }}
            </strong>
        </div>

    </div>
@endsection