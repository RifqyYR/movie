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

<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script
    src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/sticky-header/bootstrap-table-sticky-header.min.js">
</script>

<script>
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
</script>
