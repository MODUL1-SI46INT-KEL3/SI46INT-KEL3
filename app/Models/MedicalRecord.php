<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $table = 'medical_records';
    protected $primaryKey = 'record_id';
    
    protected $fillable = [
        'notes',
        'visit_date',
        'visit_time',
        'PatientUser_id',
        'DoctorUser_id',
        'file_path'
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visit_time' => 'datetime'
    ];

    /**
     * Get the patient that owns the medical record
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'PatientUser_id');
    }

    /**
     * Get the doctor that created the medical record
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'DoctorUser_id');
    }
}
