@extends('layout.master')
@section('content')
    <div>
        <div class="container">
            <div class="col-md-8">
                <div class="card-header">{{ _('Edit User')}}</div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id)}}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ _('Nama')}}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div>
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ _('Alamat Email')}}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $user->email) }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div>
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ _('Password')}}</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                value="{{ old('password', $user->password) }}" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div>
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ _('Confirm Password')}}</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                            value="{{ old('password', $user->password) }}" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong> 
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div>
                        <label for="level" class="col-md-4 col-form-label text-md-right">level</label>
                        <div class="col-md-6">
                            <select name="level" id="level" value="{{ $user->level}}" class="form-control">
                                <option value="peminjam" <?php if($user->level =='peminjam') echo 'selected="selected"'; ?>>Peminjam</option>
                                <option value="admin" <?php if($user->level =='admin') echo 'selected="selected"'; ?>>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ _('Edit')}}
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection