@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h5 mb-0 text-gray-800" style="color: #fc7f01 !important;">Riwayat</h1>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="table-responsive" id="demo">
                    <table class="table table-sm table-bordered-black">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle">No</th>
                                <th scope="col" class="text-center align-middle">Nama Faskes</th>
                                <th scope="col" class="text-center align-middle">Jenis Claim</th>
                                <th scope="col" class="text-center align-middle text-nowrap">Bulan Pelayanan</th>
                                <th scope="col" class="text-center align-middle">Tanggal BA Lengkap</th>
                                <th scope="col" class="text-center align-middle">Tanggal Pembayaran</th>
                                <th scope="col" class="text-center align-middle">Jenis BA</th>
                                @if (Auth::user()->role == 'ADMIN')
                                    <th scope="col" class="text-center align-middle">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($claims->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center fw-bold">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($claims as $item)
                                    <tr>
                                        <td class="text-center fw-bold" style="font-size: 14px;">{{ $loop->index + 1 }}</td>
                                        <td class="fw-bold text-nowrap" style="font-size: 14px;">{{ $item->hospital_name }}</td>
                                        <td class="fw-bold text-nowrap" style="font-size: 14px;">{{ $item->claim_type }}</td>
                                        <td class="fw-bold text-nowrap" style="font-size: 14px;">{{ $item->month }}</td>
                                        <td class="text-center fw-bold text-nowrap" style="font-size: 14px;">{{ $item->file_completeness }}</td>
                                        <td class="text-center fw-bold text-nowrap" style="font-size: 14px;">{{ $item->ba_date }}</td>
                                        <td class="fw-bold" style="font-size: 14px;">{{ $item->status }}
                                        <td>
                                            @if (Auth::user()->role == 'ADMIN')
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
                                            @endif
                                        </td>
                                    </tr>
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
