<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class DoctorReviewController extends Controller
{
    public function index(Request $request)
{
    $doctors = \App\Models\Doctor::orderBy('name')->get();

    $query = Review::where('category', 'appointment')
                   ->where('status', 1)
                   ->orderBy('submitted_at', 'desc');

    $selectedDoctorId = $request->query('doctor_id');

    if ($selectedDoctorId) {
        $query->where('doctor_id', $selectedDoctorId);
    }

    $reviews = $query->get();

    // Pass the logged-in doctor as $auth for display
    $auth = Auth::guard('doctor')->user();

    return view('doctordash.reviews.index', compact('reviews', 'doctors', 'selectedDoctorId', 'auth'));
}

}

