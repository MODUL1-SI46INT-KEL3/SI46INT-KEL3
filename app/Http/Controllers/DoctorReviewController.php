<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DoctorReviewController extends Controller
{
    public function index()
    {
        $doctorId = Auth::guard('doctor')->id();

        // Fetch only 'appointment' reviews that are sent and belong to this doctor
        $reviews = Review::where('category', 'appointment')
                         ->where('status', 1)
                         ->where('doctor_id', $doctorId)
                         ->orderBy('submitted_at', 'desc')
                         ->get();

        return view('doctordash.reviews.index', compact('reviews'));
    }
}

