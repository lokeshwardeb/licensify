<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_key',
        'customer_name',
        'domain',
        'is_active',
        'expires_at',
    ];

    // ✅ Tell Laravel to treat expires_at as a date
    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
