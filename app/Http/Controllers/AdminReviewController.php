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
    public function markAsSent($id)
    {
        $review = Review::findOrFail($id);
        $review->status = true; // or 1
        $review->save();

        return redirect()->route('adminreviews.index')->with('success', 'Review sent to doctor.');
    }
    public function markAsUnsent($id)
    {
        $review = Review::findOrFail($id);
        $review->status = false;
        $review->save();

        return redirect()->route('adminreviews.index')->with([
            'message' => 'Review retracted successfully.',
            'alert-type' => 'warning'
        ]);

    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('adminreviews.index')->with([
            'message' => 'Review deleted successfully.',
            'alert-type' => 'danger'
        ]);}
}
