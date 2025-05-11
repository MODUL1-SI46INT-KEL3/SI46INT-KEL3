<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

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

        Review::create([
            'patient_name' => auth()->check() ? auth()->user()->name : 'Anonymous',
            'rating' => $request->rating,
            'category' => $request->category,
            'submitted_at' => $request->submitted_at,
            'details' => $request->details,
        ]);
        
        // Add this flash message
     return redirect()->route('reviews.index')->with('success', 'Thank you for your feedback! We appreciate your time.');
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

        return redirect()->route('review.index')->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.index')->with('success', 'Review deleted successfully.');
    }
}
