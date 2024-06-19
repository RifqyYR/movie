@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h5 mb-0 text-gray-800" style="color: #ff8000 !important;">Riwayat</h1>
            <a href="/claim/export-riwayat" class="btn btn-sm btn-success btn-export" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="#ffffff"
                        d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                </svg>
                Export Excel</a>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered-black table-hover"
                        @php
if (!$claims->isEmpty()) {
                            echo 'id="history-table"';
                        } @endphp>
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle custom-col">No</th>
                                <th scope="col" class="text-center align-middle custom-col">
                                    Nama Faskes
                                </th>
                                <th scope="col" class="text-center align-middle custom-col">
                                    Jenis Klaim
                                </th>
                                <th scope="col" class="text-center align-middle custom-col">Tingkat</th>
                                <th scope="col" class="text-center align-middle custom-col">
                                    Bulan
                                    Pelayanan</th>
                                <th scope="col" class="text-center align-middle custom-col">
                                    Tanggal<br>
                                    <span class="text-nowrap">BA Lengkap</span>
                                </th>
                                <th scope="col" class="text-center align-middle custom-col">
                                    Tanggal<br>
                                    <span class="text-nowrap">Jatuh Tempo</span>
                                </th>
                                <th scope="col" class="text-center align-middle custom-col">Tanggal Pembayaran</th>
                                <th scope="col" class="text-center align-middle custom-col">Status</th>
                                <th scope="col" class="text-center align-middle custom-col">No Register BOA</th>
                                @if (Auth::user()->role == 'ADMIN')
                                    <th scope="col" class="text-center align-middle custom-col">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($claims->isEmpty())
                                @if (auth()->user()->role == 'ADMIN')
                                    <tr>
                                        <td colspan="11" class="text-center fw-bold table-custom-fs-larger">Tidak ada data
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center fw-bold table-custom-fs-larger">Tidak ada data
                                        </td>
                                    </tr>
                                @endif
                            @else
                                @foreach ($claims as $item)
                                    <tr>
                                        <td class="text-center align-middle fw-bold table-custom-fs">
                                            {{ $loop->index + 1 }} </td>
                                        <td class="align-middle fw-bold table-custom-fs text-nowrap">
                                            {{ $item->hospital_name }} </td>
                                        <td class="align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                                            {{ $item->claim_type }} </td>
                                        <td class="align-middle fw-bold text-nowrap text-center table-custom-fs">
                                            {{ $item->hospital->level }}
                                        </td>
                                        <td
                                            class="text-center align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                                            {{ $item->month }} </td>
                                        <td
                                            class="text-center align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                                            {{ $item->file_completeness }}
                                        </td>
                                        <td
                                            class="text-center align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                                            {{ $item->completion_limit_date }}
                                        </td>
                                        <td
                                            class="text-center align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                                            {{ $item->ba_date }} </td>
                                        <td class="align-middle fw-bold text-nowrap table-custom-fs">
                                            @php
                                                if (
                                                    auth()->user()->role == 'VERIFICATOR' ||
                                                    auth()->user()->role == 'ADMIN'
                                                ) {
                                                    if ($item->status == App\Models\Claim::STATUS_TELAH_BAYAR) {
                                                        echo '<a class="text-black link-status" href="#" id="badropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="fw-bold" style="0.7rem;">' .
                                                            $item->status .
                                                            '</span>
                                                            </a>';
                                                        echo '<div class="dropdown-menu dropdown-menu-bottom shadow" aria-labelledby="#badropdown">
                                                                <a class="dropdown-item px-3 text-black" href="/claim/download/' .
                                                            $item->uuid .
                                                            '" target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#000000" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                                                                    Download Lembar APA
                                                                </a>
                                                            </div>';
                                                    } else {
                                                        echo $item->status;
                                                    }
                                                } else {
                                                    echo $item->status;
                                                }
                                            @endphp
                                        </td>

                                        <td class="align-middle fw-bold text-nowrap table-custom-fs ">
                                            <b>RI</b>:
                                            {{ $item->ritl_number == '' ? '' : $item->ritl_number }}<br>
                                            <b>RJ</b>: {{ $item->rjtl_number == '' ? '' : $item->rjtl_number }}
                                        </td>
                                        @if (Auth::user()->role == 'ADMIN')
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteClaimModal"
                                                        onclick="deleteClaim('{{ $item->uuid }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                            viewBox="0 0 448 512">
                                                            <style>
                                                                svg {
                                                                    fill: #ffffff
                                                                }
                                                            </style>
                                                            <path
                                                                d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="deleteClaimModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger fw-bold" id="exampleModalLabel">
                                                        Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus item ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        id="btn-delete">Batal</button>
                                                    <a id="deleteClaimLink" href="">
                                                        <button type="button" class="btn btn-danger">Hapus</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
