<!-- Bootstrap core JavaScript-->
<script src="{{ url('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('backend/js/sb-admin-2.js') }}"></script>

{{-- Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- Editable Select --}}
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>

<!-- Chart -->
@if (Request::route()->getName() == 'home')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.js">
    </script>
    <script src="{{ url('backend/js/pie-chart.js') }}"></script>
    <script src="{{ url('backend/js/bar-chart.js') }}"></script>
@endif

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.2.0/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.2.0/js/searchPanes.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>

<script>
    const status = ['Klaim Telah Teregister di BOA',
        'Klaim Telah Disetujui (Menunggu Pembayaran)', 'Pembayaran Telah Dilakukan'
    ];

    function deleteClaim(id) {
        const link = document.getElementById('deleteClaimLink');
        link.href = "/claim/hapus/" + id;
    }

    function approveFinance(id) {
        const link = document.getElementById('approveFinanceLink');
        link.href = "/claim/approve-keuangan/" + id;
    }

    function approveVerificator(id) {
        const link = document.getElementById('approveVerificatorLink');
        const link2 = document.getElementById('approveVerificatorCompleteLink');
        link.href = "/claim/approve-verifikator/" + id;
        link2.action = "/claim/approve-verifikator-complete/" + id;
    }

    function approveHead(id) {
        const link = document.getElementById('approveHeadLink');
        link.href = "/claim/approve-kabag/" + id;
    }

    function approveStaff(id) {
        const form = document.getElementById('approveStaffLink');
        form.action = "/claim/approve-staff/" + id;
    }

    function hapusUser(id) {
        const link = document.getElementById('deleteUserLink');
        link.href = "/delete-user/" + id;
    }

    function hapusFaskes(id) {
        const link = document.getElementById('deleteFaskesLink');
        link.href = "/delete-faskes/" + id;
    }

    @if (session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif (session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif

    $('#editable-select').editableSelect();
    $('.editable-select').editableSelect();

    $('#input-no-reg-boa-ri').keyup(function() {
        var value = $(this).val();
        var value2 = $('#input-no-reg-boa-rj').val();
        if ((value.length == 14 || value2.length == 14) && !(value.length > 14 || value2.length > 14 || (value
                .length > 0 && value.length < 14) || (value2.length > 0 && value2.length < 14))) {
            $('#btn-approve-staff').prop('disabled', false);
            $('#boa-reg-number-warning').hide();
        } else {
            $('#btn-approve-staff').prop('disabled', true);
            $('#boa-reg-number-warning').show();
        }
    });

    $('#input-no-reg-boa-rj').keyup(function() {
        var value = $(this).val();
        var value2 = $('#input-no-reg-boa-ri').val();
        if ((value.length == 14 || value2.length == 14) && !(value.length > 14 || value2.length > 14 || (value
                .length > 0 && value.length < 14) || (value2.length > 0 && value2.length < 14))) {
            $('#btn-approve-staff').prop('disabled', false);
            $('#boa-reg-number-warning').hide();
        } else {
            $('#btn-approve-staff').prop('disabled', true);
            $('#boa-reg-number-warning').show();
        }
    });

    $('#input-no-reg-fpk-ri').keyup(function() {
        var value = $(this).val();
        var value2 = $('#input-no-reg-fpk-rj').val();
        if ((value.length == 14 || value2.length == 14) && !(value.length > 14 || value2.length > 14 || (value
                .length > 0 && value.length < 14) || (value2.length > 0 && value2.length < 14))) {
            $('#btn-approve-verificator-complete').prop('disabled', false);
            $('#fpk-reg-number-warning').hide();
        } else {
            $('#btn-approve-verificator-complete').prop('disabled', true);
            $('#fpk-reg-number-warning').show();
        }
    });

    $('#input-no-reg-fpk-rj').keyup(function() {
        var value = $(this).val();
        var value2 = $('#input-no-reg-fpk-ri').val();
        if ((value.length == 14 || value2.length == 14) && !(value.length > 14 || value2.length > 14 || (value
                .length > 0 && value.length < 14) || (value2.length > 0 && value2.length < 14))) {
            $('#btn-approve-verificator-complete').prop('disabled', false);
            $('#fpk-reg-number-warning').hide();
        } else {
            $('#btn-approve-verificator-complete').prop('disabled', true);
            $('#fpk-reg-number-warning').show();
        }
    });

    $('#edit-status').on('change', function() {
        if (status.includes(this.value)) {
            $('.form-edit-register-boa').show(500);
        } else {
            $('.form-edit-register-boa').hide(500);
        }
    });

    var counter = 0;

    $(document).on('keyup', '.description-archive', function() {
        var value = $(this).val();

        if (value.length > 30) {
            $(this).css('border-color', 'red');
            $(this).css('border-width', '2px');
            $('#description-alert').show(500);
        } else {
            $(this).css('border-color', 'initial');
            $(this).css('border-width', '1px');
            $('#description-alert').hide(500);
        }
    });

    $(document).ready(function() {
        $('#description-alert').hide();
        $('.table-toggle').hide();
        $('#boa-reg-number-warning').hide();
        $('#fpk-reg-number-warning').hide();

        if (status.includes($('#edit-status').val())) {
            $('.form-edit-register-boa').show();
        } else {
            $('.form-edit-register-boa').hide();
        }

        var table = $('#my-table').DataTable({
            fixedHeader: true,
            orderCellsTop: true,
            searching: false,
            paging: false,
            responsive: true,
            info: false,
        });

        $('#history-table').DataTable({
            fixedHeader: true,
            orderCellsTop: true,
            searching: false,
            responsive: true,
            info: false,
            dom: "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'l><'col-sm-8'p>>",
        });

        const nomorBerkas = [{
                name: 'Rawat Jalan Tingkat Pertama',
                code: 'PK.03.00'
            },
            {
                name: 'Rawat Jalan Tingkat Lanjutan',
                code: 'PK.03.02'
            },
            {
                name: 'Rawat Inap Tingkat Pertama dan Persalinan',
                code: 'PK.03.01'
            },
            {
                name: 'Rawat Inap Tingkat Lanjutan',
                code: 'PK.03.03'
            },
            {
                name: 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Pertama',
                code: 'PK.03.04'
            },
            {
                name: 'Pelayanan Obat di Fasilitas Kesehatan Tingkat Lanjutan',
                code: 'PK.03.05'
            },
            {
                name: 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Tingkat Pertama',
                code: 'PK.03.06'
            },
            {
                name: 'Pelayanan Alat Bantu Kesehatan di Fasilitas Kesehatan Rujukan Tingkat Lanjutan',
                code: 'PK.03.07'
            },
            {
                name: 'Promotif dan Preventif',
                code: 'PK.03.08'
            },
            {
                name: 'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya',
                code: 'PK.06.01'
            }
        ];

        @if (Route::is('archive.create'))
            function addChangeEvent(counter) {
                $(`select[name='judul_berkas_${counter}']`).change(function() {
                    var selectedOptionText = $(this).find('option:selected').text();

                    // Find the corresponding code in the nomorBerkas array
                    var kodeKlasifikasi = nomorBerkas.find(item => item.name === selectedOptionText
                            .trim())
                        .code;

                    $(`input[name='kode_klasifikasi_${counter}']`).val(kodeKlasifikasi);
                });
            }

            addChangeEvent(counter);

            $("#addInput").click(function() {
                counter++;

                var newInput =
                    $(`<div class="form-group" id="berkas-${counter}">
                        <div class="form-row">
                            <div class="col-md-3">
                                <select class="custom-select text-truncate table-custom-fs @error('judul_berkas') is-invalid @enderror"
                                    name="judul_berkas_${counter}">
                                    <option selected hidden value="">Judul Berkas</option>
                                    @foreach ($nomorBerkas as $item)
                                        <option class="table-custom-fs" value="{{ $item['name'] }}">
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('judul_berkas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <input readonly type="text" class="table-custom-fs text-truncate form-control"
                                    name="kode_klasifikasi_${counter}" autocomplete="kode_klasifikasi"
                                    @error('kode_klasifikasi') is-invalid @enderror placeholder="Kode Klasifikasi" />
                                @error('kode_klasifikasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select table-custom-fs editable-select @error('nama_rs') is-invalid @enderror"
                                    name="nama_rs_${counter}" >
                                    <option selected hidden value="">Nama Faskes</option>
                                    @foreach ($hospitals as $item)
                                        <option class="table-custom-fs" value="{{ trim($item->uuid) }}">{{ trim($item->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nama_rs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <select class="custom-select table-custom-fs @error('bulan') is-invalid @enderror" name="bulan_${counter}">
                                    <option selected hidden value="">Bulan</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                                @error('bulan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <select class="custom-select table-custom-fs @error('tahun') is-invalid @enderror"
                                    name="tahun_${counter}">
                                    @for ($year = date('Y'); $year >= 2020; $year--)
                                        <option value="{{ $year }}" {{ date('Y') == $year ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="table-custom-fs form-control description-archive" name="keterangan_${counter}"
                                    autocomplete="keterangan" @error('keterangan') is-invalid @enderror placeholder="Keterangan" />
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger table-custom-fs w-100 btn-sm"
                                    onclick="removeInput('berkas-${counter}', ${counter})" id="deleteButton-${counter}">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>`);
                for (var i = 0; i < counter; i++) {
                    $(`#deleteButton-${i}`).prop('disabled', true);
                }

                // Enable the delete button for the new input
                $(`#deleteButton-${counter}`).prop('disabled', false);
                $("#inputContainer").append(newInput);
                $(`select[name='nama_rs_${counter}']`).editableSelect();
                addChangeEvent(counter);
            });
        @endif
    });

    function removeInput(id, number) {
        if (number !== counter) {
            return;
        }
        counter--;
        $(`#deleteButton-${counter}`).prop('disabled', false);
        $("#" + id).remove();
    }
</script>
