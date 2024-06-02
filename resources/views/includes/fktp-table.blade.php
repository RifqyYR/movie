<table class="table table-sm table-bordered-black table-hover"
    @php
if (!$claims->isEmpty()) {
                            echo 'id="my-table"';
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
            <th scope="col" class="text-center align-middle custom-col">
                Bulan
                Pelayanan</th>
            <th scope="col" class="text-center align-middle custom-col">
                Tanggal<br>
                Pembuatan BA</th>
            <th scope="col" class="text-center align-middle custom-col">
                Jatuh Tempo
            </th>
            <th scope="col" class="text-center align-middle custom-col">
                Status</th>
            <th scope="col" class="text-center align-middle custom-col">No
                Register
                BOA</th>
            @if (auth()->user()->role != 'GUEST')
                <th scope="col" class="text-center align-middle custom-col">Aksi</th>
            @endif
            <th scope="col" class="text-center align-middle custom-col">
                Hari ke-</th>
        </tr>
    </thead>
    <tbody>
        @php
            $notAllowedStatus = [
                App\Models\Claim::STATUS_BA_SERAH_TERIMA,
                App\Models\Claim::STATUS_BA_KELENGKAPAN_BERKAS,
            ];
            $diffStatus = [
                App\Models\Claim::STATUS_BA_KELENGKAPAN_BERKAS,
                App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI,
                App\Models\Claim::STATUS_TELAH_REGISTER_BOA,
            ];
        @endphp

        @if ($claims->isEmpty())
            <tr>
                <td colspan="10" class="text-center fw-bold table-custom-fs-larger">Tidak ada data
                </td>
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
                                        @if ($item->status == 'BA Serah Terima') {{ $datediff + 1 >= 2 ? 'table-danger' : ($datediff + 1 >= 7 && $datediff + 1 < 9 ? 'table-warning' : '') }}
                                        @elseif (in_array($item->status, $diffStatus))
                                        {{ $dateDiffFinance + 1 >= 9 ? 'table-danger' : ($dateDiffFinance + 1 >= 7 && $dateDiffFinance + 1 < 9 ? 'table-warning' : '') }}
                                        @else
                                            {{ $dateDiffFinance + 1 >= 11 ? 'table-danger' : '' }} @endif
                                        ">
                    <td class="text-center align-middle fw-bold table-custom-fs">
                        {{ $loop->index + 1 }} </td>
                    <td class="align-middle fw-bold table-custom-fs text-nowrap">
                        {{ $item->hospital_name }} </td>
                    <td class="align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                        {{ $item->claim_type }} </td>
                    <td class="align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                        {{ $item->month }} </td>
                    <td class="text-center align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                        {{ $item->file_completeness == null ? $item->ba_date : $item->file_completeness }}
                    </td>
                    <td class="text-center align-middle fw-bold text-nowrap table-custom-width table-custom-fs">
                        {{ $item->completion_limit_date }} </td>
                    <td class="align-middle fw-bold lh-1 table-custom-fs">
                        @php
                            if ($item->status == App\Models\Claim::STATUS_TELAH_SETUJU) {
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
                        @endphp
                    </td>
                    <td class="align-middle fw-bold text-nowrap table-custom-fs">
                        <b>RITP</b>:
                        {{ $item->ritl_number == '' ? '' : $item->ritl_number }}<br>
                        <b>RJTP</b>: {{ $item->rjtl_number == '' ? '' : $item->rjtl_number }}
                    </td>
                    @if (auth()->user()->role != 'GUEST')
                        <td class="align-middle fw-bold">
                            @if (Auth::user()->role == 'ADMIN')
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        @if (in_array($item->status, $notAllowedStatus))
                                            <button type="button" class="btn btn-primary btn-sm btn-blue-custom w-100"
                                                data-toggle="modal"
                                                data-target="{{ $item->status == App\Models\Claim::STATUS_BA_SERAH_TERIMA ? '#approveVerificatorModal' : '#approveVerificatorCompleteModal' }}"
                                                onclick="approveVerificator('{{ $item->uuid }}')">
                                                Approve
                                            </button>
                                        @elseif ($item->status == App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI)
                                            <button type="button" class="btn btn-primary btn-sm btn-blue-custom w-100"
                                                data-toggle="modal" data-target="#approveStaffModal"
                                                onclick="approveStaff('{{ $item->uuid }}')">
                                                Approve
                                            </button>
                                        @elseif ($item->status == App\Models\Claim::STATUS_TELAH_REGISTER_BOA)
                                            <button type="button" class="btn btn-primary btn-sm btn-blue-custom w-100"
                                                data-toggle="modal" data-target="#approveHeadModal"
                                                onclick="approveHead('{{ $item->uuid }}')">
                                                Approve
                                            </button>
                                        @elseif ($item->status == App\Models\Claim::STATUS_TELAH_SETUJU)
                                            <button type="button" class="btn btn-primary btn-sm btn-blue-custom w-100"
                                                data-toggle="modal" data-target="#approveFinanceModal"
                                                onclick="approveFinance('{{ $item->uuid }}')">
                                                Approve
                                            </button>
                                        @endif
                                    </div>
                                    <a href="/claim/edit/{{ $item->uuid }}"
                                        class="btn btn-warning btn-sm mb-1 table-custom-fs">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm table-custom-fs"
                                        data-toggle="modal" data-target="#deleteClaimModal"
                                        onclick="deleteClaim('{{ $item->uuid }}')">
                                        Hapus
                                    </button>
                                </div>
                            @endif
                            @if (Auth::user()->role == 'FINANCE')
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm btn-blue-custom"
                                        data-toggle="modal" data-target="#approveFinanceModal"
                                        onclick="approveFinance('{{ $item->uuid }}')"
                                        {{ $item->status == App\Models\Claim::STATUS_TELAH_SETUJU ? '' : 'disabled' }}>
                                        Approve
                                    </button>
                                </div>
                            @endif
                            @if (Auth::user()->role == 'VERIFICATOR')
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm btn-blue-custom w-100"
                                        data-toggle="modal"
                                        data-target="{{ $item->status == App\Models\Claim::STATUS_BA_SERAH_TERIMA ? '#approveVerificatorModal' : '#approveVerificatorCompleteModal' }}"
                                        onclick="approveVerificator('{{ $item->uuid }}')"
                                        {{ !in_array($item->status, $notAllowedStatus) ? 'disabled' : '' }}>
                                        Approve
                                    </button>
                                </div>
                            @endif
                            @if (Auth::user()->role == 'HEAD')
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm btn-blue-custom"
                                        data-toggle="modal" data-target="#approveHeadModal"
                                        onclick="approveHead('{{ $item->uuid }}')"
                                        {{ $item->status == App\Models\Claim::STATUS_TELAH_REGISTER_BOA ? '' : 'disabled' }}>
                                        Approve
                                    </button>
                                </div>
                            @endif
                            @if (Auth::user()->role == 'STAFF_ADMIN')
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <button type="button" class="btn btn-primary btn-sm btn-blue-custom w-100"
                                            data-toggle="modal" data-target="#approveStaffModal"
                                            onclick="approveStaff('{{ $item->uuid }}')"
                                            {{ $item->status == App\Models\Claim::STATUS_BA_HASIL_VERIFIKASI ? '' : 'disabled' }}>
                                            Approve
                                        </button>
                                    </div>
                                    <a href="/claim/edit/{{ $item->uuid }}"
                                        class="btn btn-warning btn-sm mb-1 table-custom-fs">
                                        Edit
                                    </a>
                                </div>
                            @endif
                        </td>
                    @endif
                    <td class="text-center align-middle fw-bold table-custom-fs-larger">
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
                                <h5 class="modal-title text-danger fw-bold fs-09rem" id="exampleModalLabel">
                                    Konfirmasi Approve</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body table-custom-fs-larger">
                                Apakah Anda yakin telah melakukan <b class="text-black">Pembayaran
                                    Klaim</b>
                                pada Faskes ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-confirm-approve table-custom-fs-larger btn-danger"
                                    data-dismiss="modal" id="btn-approve-finance">Tidak</button>
                                <a id="approveFinanceLink" href="">
                                    <button type="button"
                                        class="btn btn-confirm-approve table-custom-fs-larger btn-success">Iya</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="approveVerificatorModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="" method="POST" id="approveVerificatorLink">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger fw-bold fs-09rem" id="exampleModalLabel">
                                        Konfirmasi Approve</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body table-custom-fs-larger">
                                    Apakah Anda yakin ingin melakukan <b class="text-black">BA
                                        Kelengkapan Berkas Klaim</b>
                                    <div class="form-group mt-3">
                                        <input type="date" class="form-control table-custom-fs"
                                            name="tanggal_ba_lengkap" value="{{ now()->toDateString() }}"
                                            autocomplete="off" max="{{ now()->toDateString() }}"
                                            min="{{ $item->created_date }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn table-custom-fs-larger btn-confirm-approve btn-danger"
                                        data-dismiss="modal" id="btn-cancel">Tidak</button>
                                    <button type="submit"
                                        class="btn table-custom-fs-larger btn-confirm-approve btn-success"
                                        id="btn-approve-verificator">Iya</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="approveVerificatorCompleteModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="" method="POST" id="approveVerificatorCompleteLink">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger fw-bold fs-09rem" id="exampleModalLabel">
                                        Konfirmasi Approve</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body table-custom-fs-larger">
                                    Apakah Anda yakin ingin melakukan <b class="text-black">BA Hasil
                                        Verifikasi Berkas Klaim</b>
                                    <div class="form-group mt-3">
                                        <div>
                                            <div class="input-group">
                                                <span
                                                    class="table-custom-fs input-group-text no-bottom-border-radius">RI</span>
                                                <input id="input-no-reg-fpk-ri" type="text"
                                                    class="table-custom-fs form-control no-bottom-border-radius"
                                                    name="no_reg_fpk_ri" placeholder="Masukkan Nomor FPK RI" autofocus
                                                    autocomplete="no_reg_fpk_ri" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-group">
                                                <span
                                                    class="table-custom-fs input-group-text no-top-border-radius">RJ</span>
                                                <input id="input-no-reg-fpk-rj" type="text"
                                                    class="table-custom-fs form-control no-top-border-radius"
                                                    name="no_reg_fpk_rj" placeholder="Masukkan Nomor FPK RJ" autofocus
                                                    autocomplete="no_reg_fpk_rj" />
                                            </div>
                                        </div>
                                        <span id="fpk-reg-number-warning" class="text-danger table-custom-fs-larger">*
                                            Nomor RI atau
                                            RJ harus 14 digit</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn table-custom-fs-larger btn-confirm-approve btn-danger"
                                        data-dismiss="modal" id="btn-cancel">Tidak</button>
                                    <button type="submit"
                                        class="btn table-custom-fs-larger btn-confirm-approve btn-success"
                                        id="btn-approve-verificator-complete" disabled>Iya</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="approveHeadModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger fw-bold fs-09rem" id="exampleModalLabel">
                                    Konfirmasi Approve</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body table-custom-fs-larger">
                                Apakah Anda yakin ingin <b class="text-black">
                                    Menyetujui Klaim ini?
                                </b>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-confirm-approve table-custom-fs-larger btn-danger"
                                    data-dismiss="modal" id="btn-approve-head">Tidak</button>
                                <a id="approveHeadLink" href="">
                                    <button type="button"
                                        class="btn btn-confirm-approve table-custom-fs-larger btn-success">Iya</button>
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
                                    <h5 class="modal-title text-danger fw-bold fs-09rem" id="exampleModalLabel">
                                        Konfirmasi Approve
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body table-custom-fs-larger">
                                    Apakah Anda yakin telah melakukan <b class="text-black">Register
                                        Klaim
                                        pada Aplikasi BOA?</b>
                                    <div class="form-group mt-3">
                                        <div>
                                            <div class="input-group">
                                                <span
                                                    class="table-custom-fs input-group-text no-bottom-border-radius">RI</span>
                                                <input id="input-no-reg-boa-ri" type="text"
                                                    class="table-custom-fs form-control no-bottom-border-radius"
                                                    name="no_reg_boa_ri"
                                                    placeholder="Masukkan Nomor Registrasi BOA RI" autofocus
                                                    autocomplete="no_reg_boa_ri" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="input-group">
                                                <span
                                                    class="table-custom-fs input-group-text no-top-border-radius">RJ</span>
                                                <input id="input-no-reg-boa-rj" type="text"
                                                    class="table-custom-fs form-control no-top-border-radius"
                                                    name="no_reg_boa_rj"
                                                    placeholder="Masukkan Nomor Registrasi BOA RJ" autofocus
                                                    autocomplete="no_reg_boa_rj" />
                                            </div>
                                        </div>
                                        <span id="boa-reg-number-warning" class="text-danger table-custom-fs-larger">*
                                            Nomor RI atau
                                            RJ harus 14 digit</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn table-custom-fs-larger btn-confirm-approve btn-danger"
                                        data-dismiss="modal">Tidak</button>
                                    <button type="submit"
                                        class="btn table-custom-fs-larger btn-confirm-approve btn-success"
                                        id="btn-approve-staff" disabled>Iya</button>
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
                                <h5 class="modal-title text-danger fw-bold fs-09rem" id="exampleModalLabel">
                                    Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body custom-table-fs-larger">
                                Apakah Anda yakin ingin menghapus item ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-confirm-approve table-custom-fs-larger btn-secondary"
                                    data-dismiss="modal" id="btn-delete">Tidak</button>
                                <a id="deleteClaimLink" href="">
                                    <button type="button"
                                        class="btn btn-confirm-approve table-custom-fs-larger btn-danger">Iya</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </tbody>
</table>
