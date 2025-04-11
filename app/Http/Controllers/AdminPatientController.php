<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminPatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all(); 
        $nav = 'Patients';
        
        return view('admins.adminPatient.index', compact('patients', 'nav')); 
    }

    public function create()
    {
        $nav = 'Add Patient';
        return view('admins.adminPatient.create', compact('nav'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'patient_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:patient,email',
            'phone' => 'required',
            'address' => 'required',
            'id_card' => 'required|string|unique:patient,id_card',
        ]);
    


        $validatedData['password'] = bcrypt('defaultPassword123');

        Patient::create($validatedData);
    
        return redirect()->route('adminPatient.index')->with('success', 'Patient has been added.');
    }

    public function show(string $id)
    {
        $patient = Patient::findOrFail($id);
        $nav = 'Patient Details - ' . $patient->name;
        return view('adminPatient.show', compact('patient', 'nav'));
    }
   
    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        $nav = 'Edit Patient';

        return view('admins.adminPatient.edit', compact('patient', 'nav'));
    }

    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $validatedData = $request->validate([
            'patient_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:patient,email,' . $id,
            'phone' => 'required',
            'address' => 'required',
            'id_card' => 'required|string|unique:patient,id_card,' . $id,
        ]);

        $patient->update($validatedData);

        return redirect()->route('adminPatient.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('adminPatient.index')->with('success', 'Patient has been deleted.');
    }

}