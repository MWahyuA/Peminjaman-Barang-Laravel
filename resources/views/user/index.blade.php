@extends('layout.master')
@section('content')
    <div class="container">
        <br>
        <h1 style="text-align:center;">Data User</h1>
        @include('_partial/flash_message')
        <br>
        <table class="table table table-bordered table-hover table-light">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;?>
                @foreach($user_list as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level }}</td>
                    <td class="text-center"><a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm">Edit</a></td>
                    <td class="text-center">
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                                <button class="btn btn-danger btn-sm" 
                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pull-left">
            <strong>
                Jumlah Peminjam : {{ $jumlah_user }}
            </strong>
        </div>
    </div>
@endsection