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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.js">
</script>
<script src="{{ url('backend/js/pie-chart.js') }}"></script>
<script src="{{ url('backend/js/bar-chart.js') }}"></script>

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
        link2.href = "/claim/approve-verifikator/" + id;
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

    @if (session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif (session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif

    $('#editable-select').editableSelect();

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

    $('#edit-status').on('change', function() {
        if (status.includes(this.value)) {
            $('.form-edit-register-boa').show(500);
        } else {
            $('.form-edit-register-boa').hide(500);
        }
    });

    $(document).ready(function() {
        $('.table-toggle').hide();
        $('#boa-reg-number-warning').hide();

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
    });

    function removeInput(id) {
        $("#" + id).remove();
    }
</script>
