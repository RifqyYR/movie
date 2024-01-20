@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ubah Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('proses-ganti-password/' . Auth::user()->uuid) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="password" autofocus onkeyup="check()">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirmPassword"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        name="confirmPassword" required autocomplete="confirmPassword" onkeyup="check()">
                                    <span id="message"></span>

                                    @error('confirmPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('user') }}">
                                        <button type="button" class="btn btn-danger" style="width: 7rem;">
                                            Kembali
                                        </button>
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #2E3192;">
                                        Ubah Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function check() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            if (password.value == confirmPassword.value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Sama';
                document.getElementById('btn-edit').disabled = false;
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Tidak sama';
                document.getElementById('btn-edit').disabled = true;
            }
        }
    </script>
@endsection
