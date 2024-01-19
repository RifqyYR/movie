<?php

namespace App\Exports;

use App\Models\Archive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArchiveExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Archive::all();
    }

    public function headings(): array
    {
        return [
            'Id Arsip',
            'UUID Arsip',
            'UUID Faskes',
            'Unit Pengolah',
            'Nomor Berkas',
            'Nomor Dos',
            'Judul Berkas',
            'Kode Klasifikasi',
            'Nama Faskes',
            'Bulan',
            'Tahun',
            'Keterangan',
            'Uraian Informasi Berkas',
            'Jadwal Retensi Aktif',
            'Jadwal Retensi Inaktif',
            'created_at',
            'updated_at'
        ];
    }    
}
