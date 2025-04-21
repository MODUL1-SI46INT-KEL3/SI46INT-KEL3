<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the medical records.
     */
    public function index()
    {
        $doctor = Auth::guard('doctor')->user();
        $patients = Patient::all();
        $doctors = Doctor::with('specialization')->get();
        
        return view('doctors.medical_records.index', compact('patients', 'doctor', 'doctors'));
    }

    /**
     * Show the form for creating a new medical record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Check if patient_id is provided in the request
        if ($request->has('patient_id')) {
            $patient = Patient::findOrFail($request->patient_id);
            return view('doctors.medical_records.create', compact('patient'));
        }
        
        // If no patient_id is provided, show all patients to select from
        $patients = Patient::all();
        return view('doctors.medical_records.index', compact('patients'));
    }

    /**
     * Store a newly created medical record in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patient,id',
            'assessment' => 'required|string|max:255',
            'diagnosis' => 'required|string|max:255',
            'treatment' => 'required|string|max:255',
            'date_of_consultation' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $doctor = Auth::guard('doctor')->user();
        
        // Combine assessment, diagnosis, and treatment into notes
        $notes = "Assessment: {$request->assessment}\nDiagnosis: {$request->diagnosis}\nTreatment: {$request->treatment}"; 
        
        $medicalRecord = new MedicalRecord([
            'PatientUser_id' => $request->patient_id,
            'DoctorUser_id' => $doctor->id,
            'visit_date' => $request->date_of_consultation,
            'visit_time' => now()->format('H:i'),
            'notes' => $notes,
        ]);

        // Handle file upload if provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('medical_records', $filename, 'public');
            $medicalRecord->file_path = $path;
        }

        $medicalRecord->save();

        return redirect()->route('medical-records.show', $medicalRecord->PatientUser_id)
            ->with('success', 'Medical record created successfully.');
    }

    /**
     * Display the specified medical records for a patient.
     */
    public function show($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $medicalRecords = MedicalRecord::where('PatientUser_id', $patientId)
            ->orderBy('visit_date', 'desc')
            ->orderBy('visit_time', 'desc')
            ->get();
        
        return view('doctors.medical_records.show', compact('patient', 'medicalRecords'));
    }

    /**
     * Show the form for editing the specified medical record.
     */
    public function edit($id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $patients = Patient::all();
        
        return view('doctors.medical_records.edit', compact('medicalRecord', 'patients'));
    }

    /**
     * Update the specified medical record in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'visit_time' => 'required|date_format:H:i',
        ]);

        $medicalRecord = MedicalRecord::findOrFail($id);
        
        $medicalRecord->notes = $request->notes;
        $medicalRecord->visit_date = $request->visit_date;
        $medicalRecord->visit_time = $request->visit_time;

        $medicalRecord->save();

        return redirect()->route('medical-records.show', $medicalRecord->PatientUser_id)
            ->with('success', 'Medical record updated successfully.');
    }

    /**
     * Remove the specified medical record from storage.
     */
    public function destroy($id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $patientId = $medicalRecord->PatientUser_id;
        
        $medicalRecord->delete();

        return redirect()->route('medical-records.show', $patientId)
            ->with('success', 'Medical record deleted successfully.');
    }
}
