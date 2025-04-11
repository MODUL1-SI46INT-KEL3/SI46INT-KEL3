<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class PatientController extends Controller
{
    public function index() {
    
        $patients = Patient::all();
        $nav = 'Patients';
    
        return view('patients.index', compact('patients', 'nav'));
    }

    public function create() {
        $nav = 'Add Patient';
        return view('patients.register_patient', compact('nav'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:patient,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'id_card' => 'required|string|unique:patient,id_card',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Patient::create($validated); 

        return redirect()->route('patients.login')->with('success', 'Patient registered successfully!');
    }

    public function show(string $id) {
        $patient = Patient::findOrFail($id);
        $nav = 'Patient Details - ' . $patient->patient_name;
        return view('patients.show', compact('patient', 'nav'));
    }

    public function edit(string $id) {
        $patient = Auth::user();
        $nav = 'Edit Profile';
        return view('patients.edit', compact('patient', 'nav'));
    }

       public function update(Request $request, string $id) {
        $patient = Patient::findOrFail($id);

        $validatedData = $request->validate([
            'patient_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:patient,email,' . $id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $patient->update($validatedData);

        return redirect()->route('patients.profile')->with('success', 'Patient updated successfully.');
    }

    
    public function destroy(string $id) {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient has been deleted.');
    }

       
    public function showProfile() {
        $patient = Auth::user();
        $nav = 'YOUR PROFILE';
        return view('patients.profile', compact('nav', 'patient'));
    }


    public function showLoginForm() {
        $nav = 'Login';
        return view('patients.login', compact('nav'));
    }

    
    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $patient = Patient::where('username', $request->username)->first();

        if ($patient && Hash::check($request->password, $patient->password)) {
            Auth::login($patient);
            return redirect()->route('patients.index')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

}
