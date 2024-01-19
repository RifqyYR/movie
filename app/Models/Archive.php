<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'hospital_uuid',
        'unit_name',
        'archive_number',
        'dos_number',
        'archive_title',
        'classification_code',
        'hospital_name',
        'month',
        'year',
        'file_content_information',
        'description',
        'status',
        'active_retention_schedule',
    ];

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
