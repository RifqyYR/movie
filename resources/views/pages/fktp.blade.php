@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h5 mb-0 text-gray-800" style="color: #fc7f01 !important;">Dashboard SLA Klaim FKTP</h1>
            @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'HEAD')
                <a href="/claim/export" class="btn btn-sm btn-success" target="_blank">Export Excel</a>
            @endif
        </div>
        @if (auth()->user()->role == 'VERIFICATOR' || auth()->user()->role == 'ADMIN')
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
        @endif

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered-black "
                        @php
if (!$claims->isEmpty()) {
                            echo 'id="my-table"';
                        } @endphp>
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle">No</th>
                                <th scope="col" class="text-center align-middle">Nama Faskes</th>
                                <th scope="col" class="text-center align-middle">Jenis Klaim</th>
                                <th scope="col" class="text-center align-middle">Bulan Pelayanan</th>
                                <th scope="col" class="text-center align-middle">Tanggal Pembuatan BA</th>
                                <th scope="col" class="text-center align-middle">Jatuh Tempo</th>
                                <th scope="col" class="text-center align-middle">Keterangan</th>
                                <th scope="col" class="text-center align-middle">No Register BOA</th>
                                @if (auth()->user()->role != 'GUEST')
                                    <th scope="col" class="text-center align-middle">Aksi</th>
                                @endif
                                <th scope="col" class="text-center align-middle">Hari ke-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $notAllowedStatus = [App\Models\Claim::STATUS_BA_SERAH_TERIMA, App\Models\Claim::STATUS_BA_KELENGKAPAN_BERKAS];
                                $diffStatus = [App\Models\Claim::STATUS_BA_KELENGKAPAN_BERKAS, App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI, App\Models\Claim::STATUS_TELAH_REGISTER_BOA];
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

                                        $datediff = $your_date->diffInWeekdays($now);
                                        $dateDiffFinance = $completion_limit_date->diffInWeekdays($now);

                                        $holidays = config('app.holidays');

                                        foreach ($holidays as $holiday) {
                                            $holidayDate = Carbon\Carbon::parse($holiday);
                                            if ($holidayDate->between($your_date, $now)) {
                                                $datediff--;
                                            }
                                            if ($holidayDate->between($completion_limit_date, $now)) {
                                                $dateDiffFinance--;
                                            }
                                        }

                                        $text = App\Models\Claim::STATUS_TELAH_SETUJU;

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
if ($item->status == App\Models\Claim::STATUS_TELAH_SETUJU) {
                                            echo "min-width:15vw;font-size:12px;";
                                                } else {
                                                    echo "min-width:15vw;font-size:14px;";
                                                } @endphp>
                                            @php
                                                if ($item->status == App\Models\Claim::STATUS_TELAH_SETUJU) {
                                                    echo $text;
                                                } else {
                                                    echo $item->status;
                                                }
                                            @endphp
                                        <td class="text-center align-middle fw-bold text-nowrap" style="font-size: 14px;">
                                            {{ $item->boa_register_number == '' ? 'Belum Teregister' : $item->boa_register_number }}
                                        </td>
                                        @if (auth()->user()->role != 'GUEST')
                                            <td class="align-middle fw-bold">
                                                @if (Auth::user()->role == 'ADMIN')
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                                            @if (in_array($item->status, $notAllowedStatus))
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="{{ $item->status == App\Models\Claim::STATUS_BA_SERAH_TERIMA ? '#approveVerificatorModal' : '#approveVerificatorCompleteModal' }}"
                                                                    onclick="approveVerificator('{{ $item->uuid }}')"
                                                                    style="background-color: #2E3192 !important;">
                                                                    Approve
                                                                </button>
                                                            @elseif ($item->status == App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI)
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal" data-target="#approveStaffModal"
                                                                    onclick="approveStaff('{{ $item->uuid }}')"
                                                                    style="background-color: #2E3192 !important;">
                                                                    Approve
                                                                </button>
                                                            @elseif ($item->status == App\Models\Claim::STATUS_TELAH_REGISTER_BOA)
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal" data-target="#approveHeadModal"
                                                                    onclick="approveHead('{{ $item->uuid }}')"
                                                                    style="background-color: #2E3192 !important;">
                                                                    Approve
                                                                </button>
                                                            @elseif ($item->status == App\Models\Claim::STATUS_TELAH_SETUJU)
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal" data-target="#approveFinanceModal"
                                                                    onclick="approveFinance('{{ $item->uuid }}')"
                                                                    style="background-color: #2E3192 !important;">
                                                                    Approve
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <a href="/claim/edit/{{ $item->uuid }}"
                                                            class="btn btn-warning btn-sm mb-1">
                                                            Edit
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal" data-target="#deleteClaimModal"
                                                            onclick="deleteClaim('{{ $item->uuid }}')">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                @endif
                                                @if (Auth::user()->role == 'FINANCE')
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal" data-target="#approveFinanceModal"
                                                            onclick="approveFinance('{{ $item->uuid }}')"
                                                            style="background-color: #2E3192 !important;"
                                                            {{ $item->status == App\Models\Claim::STATUS_TELAH_SETUJU ? '' : 'disabled' }}>
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
                                                            {{ $item->status == App\Models\Claim::STATUS_TELAH_REGISTER_BOA ? '' : 'disabled' }}>
                                                            Approve
                                                        </button>
                                                    </div>
                                                @endif
                                                @if (Auth::user()->role == 'STAFF_ADMIN')
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal" data-target="#approveStaffModal"
                                                            onclick="approveStaff('{{ $item->uuid }}')"
                                                            style="background-color: #2E3192 !important;"
                                                            {{ $item->status == App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI ? '' : 'disabled' }}>
                                                            Approve
                                                        </button>
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="text-center align-middle fw-bold">
                                            @if ($item->status == App\Models\Claim::STATUS_TELAH_SETUJU)
                                                {{ $dateDiffFinance + 1 }}
                                            @elseif ($item->status == App\Models\Claim::STATUS_BA_SERAH_TERIMA)
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
                                                    Apakah Anda yakin ingin <b class="text-black">
                                                        Menyetujui Klaim ini?
                                                    </b>
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
                                    <div class="modal fade" id="approveStaffModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="" method="POST" id="approveStaffLink">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Approve
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin telah melakukan <b class="text-black">Register
                                                            Klaim
                                                            pada Aplikasi BOA?</b>
                                                        <div class="form-group mt-3">
                                                            <input id="input-no-reg-boa" type="text"
                                                                class="form-control" name="no_reg_boa"
                                                                placeholder="Masukkan Nomor Registrasi BOA" required
                                                                autofocus autocomplete="no_reg_boa"
                                                                style="font-size: 0.8rem;" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            id="btn-approve-staff"
                                                            style="background-color: #2E3192 !important;"
                                                            disabled>Approve</button>
                                                    </div>
                                                </div>
                                            </form>
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
