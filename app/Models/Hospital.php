<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Hospital extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    
    protected $fillable = [
        'uuid',
        'name',
        'code',
        'level',
        'region',
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
