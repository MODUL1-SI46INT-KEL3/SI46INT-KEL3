<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMedicalRecordController extends Controller
{
    /**
     * Display a listing of all medical records.
     */
    public function index(Request $request)
    {
        $medicalRecords = MedicalRecord::with(['patient', 'doctor']);
        $nav = 'Medical Records';
        $search = $request->input('search');

        if ($search) {
            $medicalRecords->whereHas('patient', function($query) use ($search) {
                $query->where('patient_name', 'like', "%{$search}%");
            });
        }

        $medicalRecords = $medicalRecords->orderBy('visit_date', 'desc')
            ->orderBy('visit_time', 'desc')
            ->get();
        
        return view('admins.adminMedicalRecord.index', compact('medicalRecords', 'nav', 'search'));
    }

    /**
     * Display the specified medical records for a patient.
     */
    public function show($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $medicalRecords = MedicalRecord::where('PatientUser_id', $patientId)
            ->with('doctor')
            ->orderBy('visit_date', 'desc')
            ->orderBy('visit_time', 'desc')
            ->get();
        $nav = 'Patient Medical Records';
        
        return view('admins.adminMedicalRecord.show', compact('patient', 'medicalRecords', 'nav'));
    }

    /**
     * View a specific medical record.
     */
    public function view($id)
    {
        $medicalRecord = MedicalRecord::with(['patient', 'doctor'])->findOrFail($id);
        $nav = 'View Medical Record';

        // Parse assessment, diagnosis, and treatment from notes
        $notes = $medicalRecord->notes;
        $assessment = '';
        $diagnosis = '';
        $treatment = '';
        
        if (preg_match('/Assessment: ([^\n]+)/', $notes, $matches)) {
            $assessment = $matches[1];
        }
        
        if (preg_match('/Diagnosis: ([^\n]+)/', $notes, $matches)) {
            $diagnosis = $matches[1];
        }
        
        if (preg_match('/Treatment: ([^\n]+)/', $notes, $matches)) {
            $treatment = $matches[1];
        }
        
        // Add these parsed values to the medical record object for the view
        $medicalRecord->assessment = $assessment;
        $medicalRecord->diagnosis = $diagnosis;
        $medicalRecord->treatment = $treatment;
        
        return view('admins.adminMedicalRecord.view', compact('medicalRecord', 'nav'));
    }

    /**
     * Download the file attached to the medical record.
     */
    public function downloadFile($id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);
        
        if (!$medicalRecord->file_path) {
            return back()->with('error', 'No file attached to this medical record.');
        }
        
        if (!Storage::disk('public')->exists($medicalRecord->file_path)) {
            return back()->with('error', 'File not found.');
        }
        
        return Storage::disk('public')->download($medicalRecord->file_path);
    }

    /**
     * Print the medical record as a report.
     */
    public function printReport($id)
    {
        $medicalRecord = MedicalRecord::with(['patient', 'doctor'])->findOrFail($id);
        
        // Parse assessment, diagnosis, and treatment from notes
        $notes = $medicalRecord->notes;
        $assessment = '';
        $diagnosis = '';
        $treatment = '';
        
        if (preg_match('/Assessment: ([^\n]+)/', $notes, $matches)) {
            $assessment = $matches[1];
        }
        
        if (preg_match('/Diagnosis: ([^\n]+)/', $notes, $matches)) {
            $diagnosis = $matches[1];
        }
        
        if (preg_match('/Treatment: ([^\n]+)/', $notes, $matches)) {
            $treatment = $matches[1];
        }
        
        // Add these parsed values to the medical record object for the view
        $medicalRecord->assessment = $assessment;
        $medicalRecord->diagnosis = $diagnosis;
        $medicalRecord->treatment = $treatment;
        
        return view('admins.adminMedicalRecord.print', compact('medicalRecord'));
    }
}
