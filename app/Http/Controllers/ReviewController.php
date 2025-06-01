<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category') ?? 'web';
        $reviews = Review::where('category', $category)->latest()->get();
        $doctors = Doctor::all();

        return view('reviews.index', compact('reviews', 'category', 'doctors'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        $category = request('category', 'web');
        return view('reviews.create', compact('doctors', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'category' => 'required|in:shop,appointment,web',
            'submitted_at' => 'required|date',
            'details' => 'required|string',
            'doctor_id' => 'required_if:category,appointment|exists:doctor,id',
        ]);

        $patientName = 'Anonymous';
        if (Auth::check()) {
            $user = Auth::user();
            $patientName = $user->patient_name ?? $user->name ?? 'Anonymous';
        }

        $details = $request->details;
        
        // Add context based on category
        if ($request->category === 'appointment' && $request->doctor_id) {
            $doctor = Doctor::find($request->doctor_id);
            if ($doctor) {
                $details = "Reviewing Appointment with Dr. {$doctor->name}: " . $details;
            }
        } elseif ($request->category === 'shop') {
            $details = "Medicine Purchase Review: " . $details;
        }

        Review::create([
            'patient_name' => $patientName,
            'rating' => $request->rating,
            'category' => $request->category,
            'submitted_at' => $request->submitted_at,
            'details' => $details,
            'doctor_id' => $request->doctor_id ?? null,
        ]);

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your review!'
            ]);
        }

        return redirect()->route('reviews.index')->with('success', 'Thank you for your review!');
    }

    public function show(string $id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.show', compact('review'));
    }

    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        $doctors = Doctor::all();
        return view('reviews.edit', compact('review', 'doctors'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'category' => 'required|in:shop,appointment,web',
            'submitted_at' => 'required|date',
            'details' => 'required|string',
            'doctor_id' => 'nullable|exists:doctor,id',
        ]);

        $review = Review::findOrFail($id);
        $review->update($request->all());

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}