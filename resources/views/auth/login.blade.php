@extends('layout.master_login')
@section('content')
<div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container vertical-center">
                        <div class="d-flex justify-content-center bg-light mb-3" style="border-radius: 30px;">
                            <!-- <div class="card shadow-lg border-0 rounded-lg"> -->
                                <div class="col-5">
                                    <img src="./foto_barang/inventory.png" alt="invetaris" style="width:100%;">
                                </div>
                                <div class="col-5">
                                    <div class="" style="margin-top:50px !important;"><h3 class="text-center font-weight-light my-4">Selamat Datang di LoInventory</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                                <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required autofocus>
                                                    <label for="staticEmail">Email</label>
                                                    <div class="invalid-feedback">
                                                        Email is invalid
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
                                                    <label for="inputPassword">Password</label>
                                                    <div class="invalid-feedback">
                                                        Password is required
                                                    </div>
                                                </div>
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-success message">LOGIN</button>
                                                </div>
                                                <div style="margin-top:20px">
                                                    <p>Belum punya akun ? <a href="{{ route('user.create') }}">Daftar disini</a></p>
                                                </div>
                                                <div style="margin-top:20px">
                                                    <label for="remember_me" class="inline-flex items-center">
                                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                                    </label>
                                                </div>
                                                <div style="margin-top:20px">
                                                    @if (Route::has('password.request'))
                                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                            {{ __('Forgot your password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </main>
            </div>
        </div>
        @endsection