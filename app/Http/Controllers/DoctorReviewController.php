<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class DoctorReviewController extends Controller
{
    public function index()
    {
        // Only get appointment reviews where status is 1 (sent)
        $reviews = Review::where('category', 'appointment')
                         ->where('status', 1)
                         ->orderBy('submitted_at', 'desc')
                         ->get();

        return view('doctordash.reviews.index', compact('reviews'));
    }
}

