@extends('layout.master')
@section('content')
<div>
    <div class="container">
        <br>
        <h1 style="text-align:center;">Register User</h1>
         @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}<li>
                @endforeach
            </ul>
        @endif
        <br>
        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Nama') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            <div class="form-group">
                <label for="name">{{ __('Alamat Email') }}</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="form-group">
                <label for="name">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                value="{{ old('password') }}" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="form-group">
                <label for="name">{{ __('Confirm Password') }}</label><br>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password_confirmation"
                                required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="form-group">
                <label for="level" name="level">Level</label>
                <select name="level" id="level" class="form-control">
                        <option value="peminjam">Peminjam</option>
                        <option value="admin">Admin</option>
                </select>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-success">
                    {{ __('Create') }}
                </button>
                <a href="{{ route('login') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection