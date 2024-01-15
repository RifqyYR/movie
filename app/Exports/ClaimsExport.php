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
    protected $claims;

    public function __construct($claims)
    {
        $this->claims = $claims;
    }

    public function collection()
    {
        return $this->claims;
    }

    public function headings(): array
    {
        return [
            'uuid',
            'hospital_uuid',
            'user_uuid',
            'Nama Faskes',
            'Tingkat',
            'Tipe Klaim',
            'Bulan Pelayanan',
            'Nomor RITL',
            'Nomor RJTL',
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
