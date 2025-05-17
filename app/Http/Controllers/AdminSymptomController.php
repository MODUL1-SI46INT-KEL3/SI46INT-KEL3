<?php

namespace App\Http\Controllers;

use App\Models\Symptom; 
use App\Models\Specialization;
use Illuminate\Http\Request;

class AdminSymptomController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::all();
        
        return view('admins.adminsymptoms.index', compact('symptoms'));
    }

    public function create()
    {
        $specializations = Specialization::all(); 

        return view('admins.adminsymptoms.create', compact('specializations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specializations' => 'required|array|min:1|max:4', 
            'specializations.*' => 'exists:specializations,id', 
        ]);

        $symptom = Symptom::create([
            'name' => $validated['name'],
        ]);

        $symptom->specializations()->attach($validated['specializations']);

        return redirect()->route('adminsymptoms.index')
                         ->with('success', 'Symptom created successfully!');
    }

    public function edit($id)
    {
        $symptom = Symptom::findOrFail($id);

        $specializations = Specialization::all();

        return view('admins.adminsymptoms.edit', compact('symptom', 'specializations'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'specializations' => 'required|array',
    ]);

    $symptom = Symptom::findOrFail($id);
    $symptom->name = $request->name;
    $symptom->save();

    $symptom->specializations()->sync($request->specializations);

    return redirect()->route('adminsymptoms.index')->with('success', 'Symptom updated successfully');
    }

    public function destroy($id)
    {
    $symptom = Symptom::findOrFail($id);
    $symptom->delete();

    return redirect()->route('adminsymptoms.index')
                     ->with('success', 'Symptom deleted successfully!');
    }

}