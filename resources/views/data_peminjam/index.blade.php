@extends('layout.master')
@section('content')
    <div class="container-fluid">
    <br>
    <h1 style="text-align:center;">Data Peminjam</h1>
    @include('_partial/flash_message')
    <br>
        <table class="table table-bordered table-hover table-light">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Peminjam</th>
                    <th>Nama Peminjam</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Pekerjaan</th>
                    <th>Nomor Telepon</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;?>
                @foreach($data_peminjam as $peminjam)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $peminjam->kode_peminjam}}</td>
                    <td>{{ $peminjam->nama_peminjam}}</td>
                    <td>{{ $peminjam->jenis_kelamin['nama_jenis_kelamin']}}</td>
                    <td>{{ $peminjam->tanggal_lahir}}</td>
                    <td>{{ $peminjam->alamat}}</td>
                    <td>{{ $peminjam->pekerjaan}}</td>
                    <td>{{ $peminjam->nomor_telepon }}</td>
                    <td class="text-center">
                         @if(empty($peminjam->foto))
                         <img src="{{ asset('foto_peminjam/foto_peminjam_kosong.png') }}" alt="" style="width:100px; height:100px">
                         @else
                         <img src="{{ asset('foto_peminjam/'.$peminjam->foto) }}" alt="" style="width:100px; height:100px">
                         @endif
                    </td>
                    <td class="text-center"><a href="{{ route('data_peminjam.edit', $peminjam->id) }}" class="btn btn-success btn-sm">edit</a>
                    <td class="text-center">
                        <form action="{{ route('data_peminjam.destroy', $peminjam->id) }}" method="POST">
                            @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pull-left">
            <strong>
                Jumlah Peminjam : {{ $jumlah_peminjam }}
            </strong>
            <p>{{ $data_peminjam->links() }}</p>
        </div>

    </div>
@endsection