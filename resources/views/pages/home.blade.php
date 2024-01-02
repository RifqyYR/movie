@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        @if (auth()->user()->telegram_chat_id)
            <form action="/message" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <input id="message" type="text" class="form-control" name="message" value="{{ old('message') }}"
                        required placeholder="Masukkan pesan..." autofocus />
                    <button type="submit" class="btn btn-primary" style="background-color: #2E3192">
                        {{ __('Send') }}
                    </button>
                </div>
            </form>
        @else
            <script async src="https://telegram.org/js/telegram-widget.js?22" type="application/javascript" data-telegram-login="{{ config('services.telegram-bot-api.name') }}" data-size="large"
        data-auth-url="{{ route('telegram.connect') }}"    
        data-request-access="write"></script>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h5 mb-0 text-gray-800" style="color: #fc7f01 !important;">Dashboard SLA Klaim</h1>
        </div>
        <div class="d-sm-flex">
            <a href="{{ url('/claim/buat') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm text-center py-3"
                style="position: fixed; right: 0; bottom: 0; margin: 20px; width: 60px; height: 60px; border-radius: 50%; padding: 10px; z-index: 1; opacity: 80%;">
                <svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" height="25" width="25"
                    viewBox="0 0 448 512">
                    <path fill="#ffffff"
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
            </a>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="table-responsive" id="demo">
                    <table class="table table-sm table-bordered-black">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle">No</th>
                                <th scope="col" class="text-center align-middle">Nama Faskes</th>
                                <th scope="col" class="text-center align-middle">Jenis Klaim</th>
                                <th scope="col" class="text-center align-middle text-nowrap">Bulan Pelayanan</th>
                                <th scope="col" class="text-center align-middle text-nowrap">Tanggal Pembuatan BA</th>
                                <th scope="col" class="text-center align-middle text-nowrap">Jatuh Tempo</th>
                                <th scope="col" class="text-center align-middle">Jenis BA</th>
                                <th scope="col" class="text-center align-middle">Aksi</th>
                                <th scope="col" class="text-center align-middle">Hari ke-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $notAllowedStatus = ['BA Serah Terima', 'BA Kelengkapan Berkas'];
                                $diffStatus = ['BA Kelengkapan Berkas', 'BA Hasil Verifikasi'];
                            @endphp
                            @if ($claims->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center fw-bold">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($claims as $item)
                                    @php
                                        $now = Carbon\Carbon::now();
                                        $your_date = Carbon\Carbon::parse($item->created_date);
                                        $completion_limit_date = Carbon\Carbon::parse($item->file_completeness);

                                        $datediff = $your_date->diffInDays($now);
                                        $dateDiffFinance = $completion_limit_date->diffInDays($now);

                                        $text = 'Klaim Telah Teregister di BOA (Menunggu Pembayaran)';

                                        $parts = explode('(', $text);
                                        $parts[1] = '<br>(' . $parts[1];

                                        $text = join('', $parts);
                                    @endphp
                                    <tr
                                        class="
                                        @if ($item->status == 'BA Serah Terima') {{ $datediff + 1 >= 9 ? 'table-danger' : ($datediff + 1 >= 7 && $datediff + 1 < 9 ? 'table-warning' : '') }}
                                        @elseif (in_array($item->status, $diffStatus))
                                        {{ $dateDiffFinance + 1 >= 9 ? 'table-danger' : ($dateDiffFinance + 1 >= 7 && $dateDiffFinance + 1 < 9 ? 'table-warning' : '') }}
                                        @else
                                            {{ $dateDiffFinance + 1 >= 13 ? 'table-danger' : '' }} @endif
                                        ">
                                        <td class="text-center align-middle fw-bold" style="font-size: 14px;">
                                            {{ $loop->index + 1 }} </td>
                                        <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                            {{ $item->hospital_name }} </td>
                                        <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                            {{ $item->claim_type }} </td>
                                        <td class="align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                            {{ $item->month }} </td>
                                        <td class="text-center align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                            {{ $item->file_completeness == null ? $item->ba_date : $item->file_completeness }}
                                        </td>
                                        <td class="text-center align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                            {{ $item->completion_limit_date }} </td>
                                        <td class="align-middle fw-bold lh-1"
                                            style=@php
if ($item->status == 'Klaim Telah Teregister di BOA (Menunggu Pembayaran)') {
                                            echo "min-width:15vw;font-size:12px;";
                                                } else {
                                                    echo "min-width:15vw;font-size:14px;";
                                                } @endphp>
                                            @php
                                                if ($item->status == 'Klaim Telah Teregister di BOA (Menunggu Pembayaran)') {
                                                    echo $text;
                                                } else {
                                                    echo $item->status;
                                                }
                                            @endphp
                                        <td class="align-middle fw-bold">
                                            @if (Auth::user()->role == 'ADMIN')
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="d-flex align-items-center justify-content-center me-1">
                                                        @if (in_array($item->status, $notAllowedStatus))
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="{{ $item->status == 'BA Serah Terima' ? '#approveVerificatorModal' : '#approveVerificatorCompleteModal' }}"
                                                                onclick="approveVerificator('{{ $item->uuid }}')"
                                                                style="background-color: #2E3192 !important;">
                                                                Approve
                                                            </button>
                                                        @elseif ($item->status == 'BA Hasil Verifikasi')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal" data-target="#approveHeadModal"
                                                                onclick="approveHead('{{ $item->uuid }}')"
                                                                style="background-color: #2E3192 !important;">
                                                                Approve
                                                            </button>
                                                        @elseif ($item->status == 'Klaim Telah Teregister di BOA (Menunggu Pembayaran)')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal" data-target="#approveFinanceModal"
                                                                onclick="approveFinance('{{ $item->uuid }}')"
                                                                style="background-color: #2E3192 !important;">
                                                                Approve
                                                            </button>
                                                        @endif
                                                    </div>
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
                                            @endif
                                            @if (Auth::user()->role == 'FINANCE')
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#approveFinanceModal"
                                                        onclick="approveFinance('{{ $item->uuid }}')"
                                                        style="background-color: #2E3192 !important;"
                                                        {{ $item->status == 'Klaim Telah Teregister di BOA (Menunggu Pembayaran)' ? '' : 'disabled' }}>
                                                        Approve
                                                    </button>
                                                </div>
                                            @endif
                                            @if (Auth::user()->role == 'VERIFICATOR')
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#approveVerificatorModal"
                                                        onclick="approveVerificator('{{ $item->uuid }}')"
                                                        style="background-color: #2E3192 !important;"
                                                        {{ in_array($item->status, $notAllowedStatus) ? '' : 'disabled' }}>
                                                        Approve
                                                    </button>
                                                </div>
                                            @endif
                                            @if (Auth::user()->role == 'HEAD')
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#approveHeadModal"
                                                        onclick="approveHead('{{ $item->uuid }}')"
                                                        style="background-color: #2E3192 !important;"
                                                        {{ $item->status == 'BA Hasil Verifikasi' ? '' : 'disabled' }}>
                                                        Approve
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle fw-bold">
                                            @if ($item->status == 'Klaim Telah Teregister di BOA (Menunggu Pembayaran)')
                                                {{ $dateDiffFinance + 1 }}
                                            @elseif ($item->status == 'BA Serah Terima')
                                                {{ $datediff + 1 }}
                                            @else
                                                {{ $dateDiffFinance + 1 }}
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="approveFinanceModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Approve</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin telah melakukan <b class="text-black">Pembayaran
                                                        Klaim</b>
                                                    pada Faskes ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        id="btn-approve-finance">Batal</button>
                                                    <a id="approveFinanceLink" href="">
                                                        <button type="button" class="btn btn-primary"
                                                            style="background-color: #2E3192 !important;">Approve</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approveVerificatorModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Approve</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin melakukan <b class="text-black">BA Kelengkapan
                                                        Berkas Klaim?</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        id="btn-approve-verificator">Batal</button>
                                                    <a id="approveVerificatorLink" href="">
                                                        <button type="button" class="btn btn-primary"
                                                            style="background-color: #2E3192 !important;">Approve</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approveVerificatorCompleteModal" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Approve</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin melakukan <b class="text-black">
                                                        BA Hasil Verifikasi Klaim?
                                                    </b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        id="btn-approve-verificator">Batal</button>
                                                    <a id="approveVerificatorCompleteLink" href="">
                                                        <button type="button" class="btn btn-primary"
                                                            style="background-color: #2E3192 !important;">Approve</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approveHeadModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Approve</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin telah melakukan <b class="text-black">Register Klaim
                                                        pada Aplikasi BOA?</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        id="btn-approve-head">Batal</button>
                                                    <a id="approveHeadLink" href="">
                                                        <button type="button" class="btn btn-primary"
                                                            style="background-color: #2E3192 !important;">Approve</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteClaimModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
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
