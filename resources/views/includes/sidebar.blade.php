<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion toggled" id="accordionSidebar"
    style="background-color: #00a651 !important">

    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link nav-link-item" href="{{ url('/') }}">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" height="24" width="22"
                viewBox="0 0 576 512">
                <path fill="#ffffff"
                    d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z" />
            </svg>
            <span style="font-size: 10px">Dashboard</span>
        </a>
    </li>

    <li
        class="nav-item {{ Route::is('claim.fkrtl') || (Route::is('claim.create.show') && session('routeFrom') == 'fkrtl') || (Route::is('claim.edit.show') && session('routeFrom') == 'fkrtl') ? 'active' : '' }}">
        <a class="nav-link nav-link-item" href="{{ url('/claim-fkrtl') }}">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" height="22" width="24"
                viewBox="0 0 448 512">
                <path fill="#ffffff"
                    d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192zM224 248c13.3 0 24 10.7 24 24v56h56c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v56c0 13.3-10.7 24-24 24s-24-10.7-24-24V376H144c-13.3 0-24-10.7-24-24s10.7-24 24-24h56V272c0-13.3 10.7-24 24-24z" />
            </svg>
            <span style="font-size: 10px;" class="mt-1">SLA Klaim <b>FKRTL</b></span>
        </a>
    </li>

    <li
        class="nav-item {{ Route::is('claim.fktp') || (Route::is('claim.create.show') && session('routeFrom') == 'fktp') || (Route::is('claim.edit.show') && session('routeFrom') == 'fktp') ? 'active' : '' }}">
        <a class="nav-link nav-link-item" href="{{ url('/claim-fktp') }}">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" height="22" width="24"
                viewBox="0 0 448 512">
                <path fill="#ffffff"
                    d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm80 64c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h96c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80z" />
            </svg>
            <span style="font-size: 10px;" class="mt-1">SLA Klaim <b>FKTP</b></span>
        </a>
    </li>

    <li
        class="nav-item {{ Route::is('absent-claim') || Route::is('absensi.fkrtl') || Route::is('absensi.fktp') ? 'active' : '' }}">
        <a class="nav-link nav-link-item" href="{{ url('/claim-absensi') }}">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" height="22" width="24"
                viewBox="0 0 512 512">
                <path fill="#ffffff"
                    d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
            </svg>
            <span style="font-size: 10px;" class="mt-1">Absensi Klaim</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('history') ? 'active' : '' }}">
        <a class="nav-link nav-link-item" href="{{ url('/history') }}">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" height="22" width="22"
                viewBox="0 0 512 512">
                <path fill="#ffffff"
                    d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z" />
            </svg>
            <span style="font-size: 10px;" class="mt-1">Riwayat</span>
        </a>
    </li>

    <li
        class="nav-item {{ Route::is('archive') || Route::is('archive.create') || Route::is('archive.edit') ? 'active' : '' }}">
        <a class="nav-link nav-link-item" href="{{ url('/arsip') }}">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" height="22" width="22"
                viewBox="0 0 640 512">
                <path fill="#ffffff"
                    d="M256 48c0-26.5 21.5-48 48-48H592c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H381.3c1.8-5 2.7-10.4 2.7-16V253.3c18.6-6.6 32-24.4 32-45.3V176c0-26.5-21.5-48-48-48H256V48zM571.3 347.3c6.2-6.2 6.2-16.4 0-22.6l-64-64c-6.2-6.2-16.4-6.2-22.6 0l-64 64c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L480 310.6V432c0 8.8 7.2 16 16 16s16-7.2 16-16V310.6l36.7 36.7c6.2 6.2 16.4 6.2 22.6 0zM0 176c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H16c-8.8 0-16-7.2-16-16V176zm352 80V480c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V256H352zM144 320c-8.8 0-16 7.2-16 16s7.2 16 16 16h96c8.8 0 16-7.2 16-16s-7.2-16-16-16H144z" />
            </svg>
            <span style="font-size: 10px;" class="mt-1">Arsip</span>
        </a>
    </li>

    <li
        class="nav-item {{ Route::is('notes*') ? 'active' : '' }}">
        <a class="nav-link nav-link-item" href="{{ url('/notes') }}">
            <img class="sidebar-icon" src="{{ url('writing-tool-white.svg') }}" width="22">
            <span style="font-size: 10px;" class="mt-1">Catatan</span>
        </a>
    </li>

    {{-- <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}
</ul>
<!-- End of Sidebar -->
