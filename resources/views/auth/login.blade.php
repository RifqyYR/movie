@extends('layouts.app') @section('content')
    <div class="container" style="width: 75vw; height: 90vh;">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div
                                class="col-md-6 d-lg-none d-md-block bg-login-image d-lg-flex align-content-center align-items-center">
                                <img src="{{ url('logo.png') }}" alt="logo aplikasi"
                                    class="ratio ratio-16x9 img-fluid mx-auto d-block mt-5" style="width: 45vw; height: 10vh; margin-bottom: -7vh" />
                            </div>
                            <div class="col-lg-6 d-none d-lg-block bg-login-image d-lg-flex align-content-center align-items-center"
                                style="border-right: 2px solid #04748d !important;">
                                <img src="{{ url('logo.png') }}" alt="logo aplikasi"
                                    class="ratio ratio-16x9 img-fluid mx-auto d-block" style="width: 300px;" />
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <h1 style="color: #fc7f01 !important;" class="fw-bold fs-5 mb-3 text-center">
                                        Selamat Datang
                                    </h1>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input id="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror" name="username"
                                                value="{{ old('username') }}" required placeholder="Masukkan Username..."
                                                autofocus />

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password" placeholder="Password" />

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="background-color: #2E3192">
                                            {{ __('Login') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
