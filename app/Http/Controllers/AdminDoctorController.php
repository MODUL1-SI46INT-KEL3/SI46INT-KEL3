<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('admins.admindoctors.index', compact('doctors'));
    }

    public function create()
    {
        $nav = 'Add Doctor';
        return view('admins.admindoctors.add', compact('nav'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctor,email',
            'working_hours' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'specialization_id' => 'required|integer|exists:specializations,id',
            'phone' => 'required|string|max:15',
            'license_number' => 'required|string|max:50|unique:doctor,license_number',
        ]);

        $validateData['password'] = bcrypt($validateData['password']); 

        Doctor::create($validateData);
        return redirect()->route('admindoctors.index')->with('success', 'Doctor has been added.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $nav = 'Edit Doctor - ' . $doctor->name;
        return view('admins.admindoctors.edit', compact('doctor', 'nav'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctor,email,' . $doctor->id,
            'working_hours' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'specialization_id' => 'required|integer|exists:specializations,id',
            'phone' => 'required|string|max:15',
            'license_number' => 'required|string|max:50|unique:doctor,license_number,' . $doctor->id,
        ]);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        $doctor->update($validateData);
        return redirect()->route('admindoctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('admindoctors.index')->with('success', 'Doctor has been deleted.');
    }
}