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
    const STATUS_TELAH_REGISTER_BOA = "Klaim Telah Teregister di BOA (Menunggu Pembayaran)";
    const STATUS_TELAH_BAYAR = "Pembayaran Telah Dilakukan";
    protected $primaryKey = 'uuid';
    
    protected $fillable = [
        'uuid',
        'user_uuid',
        'hospital_name',
        'claim_type',
        'month',
        'created_date',
        'ba_date',
        'completion_limit_date',
        'file_completeness',
        'status',
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
        return $this->belongsTo(Hospital::class, 'hospital_name', 'name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
