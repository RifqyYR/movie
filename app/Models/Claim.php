<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Claim extends Model
{
    use HasFactory;

    const STATUS_BA_SERAH_TERIMA = "BA Serah Terima";
    const STATUS_BA_KELENGKAPAN_BERKAS = "BA Kelengkapan Berkas";
    const STATUS_BA_HASIL_VERIFIKASI = "BA Hasil Verifikasi";
    const STATUS_TELAH_REGISTER_BOA = "Klaim Telah Teregister di BOA";
    const STATUS_TELAH_SETUJU = "Klaim Telah Disetujui (Menunggu Pembayaran)";
    const STATUS_TELAH_BAYAR = "Pembayaran Telah Dilakukan";
    protected $primaryKey = 'uuid';
    
    protected $fillable = [
        'uuid',
        'hospital_uuid',
        'user_uuid',
        'ritl_number',
        'rjtl_number',
        'hospital_name',
        'level',
        'claim_type',
        'month',
        'created_date',
        'ba_date',
        'completion_limit_date',
        'file_completeness',
        'status',
        'fpk_number_ri',
        'fpk_number_rj',
        'bahv_date',
        'register_boa_date',
        'approve_head_date',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid7();
        });
    }    

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
