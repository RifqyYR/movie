<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Claim extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    
    protected $fillable = [
        'uuid',
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
}
