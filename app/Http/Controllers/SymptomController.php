<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::all();
        return view('symptoms.index', compact('symptoms'));
    }

    public function recommend(Request $request)
    {
        $request->validate([
            'symptoms' => 'required|array|min:2|max:4',
            'symptoms.*' => 'exists:symptoms,id',
        ]);

        $selectedSymptoms = Symptom::whereIn('id', $request->symptoms)
            ->with('specializations')
            ->get();

        $specializationCounts = [];
        foreach ($selectedSymptoms as $symptom) {
            foreach ($symptom->specializations as $specialization) {
                $specializationCounts[$specialization->id] = 
                    ($specializationCounts[$specialization->id] ?? 0) + 1;
            }
        }

        if (empty($specializationCounts)) {
            return back()->with('error', 'No specializations found for the selected symptoms.');
        }

        $maxCount = max($specializationCounts);
        $recommendedIds = array_keys(
            array_filter($specializationCounts, fn($count) => $count === $maxCount)
        );

        $recommendedSpecializations = Specialization::whereIn('id', $recommendedIds)->get();
        $symptoms = Symptom::all();

        return view('symptoms.index', [
            'symptoms' => $symptoms,
            'recommendedSpecializations' => $recommendedSpecializations,
            'selectedSymptomIds' => $request->symptoms
        ]);
    }
}