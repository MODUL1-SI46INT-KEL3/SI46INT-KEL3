<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index(Request $request)
    {
        $category = $request->query('category') ?? 'web'; // default to 'web'

        $reviews = Review::where('category', $category)->latest()->get();

        return view('reviews.index', compact('reviews', 'category'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created review in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'category' => 'required|in:shop,appointment,web',
        'submitted_at' => 'required|date',
        'details' => 'required|string',
    ]);

    $patientName = 'Anonymous';
    if (Auth::check()) {
        $user = Auth::user();
        $patientName = $user->patient_name ?? $user->name ?? 'Anonymous';
    }

    Review::create([
        'patient_name' => $patientName,
        'rating' => $request->rating,
        'category' => $request->category,
        'submitted_at' => $request->submitted_at,
        'details' => $request->details,
    ]);

    // If AJAX, return JSON
    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    // Otherwise, fallback to redirect
    if ($request->category === 'appointment') {
        return redirect()->route('reviews.index')->with('success', 'Thank you for reviewing your appointment experience!');
    } elseif ($request->category === 'shop') {
        return redirect()->route('reviews.index')->with('success', 'Thank you for reviewing your medicine purchase!');
    } else {
        return redirect()->route('reviews.index')->with('success', 'Thank you for your feedback! We appreciate your time.');
    }
}

    /**
     * Display the specified review.
     */
    public function show(string $id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified review.
     */
    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'category' => 'required|in:shop,appointment,web',
            'submitted_at' => 'required|date',
            'details' => 'required|string',
        ]);

        $review = Review::findOrFail($id);
        $review->update($request->all());

        // Fix: Use correct route name
        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        // Fix: Use correct route name
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}