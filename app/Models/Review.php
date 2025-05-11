<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'category',
        'submitted_at',
        'details',
        // 'patient_name' is not fillable because you set it in controller or default
    ];

    // Set default value for patient_name
    protected $attributes = [
        'patient_name' => 'Anonymous',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];
}
