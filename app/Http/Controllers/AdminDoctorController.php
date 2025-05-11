<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminDoctorController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        if ($keyword) {
            $doctors = Doctor::with('schedules')->where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('license_number', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->get();
        } else {
            $doctors = Doctor::with('schedules')->get();
        }

        return view('admins.admindoctors.index', compact('doctors', 'keyword'));
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
            // Removed 'working_hours' validation
            'password' => 'required|string|min:8',
            'specialization_id' => 'required|integer|exists:specializations,id',
            'phone' => 'required|string|max:15',
            'license_number' => 'required|string|max:50|unique:doctor,license_number',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/doctors'), $filename);
            $validateData['photo'] = 'uploads/doctors/' . $filename;
        }

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
            // Removed 'working_hours' validation
            'password' => 'nullable|string|min:8',
            'specialization_id' => 'required|integer|exists:specializations,id',
            'phone' => 'required|string|max:15',
            'license_number' => 'required|string|max:50|unique:doctor,license_number,' . $doctor->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($doctor->photo && file_exists(public_path($doctor->photo))) {
                unlink(public_path($doctor->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/doctors'), $filename);
            $validateData['photo'] = 'uploads/doctors/' . $filename;
        }

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']);
        } else {
            unset($validateData['password']);
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
