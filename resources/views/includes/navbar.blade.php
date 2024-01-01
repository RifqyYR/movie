<nav class="navbar navbar-expand navbar-light bg-white topbar mb-3 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <div class="navbar-brand">
        <img src="{{ url('logo.png') }}" alt="logo aplikasi" width="300" height="80" class="ratio ratio-21x9">
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-black small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ url('backend/img/undraw_profile.svg') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                @if (Auth::user()->role == 'ADMIN')
                    <a class="dropdown-item" href="{{ url('register') }}">
                        Tambah User
                    </a>
                    <a class="dropdown-item" href="{{ url('user') }}">
                        Kelola User
                    </a>
                    <div class="dropdown-divider"></div>
                @elseif (Auth::user()->role != 'ADMIN')
                    <a class="dropdown-item" href="{{ url('/ganti-password/' . Auth::user()->uuid) }}">
                        Ubah Password
                    </a>
                @endif
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    Keluar
                </a>
            </div>
        </li>
    </ul>
</nav>
