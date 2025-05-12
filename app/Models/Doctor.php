<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; 

class Doctor extends Model implements Authenticatable 
{
    use AuthenticatableTrait;

    protected $table = 'doctor'; 

    protected $fillable = [
         'name', 'email', 'password', 'specialization_id', 'phone', 'license_number', 'photo'
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get formatted working hours as "09:00-12:00, 13:00-17:00"
     */
    public function getWorkingHoursAttribute()
    {
        $schedules = $this->schedules()
            ->where('is_available', true)
            ->orderBy('available_date')
            ->orderBy('start_time')
            ->get();

        $timeRanges = $schedules->map(function ($schedule) {
            return date('H:i', strtotime($schedule->start_time)) . '-' . date('H:i', strtotime($schedule->end_time));
        });

        return $timeRanges->implode(', ');
    }
}
