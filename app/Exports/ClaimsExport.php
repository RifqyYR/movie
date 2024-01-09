<?php

namespace App\Exports;

use App\Models\Claim;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClaimsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Claim::all();
    }

    public function headings(): array
    {
        return [
            'uuid',
            'hospital_uuid',
            'user_uuid',
            'Nama Faskes',
            'Nomor Register BOA',
            'Tingkat',
            'Tipe Klaim',
            'Bulan Pelayanan',
            'Tanggal Klaim Dibuat',
            'Tanggal BA',
            'Jatuh Tempo',
            'Tanggal BA Lengkap',
            'Status',
            'Dibuat pada',
            'Diperbarui pada'
        ];
    }
}
