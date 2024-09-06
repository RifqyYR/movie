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

    function storeNotes(uuid) {
        const link = document.getElementById('addNoteLink');
        link.href = "/notes/" + uuid;
    }

    function deleteClaim(id) {
        const link = document.getElementById('deleteClaimLink');
        link.href = "/claim/hapus/" + id;
    }

    function deleteArchive(id) {
        const link = document.getElementById('deleteArchiveLink');
        link.href = "/arsip/hapus/" + id;
    }

    function approveFinance(id) {
        const link = document.getElementById('approveFinanceLink');
        link.href = "/claim/approve-keuangan/" + id;
    }

    function approveVerificator(id) {
        const link = document.getElementById('approveVerificatorLink');
        const link2 = document.getElementById('approveVerificatorCompleteLink');
        link.action = "/claim/approve-verifikator/" + id;
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

    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk mengupdate kode klasifikasi
        function updateKodeKlasifikasi(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var kodeKlasifikasi = selectedOption.getAttribute('data-code');
            var archiveUuid = selectElement.id.replace('judul_berkas_', '');
            var kodeKlasifikasiInput = document.getElementById('kode_klasifikasi' + archiveUuid);
            if (kodeKlasifikasiInput && kodeKlasifikasi) {
                kodeKlasifikasiInput.value = kodeKlasifikasi;
            }
        }

        // Menambahkan event listener ke semua dropdown judul berkas
        var judulBerkasSelects = document.querySelectorAll('select[id^="judul_berkas_"]');
        judulBerkasSelects.forEach(function(select) {
            select.addEventListener('change', function() {
                updateKodeKlasifikasi(this);
            });

            // Inisialisasi nilai awal
            updateKodeKlasifikasi(select);
        });
    });

    function setArchiveId(uuid) {
        document.getElementById('archive_uuid').value = uuid;
    }

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
            stateSave: true,
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

        const nomorBerkasPMU = [{
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

        const nomorBerkasYANSER = [{
                name: 'Sosialisasi kepada peserta dan non peserta',
                code: 'PS.03.00'
            },
            {
                name: 'Pengaduan peserta',
                code: 'PS.03.02'
            },
            {
                name: 'Laporan Pelaksanaan Kegiatan Penyuluhan/Sosialisasi Daerah',
                code: 'PS.04.00'
            },
            {
                name: 'Laporan Penanganan Keluhan Daerah',
                code: 'PS.04.01'
            },
            {
                name: 'Laporan Kunjungan ke Daerah dalam Bentuk Bimbingan Teknis dan Supervisi',
                code: 'PS.04.02'
            },
            {
                name: 'Laporan Kinerja Perluasan Kepesertaan',
                code: 'PS.04.03'
            },
            {
                name: 'Daftar Isian Peserta berserta dengan Lampirannya',
                code: 'PS.05'
            },
            {
                name: 'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan',
                code: 'PS.07'
            },
            {
                name: 'Penyediaan Perangkat Pendukung Administrasi Kepesertaan',
                code: 'PS.08'
            }
        ];

        const nomorBerkasKEPSER = [{
                name: 'Registrasi Peserta',
                code: 'PS.01.00'
            },
            {
                name: 'Registrasi Peserta Pekerja Penerima Upah',
                code: 'PS.01.01'
            },
            {
                name: 'Registrasi Peserta Pekerja Bukan Penerima Upah',
                code: 'PS.01.02'
            },
            {
                name: 'Registrasi Peserta Penerima Bantuan Iuran',
                code: 'PS.01.03'
            },
            {
                name: 'Registrasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah',
                code: 'PS.01.04'
            },
            {
                name: 'Mutasi Peserta Pekerja Penerima Upah',
                code: 'PS.02.00'
            },
            {
                name: 'Mutasi Peserta Penduduk yang didaftarkan oleh Pemerintah Daerah',
                code: 'PS.02.03'
            },
            {
                name: 'Sosialisasi kepada peserta dan non peserta',
                code: 'PS.03.00'
            },
            {
                name: 'Workshop/Penyuluhan/Konsinyasi/Focus Group Discussion (Internal dan Eksternal)',
                code: 'PS.03.01'
            },
            {
                name: 'Pelaksanaan Pengelolaan Data dan Pemberian Informasi dengan Kementerian/Lembaga Pemilik Data',
                code: 'PS.03.03'
            },
            {
                name: 'Monitoring dan Evaluasi Implementasi Kebijakan Administrasi Kepesertaan',
                code: 'PS.07'
            },
            {
                name: 'Penyediaan Perangkat Pendukung Administrasi Kepesertaan',
                code: 'PS.08'
            },
            {
                name: 'Pemeriksaan Rutin (Ekternal)',
                code: 'PP.00.03'
            },
            {
                name: 'Eksternal',
                code: 'PP.02.01'
            }
        ];

        const nomorBerkasYANFASKES = [{
                name: 'Rencana Usulan Kegiatan',
                code: 'PK.05'
            },
            {
                name: 'Surat-surat dan dokumen lain-nya yang berkaitan dengan operasional berikut lampirannya',
                code: 'PK.06.01'
            },
            {
                name: 'Dokumen Kredentialing/Rekredentialing',
                code: 'PK.06.02'
            },
            {
                name: 'Pelayanan Kesehatan Primer (Perjanjian Kerja Sama)',
                code: 'PK.01.00'
            },
            {
                name: 'Pelayanan Kesehatan Rujukan (Perjanjian Kerja Sama)',
                code: 'PK.01.01'
            }
        ];

        const nomorBerkasSDMUK = [{
                name: 'Usulan Kebutuhan Pengadaan',
                code: 'SP.00.00'
            },
            {
                name: 'Perencanaan Pengadaan',
                code: 'SP.00.01'
            },
            {
                name: 'Daftar Rekanan Perusahaan Terseleksi',
                code: 'SP.00.02'
            },
            {
                name: 'Barang Inventaris Kantor',
                code: 'SP.01.02'
            },
            {
                name: 'Peralatan Gedung',
                code: 'SP.01.03'
            },
            {
                name: 'Alat Angkutan (Roda Empat dan Roda Dua)',
                code: 'SP.01.04'
            },
            {
                name: 'Komputer',
                code: 'SP.01.05'
            },
            {
                name: 'Barang Ekstra Kompatibel',
                code: 'SP.01.06'
            },
            {
                name: 'Jasa Konsultan',
                code: 'SP.02.00'
            },
            {
                name: 'Sewa-Menyewa',
                code: 'SP.02.01'
            },
            {
                name: 'Barang Bergerak',
                code: 'SP.04.00'
            },
            {
                name: 'Barang Tidak Bergerak',
                code: 'SP.04.01'
            },
            {
                name: 'Aset Bergerak',
                code: 'SP.06.00'
            },
            {
                name: 'Aset Tidak Bergerak',
                code: 'SP.06.01'
            },
            {
                name: 'Administrasi Pengelolaan Barang Habis Pakai',
                code: 'SP.07'
            },
            {
                name: 'Administrasi Pengelolaan Belanja Barang Modal',
                code: 'SP.08'
            },
            {
                name: 'Swakelola',
                code: 'SP.09'
            },
            {
                name: 'Penerimaan',
                code: 'KP.01.01'
            },
            {
                name: 'Kesehatan',
                code: 'KP.04.01'
            },
            {
                name: 'Hukuman',
                code: 'KP.05.03'
            },
            {
                name: 'Pensiun',
                code: 'KP.06.00'
            },
            {
                name: 'Pemberhentian',
                code: 'KP.06.01'
            },
            {
                name: 'Surat Pernyataan Melaksanakan Tugas Pegawai',
                code: 'KP.08.00'
            },
            {
                name: 'Kenaikan Golongan/Grade/Skala Gaji',
                code: 'KP.08.01'
            },
            {
                name: 'Kliping Koran/Majalah/Buletin Info Badan Penyelanggara Jaminan Sosial Kesehatan',
                code: 'HM.04.00'
            },
            {
                name: 'Permintaan Informasi/Data Mahasiswa',
                code: 'HM.06.00'
            },
            {
                name: 'Permintaan Informasi/Data Kementerian/Lembaga',
                code: 'HM.06.01'
            },
            {
                name: 'Izin Penelitian Ditujukan untuk Eksternal',
                code: 'HM.06.02'
            },
            {
                name: 'Buku Tamu',
                code: 'HM.10.01'
            },
            {
                name: 'Memorandum of Understanding/Nota Kesepahaman antara Badan Penyelenggara Jaminan Sosial Kesehatan dengan Kementerian/Lembaga',
                code: 'HM.11.02'
            },
            {
                name: 'Perjanjian Kerja Sama (PKS) antar Lembaga/Instansi Lain',
                code: 'HM.11.03'
            },
            {
                name: 'Pencatatan',
                code: 'KA.00.00'
            },
            {
                name: 'Pendistribusian',
                code: 'KA.00.01'
            },
            {
                name: 'Peminjaman',
                code: 'KA.01.01'
            },
            {
                name: 'Penyimpanan Arsip',
                code: 'KA.02.02'
            },
            {
                name: 'Program Arsip Vital',
                code: 'KA.02.04'
            },
            {
                name: 'Pemusnahan Arsip yang Tidak Bernilai Guna',
                code: 'KA.04.01'
            }
        ];

        const nomorBerkasPKP = [{
                name: 'Penyusunan Anggaran',
                code: 'KU.00.00'
            },
            {
                name: 'Berita Acara Rekonsiliasi',
                code: 'KU.01.04'
            },
            {
                name: 'Pembayaran klaim Puskesmas/kapitasi/Dokter Keluarga/Apotek dan Optik',
                code: 'KU.02.00'
            },
            {
                name: 'Pembayaran klaim Rumah Sakit',
                code: 'KU.02.01'
            },
            {
                name: 'Pembayaran Biaya Pembinaan',
                code: 'KU.02.03'
            },
            {
                name: 'Perpajakan',
                code: 'KU.04'
            },
            {
                name: 'Laporan Keuangan Unaudited',
                code: 'KU.07.00'
            },
            {
                name: 'Iuran Jaminan Kesehatan Nasional (JKN) bukti pendukungnya.',
                code: 'PI.00.00'
            },
            {
                name: 'Tagihan',
                code: 'PI.00.01'
            },
            {
                name: 'Penetapan/Kontrak Kinerja',
                code: 'PE.00.02'
            },
            {
                name: 'Laporan Pengelolaan Program',
                code: 'PE.00.03'
            },
            {
                name: 'Pemantauan, Evaluasi, Penilaian, dan Pelaporan Perencanaan Tahunan (APC)',
                code: 'PE.02'
            },
            {
                name: 'Pemeriksaan Kepatuhan',
                code: 'HK.07'
            }
        ];

        @if (Route::is('archive.create'))
            var hospitals = @json($hospitals);
            // Define the data for different units
            const unitData = {
                PMU: {
                    nomorBerkas: nomorBerkasPMU,
                    enableNamaRS: true
                },
                YANSER: {
                    nomorBerkas: nomorBerkasYANSER,
                    enableNamaRS: false
                },
                KEPSER: {
                    nomorBerkas: nomorBerkasKEPSER,
                    enableNamaRS: false
                },
                YANFASKES: {
                    nomorBerkas: nomorBerkasYANFASKES,
                    enableNamaRS: true
                },
                SDMUK: {
                    nomorBerkas: nomorBerkasSDMUK,
                    enableNamaRS: false
                },
                PKP: {
                    nomorBerkas: nomorBerkasPKP,
                    enableNamaRS: true
                }
            };

            let counter = 0;

            // Function to create a new input row
            const createInputRow = (counter, unit) => {
            const { nomorBerkas, enableNamaRS } = unitData[unit];
            return `
                <div class="form-group" id="berkas-${counter}">
                <div class="form-row">
                    <div class="col-md-3">
                    <select class="custom-select text-truncate table-custom-fs @error('judul_berkas') is-invalid @enderror"
                        name="judul_berkas_${counter}">
                        <option selected hidden value="">Judul Berkas</option>
                        ${nomorBerkas.map(item => `<option class="table-custom-fs" value="${item.name}">${item.name}</option>`).join('')}
                    </select>
                    </div>
                    <div class="col-md-1">
                    <input readonly type="text" class="table-custom-fs text-truncate form-control"
                        name="kode_klasifikasi_${counter}" placeholder="Kode Klasifikasi" />
                    </div>
                    <div class="col-md-3">
                    <select ${enableNamaRS ? '' : 'disabled'} class="custom-select table-custom-fs editable-select @error('nama_rs') is-invalid @enderror"
                        name="nama_rs_${counter}">
                        <option selected hidden value="">Nama Faskes</option>
                        ${hospitals.map(item => `<option class="table-custom-fs" value="${item.uuid.trim()}">${item.name.trim()}</option>`).join('')}
                    </select>
                    </div>
                    <div class="col-md-1">
                    <select class="custom-select table-custom-fs @error('bulan') is-invalid @enderror" name="bulan_${counter}">
                        <option selected hidden value="">Bulan</option>
                        ${['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                        .map(month => `<option value="${month}">${month}</option>`).join('')}
                    </select>
                    </div>
                    <div class="col-md-1">
                    <select class="custom-select table-custom-fs @error('tahun') is-invalid @enderror" name="tahun_${counter}">
                        ${Array.from({length: new Date().getFullYear() - 2019}, (_, i) => new Date().getFullYear() - i)
                        .map(year => `<option value="${year}" ${year === new Date().getFullYear() ? 'selected' : ''}>${year}</option>`).join('')}
                    </select>
                    </div>
                    <div class="col-md-2">
                    <input type="text" class="table-custom-fs form-control description-archive" name="keterangan_${counter}"
                        placeholder="Keterangan" />
                    </div>
                    <div class="col-md-1">
                    <button type="button" class="btn btn-danger table-custom-fs w-100 btn-sm delete-button" data-id="${counter}">
                        Hapus
                    </button>
                    </div>
                </div>
                </div>
            `;
            };

            // Event delegation for dynamically added elements
            $('#inputContainer').on('change', 'select[name^="judul_berkas_"]', function() {
            const counter = this.name.split('_')[2];
            const selectedOptionText = $(this).find('option:selected').text().trim();
            const unit = $('#unit_pengolah').val();
            const kodeKlasifikasi = unitData[unit].nomorBerkas.find(item => item.name === selectedOptionText)?.code || '';
            $(`input[name='kode_klasifikasi_${counter}']`).val(kodeKlasifikasi);
            });

            $('#inputContainer').on('click', '.delete-button', function() {
                const id = $(this).data('id');
                $(`#berkas-${id}`).remove();
                updateDeleteButtons();
            });

            function updateDeleteButtons() {
                const deleteButtons = $('.delete-button');
                deleteButtons.prop('disabled', deleteButtons.length === 1);
            }

            $('#unit_pengolah').change(function() {
            const selectedValue = $(this).val();
            const unit = unitData[selectedValue];
            
            if (unit) {
                $('#addInput').off('click').on('click', function() {
                counter++;
                const newInput = $(createInputRow(counter, selectedValue));
                $("#inputContainer").append(newInput);
                $(`select[name='nama_rs_${counter}']`).editableSelect();
                updateDeleteButtons();
                });

                // Clear existing inputs and add the first one
                $('#inputContainer').empty();
                $('#addInput').click();
            }
            });

            // Initial setup
            $('#unit_pengolah').change();
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

    function toggleCheckbox(event, id) {
        var isActionCol =
            event.target.classList.contains("action-col") ||
            event.target.parentElement.classList.contains("action-col") ||
            event.target.parentElement.parentElement.classList.contains(
                "action-col"
            );

        if (!isActionCol) {
            var checkbox = document.getElementById("checkbox" + id);
            checkbox.checked = !checkbox.checked;

            var checkboxes = document.getElementsByName("ids[]");
            var isChecked = Array.prototype.slice
                .call(checkboxes)
                .some((x) => x.checked);
            document.getElementById("btnUpdateStatus").disabled = !isChecked;
        }
    }
</script>
