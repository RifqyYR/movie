@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h5 mb-0 text-gray-800" style="color: #ff8000 !important;">Daftar Faskes</h1>
        </div>

        <div class="d-sm-flex">
            <a href="{{ url('/faskes/buat') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm text-center py-3"
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
                <div class="table-responsive">
                    <table class="table table-sm table-bordered-black table-hover"
                        @php
if (!$hospitals->isEmpty()) {
                            echo 'id="history-table"';
                        } @endphp>
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle custom-col">No</th>
                                <th scope="col" class="text-center align-middle custom-col">Nama Faskes</th>
                                <th scope="col" class="text-center align-middle custom-col">Kode Faskes</th>
                                <th scope="col" class="text-center align-middle custom-col">Tingkat</th>
                                <th scope="col" class="text-center align-middle custom-col">Wilayah</th>
                                <th scope="col" class="text-center align-middle custom-col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hospitals as $item)
                                <tr>
                                    <td class="text-center align-middle fw-bold table-custom-fs">
                                        {{ $loop->index + 1 }} </td>
                                    <td class="text-center align-middle fw-bold table-custom-fs">
                                        {{ $item->name }} </td>
                                    <td class="text-center align-middle fw-bold table-custom-fs">
                                        {{ $item->code }} </td>
                                    <td class="text-center align-middle fw-bold table-custom-fs">
                                        {{ $item->level }} </td>
                                    <td class="text-center align-middle fw-bold table-custom-fs">
                                        {{ $item->region == 'ParePare' ? 'Parepare' : $item->region }} </td>
                                    <td class="fw-bold text-center align-middle fw-bold table-custom-fs-larger">
                                        <div class="align-items-center d-grip gap-4">
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteFaskesModal"
                                                onclick="hapusFaskes('{{ $item->uuid }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="0.8em"
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
                                </tr>
                                <div class="modal fade" id="deleteFaskesModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold text-danger" id="exampleModalLabel">
                                                    Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus faskes ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="btn-delete">Batal</button>
                                                <a id="deleteFaskesLink">
                                                    <button type="button" class="btn btn-danger">Hapus</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
