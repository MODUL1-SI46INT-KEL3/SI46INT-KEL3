@extends('appointments.layout')

@section('content')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
        }
        .box_title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }
        .box_title img {
            width: 48px;
        }
        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }
        .dot.dot-1, .dot.dot-2, .dot.dot-3, .dot.dot-4 {
            background-color: #851216;
            border: 2px solid #851216;
        }
        .line1, .line2, .line3, .line4{
            border-top:3px solid #851216;
        }
        .appoint_details {
            border: 2px solid #d9d9d9;
            border-radius: 16px;
            padding: 24px;
            background: #fff;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            margin-bottom: 10px;
        }
        .label {
            font-weight: 600;
            color: #222;
        }
        .value {
            color: #555;
        }
        .info-section {
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e9ecef;
        }
        .info-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .section-title {
            font-weight: 600;
            color: #851216;
            margin-bottom: 12px;
            font-size: 1.1rem;
        }
        .buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .buttons a.finish-button {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            width: 150px;
            border: 2px solid #851216;
            background-color: #851216;
            font-size: 1rem;
            padding: 10px 0;
            text-align: center;
            display: inline-block;
            cursor: pointer;
            border-radius: 30px;
            color: white;
            text-decoration: none;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        .buttons a.finish-button:hover {
            background: #EB1F27;
            border-color: #EB1F27;
            transform: translateY(-1px);
        }
        .alert {
            padding: 12px 16px;
            margin-bottom: 16px;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Page Header -->
    <div class="box_title">
        <h2>Appointment Confirmed!</h2>
        <div>
            <img src="{{ asset('icons/check.png') }}" alt="Confirmation Check">
        </div>
    </div>

    <!-- Appointment Details -->
    <div class="appoint_details">
        <!-- Booking Information -->
        <div class="info-section">
            <div class="section-title">📋 Booking Information</div>
            <div class="info-row">
                <span class="label">Booking ID:</span>
                <span class="value">{{ $appointment->booking_id }}</span>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="info-section">
            <div class="section-title">👤 Patient Information</div>
            <div class="info-row">
                <span class="label">Name:</span>
                <span class="value">{{ $patient->patient_name }}</span>
            </div>
            <div class="info-row">
                <span class="label">Date of Birth:</span>
                <span class="value">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="label">Phone:</span>
                <span class="value">{{ $patient->phone }}</span>
            </div>
            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value">{{ $patient->email }}</span>
            </div>
        </div>

        <!-- Appointment Information -->
        <div class="info-section">
            <div class="section-title">🩺 Appointment Details</div>
            <div class="info-row">
                <span class="label">Doctor:</span>
                <span class="value">{{ $appointment->doctor->name }}</span>
            </div>
            <div class="info-row">
                <span class="label">Specialization:</span>
                <span class="value">{{ $appointment->doctor->specialization->name }}</span>
            </div>
            <div class="info-row">
                <span class="label">Date:</span>
                <span class="value">
                    @if($appointment->schedule)
                        {{ \Carbon\Carbon::parse($appointment->schedule->available_date)->format('D, M j, Y') }}
                    @else
                        <span style="color: #dc3545;">N/A</span>
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="label">Time:</span>
                <span class="value">
                    @if($appointment->schedule && $appointment->schedule->start_time && $appointment->schedule->end_time)
                        {{ \Carbon\Carbon::parse($appointment->schedule->start_time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($appointment->schedule->end_time)->format('H:i') }}
                    @else
                        <span style="color: #dc3545;">N/A</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="buttons">
        <a href="{{ route('patients.index') }}" class="finish-button">Finish</a>
    </div>
@endsection

@section('review-section')
<div class="review-section-right">
    <h3>🌟 Share Your Experience</h3>
    <p>Help us improve by sharing your appointment booking experience</p>
    <div style="text-align: center; margin-bottom: 15px;">
        <button type="button" class="toggle-btn" onclick="toggleReviewForm()">
            <span id="toggleText">Leave a Review</span>
        </button>
    </div>
    <div class="review-form-container" id="reviewFormContainer" style="display: none;">
        <div class="review-form" id="reviewFormBox">
            <form action="{{ route('reviews.store') }}" method="POST" id="appointmentReviewForm">
                @csrf
                <input type="hidden" name="category" value="appointment">
                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                <input type="hidden" name="submitted_at" value="{{ now()->toIso8601String() }}">
                <div style="text-align: center; margin-bottom: 15px;">
                    <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 0.9rem;">
                        How would you rate your experience?
                    </label>
                    <div class="star-rating" id="starRating">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <input type="hidden" name="rating" id="appointmentRating" required>
                </div>
                <label style="font-weight: 600; margin-bottom: 6px; display: block; font-size: 0.9rem;">
                    Share your feedback:
                </label>
                <textarea 
                    name="details" 
                    class="form-control" 
                    rows="3" 
                    placeholder="How was your booking experience?"
                    required
                ></textarea>
                <button type="submit" class="submit-btn">
                    Submit Review
                </button>
            </form>
        </div>
        <div id="reviewThankYou" style="display: none; text-align: center; padding: 20px; background: #d4edda; border-radius: 15px; margin-top: 15px;">
            <h3 style="color: #155724;">Thank you for your feedback!</h3>
            <p style="color: #155724;">We appreciate your input.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle review form functionality
    window.toggleReviewForm = function() {
        const container = document.getElementById('reviewFormContainer');
        const toggleText = document.getElementById('toggleText');
        const toggleBtn = document.querySelector('.toggle-btn');
        if (container && toggleText && toggleBtn) {
            if (container.style.display === 'none' || container.style.display === '') {
                container.style.display = 'block';
                toggleText.textContent = 'Hide Review Form';
                toggleBtn.style.background = '#6c757d';
            } else {
                container.style.display = 'none';
                toggleText.textContent = 'Leave a Review';
                toggleBtn.style.background = '#851216';
            }
        }
    };

    // Star rating functionality
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('appointmentRating');
    let currentRating = 0;
    if (stars.length && ratingInput) {
        stars.forEach((star, index) => {
            star.addEventListener('click', function() {
                currentRating = parseInt(this.getAttribute('data-value'));
                ratingInput.value = currentRating;
                updateStarDisplay(currentRating);
            });
            star.addEventListener('mouseenter', function() {
                const hoverValue = parseInt(this.getAttribute('data-value'));
                updateStarDisplay(hoverValue);
            });
        });
        const starRating = document.querySelector('.star-rating');
        if (starRating) {
            starRating.addEventListener('mouseleave', function() {
                updateStarDisplay(currentRating);
            });
        }
        function updateStarDisplay(rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }
    }

    // AJAX form submission with correct headers
    const reviewForm = document.getElementById('appointmentReviewForm');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate required fields
            if (!ratingInput.value) {
                alert('Please select a rating before submitting your review.');
                return false;
            }
            const textarea = this.querySelector('textarea[name="details"]');
            if (!textarea.value.trim()) {
                alert('Please provide your feedback before submitting.');
                return false;
            }

            // Prepare form data
            const formData = new FormData(this);

            // AJAX POST with correct headers
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById('reviewFormBox').style.display = 'none';
                    document.getElementById('reviewThankYou').style.display = 'block';
                    document.querySelector('.toggle-btn').style.display = 'none';
                }
            })
            .catch(error => {
                if (error.errors) {
                    alert(Object.values(error.errors).join('\n'));
                } else {
                    alert('Failed to submit review. Please try again.');
                }
            });
        });
    }
});
</script>
@endpush