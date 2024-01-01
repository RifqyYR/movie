<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MOVIE | Monitoring Verifikasi E-Claim</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" href="https://bpjs-kesehatan.go.id/assets/img/favicon.png" type="image/x-icon">
    <link rel="icon" href="https://bpjs-kesehatan.go.id/assets/img/favicon.png" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .login-logo {
            display: flex !important;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="bg-image"
    @php
if (Request::is('login')) {
        echo 'style="background-image: url(\'bg.jpg\'); background-size: cover; background-repeat: no-repeat; height: 100vh;"';
        // echo 'style="background-color: black"';
    } @endphp>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
