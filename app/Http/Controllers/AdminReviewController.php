<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    /**
     * Display a list of reviews by category.
     */
    public function index(Request $request)
    {
        $category = $request->query('category');

        $reviews = $category
            ? Review::where('category', $category)->latest()->get()
            : Review::latest()->get();

        return view('admins.adminreviews.index', compact('reviews', 'category'));
    }


    /**
     * Show a single review.
     */
    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('admins.adminreviews.show', compact('review'));
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
