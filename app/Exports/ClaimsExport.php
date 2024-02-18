<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ClaimsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting
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
            'Nomor Register RI',
            'Nomor Register RJ',
            'Tanggal Klaim Dibuat',
            'Tanggal BA',
            'Jatuh Tempo',
            'Tanggal BA Lengkap',
            'Status',
            'Nomor FPK RI',
            'Nomor FPK RJ',
            'Tanggal BAHV',
            'Tanggal Register BOA',
            'Tanggal Setuju Kepala Bagian',
            'Dibuat pada',
            'Diperbarui pada'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
