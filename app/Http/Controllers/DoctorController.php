<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $doctors = Doctor::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhereHas('specialization', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->get();
        } else {
            $doctors = Doctor::all();
        }

        return view('doctors.index', compact('doctors', 'query'));
    }

    public function create()
    {
        $nav = 'Add Doctor';
        return view('doctors.register_doctor', compact('nav'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'working_hours' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'specialization_id' => 'required|integer|exists:specializations,id', 
            'phone' => 'required|string|max:15',
            'license_number' => 'required|string|max:50|unique:doctors,license_number',
        ]);

        $validateData['password'] = bcrypt($validateData['password']); 

        Doctor::create($validateData);
        return redirect()->route('doctors.index')->with('success', 'Doctor has been added.');
    }

    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $nav = 'Doctor Details - ' . $doctor->name;
        return view('doctors.show', compact('doctor', 'nav'));
    }

    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $nav = 'Edit Doctor - ' . $doctor->name;
        return view('doctors.edit', compact('doctor', 'nav'));
    }

    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'working_hours' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'specialization_id' => 'required|integer|exists:specializations,id', 
            'phone' => 'required|string|max:15',
            'license_number' => 'required|string|max:50|unique:doctors,license_number,' . $doctor->id,
        ]);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']); 
        }

        $doctor->update($validateData);
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor has been deleted.');
    }
}