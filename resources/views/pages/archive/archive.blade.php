@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h5 mb-0 text-gray-800" style="color: #ff8000 !important;">Arsip</h1>
            <a href="#" class="btn btn-sm btn-success btn-export" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="#ffffff"
                        d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                </svg>
                Export Excel</a>
        </div>

        <div class="d-sm-flex">
            <a href="{{ url('/arsip/buat') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm text-center py-3"
                style="position: fixed; right: 0; bottom: 0; margin: 20px; width: 60px; height: 60px; border-radius: 50%; padding: 10px; z-index: 1; opacity: 80%;">
                <svg class="align-self-center" xmlns="http://www.w3.org/2000/svg" height="25" width="25"
                    viewBox="0 0 448 512">
                    <path fill="#ffffff"
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
            </a>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered-black table-hover">
                        {{-- @php if (!$claims->isEmpty()) {echo 'id="my-table"';} @endphp> --}}
                        <thead>
                            <tr>
                                <th scope="col" class="text-center align-middle custom-col">No</th>
                                <th scope="col" class="text-center align-middle custom-col">Unit Pengolah</th>
                                <th scope="col" class="text-center align-middle custom-col">Nomor Berkas</th>
                                <th scope="col" class="text-center align-middle custom-col">Nomor Dos</th>
                                <th scope="col" class="text-center align-middle custom-col">Judul Berkas</th>
                                <th scope="col" class="text-center align-middle custom-col">Kode Klasifikasi</th>
                                <th scope="col" class="text-center align-middle custom-col">Uraian Informasi Isi Berkas
                                </th>
                                <th scope="col" class="text-center align-middle custom-col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td colspan="8" class="text-center fw-bold table-custom-fs-larger">Tidak ada data
                                </td>
                            </tr> --}}
                            <tr>
                                <td class="text-center align-middle fw-bold table-custom-fs">1</td>
                                <td class="align-middle fw-bold table-custom-fs">PMU</td>
                                <td class="align-middle fw-bold table-custom-fs">21013136</td>
                                <td class="align-middle fw-bold table-custom-fs">P-100</td>
                                <td class="align-middle fw-bold table-custom-fs">Pelayanan Obat di Fasilitas Kesehatan
                                    Tingkat Pertama</td>
                                <td class="align-middle fw-bold table-custom-fs">PK.03.04</td>
                                <td class="align-middle fw-bold table-custom-fs">Berkas Klaim Pelayanan Obat di Fasilitas
                                    Kesehatan Tingkat Pertama Apotek Kimia Farma Gelora Juli 2023</td>
                                <td class="align-middle fw-bold table-custom-fs"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
