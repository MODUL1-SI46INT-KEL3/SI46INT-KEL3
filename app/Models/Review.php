<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name', // Add this to fillable
        'rating',
        'category',
        'submitted_at',
        'details',
    ];

    // Set default value for patient_name
    protected $attributes = [
        'patient_name' => 'Anonymous',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'rating' => 'integer', // Add this for better type handling
    ];

    // Add some helper methods
    public function getFormattedDateAttribute()
    {
        return $this->submitted_at->format('M d, Y');
    }

    public function getStarDisplayAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $this->rating ? '★' : '☆';
        }
        return $stars;
    }
}