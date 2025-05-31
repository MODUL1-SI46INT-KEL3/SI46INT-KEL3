@extends('patients.checkout.partials.app')

@section('content')

<style>
.review-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 25px;
    margin-top: 30px;
    border: 2px solid #e9ecef;
    text-align: center;
}

.review-btn {
    background: linear-gradient(45deg, #851216, #EB1F27);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(133, 18, 22, 0.3);
    margin-top: 15px;
    cursor: pointer;
}

.review-btn:hover {
    background: linear-gradient(45deg, #6d0e10, #d11c22);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(133, 18, 22, 0.4);
    color: white;
    text-decoration: none;
}

.review-btn:active {
    transform: translateY(0);
}

.review-icon {
    font-size: 1.2rem;
}

.success-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.success-header {
    text-align: center;
    margin-bottom: 30px;
}

.success-header h2 {
    color: #28a745;
    font-weight: 700;
    margin-bottom: 10px;
}

.success-header p {
    color: #6c757d;
    font-size: 1.1rem;
}

.purchase-details {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.purchase-details h4 {
    color: #333;
    margin-bottom: 20px;
    font-weight: 600;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f1f1f1;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-row.total {
    font-weight: 700;
    font-size: 1.1rem;
    color: #333;
    border-top: 2px solid #851216;
    margin-top: 10px;
    padding-top: 15px;
}

.payment-method {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    color: #495057;
    margin-top: 15px;
}

.animate-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.review-form-container {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin: 15px auto;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    max-width: 700px;
    width: 100%;
}

.star-rating {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin: 15px 0;
}

.star {
    font-size: 3.5rem;
    color: #FFD700;
    cursor: pointer;
    transition: color 0.2s ease;
    user-select: none;
}

.star.unselected {
    color: #ddd;
}

.star:hover {
    color: #FFA500;
}

.form-control:focus {
    outline: none;
    border-color: #851216;
    box-shadow: 0 0 0 2px rgba(133, 18, 22, 0.2);
}

.submit-btn:hover {
    background: linear-gradient(45deg, #6d0e10, #d11c22) !important;
    transform: translateY(-1px);
}

.review-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 25px;
    margin-top: 30px;
    border: 2px solid #e9ecef;
    text-align: center;
    max-width: 100%;
}

.review-form-container {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin: 15px auto;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    max-width: 700px;
    width: 100%;
}

.star-rating {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin: 15px 0;
}

.star {
    font-size: 3.5rem;
    color: #FFD700;
    cursor: pointer;
    transition: color 0.2s ease;
    user-select: none;
}

.star.unselected {
    color: #ddd;
}

/* Form elements styling for better spacing */
.review-form-container textarea {
    width: 100%;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    resize: vertical;
    font-family: inherit;
    font-size: 1rem;
    min-height: 120px;
    box-sizing: border-box;
}

.review-form-container label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    font-size: 1rem;
    text-align: left;
}

.submit-btn {
    width: 100%;
    margin-top: 20px;
    padding: 15px;
    background: linear-gradient(45deg, #851216, #EB1F27);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .success-container {
        max-width: 95%;
        padding: 15px;
    }

    .review-form-container {
        padding: 20px;
        margin: 15px 5px;
    }

    .star {
        font-size: 2.5rem;
    }
}
</style>

<div class="success-container">
    <div class="success-header">
        <div class="animate-bounce" style="font-size: 4rem; color: #28a745; margin-bottom: 20px;">
            ✅
        </div>
        <h2>Purchase Complete</h2>
        <p>Thank you, and get well soon!</p>
    </div>

    <div class="purchase-details">
        <h4>📋 Purchase Details</h4>

        <div class="detail-row">
            <span>Cost (Item purchased)</span>
            <span>Rp{{ number_format($grandTotal ?? 0, 0, ',', '.') }}</span>
        </div>

        <div class="detail-row">
            <span>Service Fee (included)</span>
            <span>Rp500</span>
        </div>

        <div class="detail-row">
            <span>Service Fee 2 (included)</span>
            <span>Rp500</span>
        </div>

        <div class="detail-row total">
            <span>Total Payment</span>
            <span>Rp{{ number_format($grandTotal ?? 0, 0, ',', '.') }}</span>
        </div>

        <div class="payment-method">
            <strong>💳 Paid via:</strong> {{ $paymentMethod }}
        </div>
    </div>

    <!-- Review Section -->
    <div class="review-section">
        <h5 style="color: #851216; margin-bottom: 15px; font-weight: 600;">
            <span class="review-icon">🌟</span>
            Share Your Experience
        </h5>
        <p style="color: #6c757d; margin-bottom: 0; font-size: 0.95rem;">
            Help us improve by sharing your medicine purchase experience
        </p>

        <div style="text-align: center; margin: 15px 0;">
            <button type="button" class="review-btn" onclick="toggleReviewForm()">
                <span id="toggleText">Write a Review</span>
            </button>
        </div>

        <div class="review-form-container" id="reviewFormContainer" style="display: none;">
            <div class="review-form" id="reviewFormBox">
                <form action="{{ route('reviews.store') }}" method="POST" id="purchaseReviewForm">
                    @csrf
                    <input type="hidden" name="category" value="shop">
                    <input type="hidden" name="submitted_at" value="{{ now() }}">
                    @if(isset($paymentId))
                        <input type="hidden" name="payment_id" value="{{ $paymentId }}">
                    @endif

                    <label>Rate your purchase experience:</label>
                    <div class="star-rating" id="star-rating">
                        <span class="star unselected" data-value="1">★</span>
                        <span class="star unselected" data-value="2">★</span>
                        <span class="star unselected" data-value="3">★</span>
                        <span class="star unselected" data-value="4">★</span>
                        <span class="star unselected" data-value="5">★</span>
                    </div>
                    <input type="hidden" name="rating" id="rating" required>

                    <label for="details">Share your feedback:</label>
                    <textarea name="details" id="details" rows="4" placeholder="Tell us about your experience..." required></textarea>

                    <button type="submit" class="submit-btn">Submit Review</button>
                </form>
            </div>

            <div id="reviewThankYou" style="display: none; text-align: center; padding: 20px; background: #d4edda; border-radius: 15px; margin-top: 15px;">
                <h4 style="color: #155724; margin-bottom: 10px;">Thank you for your feedback!</h4>
                <p style="color: #155724; margin: 0;">We appreciate your input and will use it to improve our service.</p>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <small style="color: #6c757d;">
                Your feedback helps other patients make informed decisions
            </small>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle review form functionality
    window.toggleReviewForm = function() {
        const container = document.getElementById('reviewFormContainer');
        const toggleText = document.getElementById('toggleText');
        const toggleBtn = document.querySelector('.review-btn');

        if (container && toggleText && toggleBtn) {
            if (container.style.display === 'none' || container.style.display === '') {
                container.style.display = 'block';
                toggleText.textContent = 'Hide Review Form';
                toggleBtn.style.background = '#6c757d';
            } else {
                container.style.display = 'none';
                toggleText.textContent = 'Write a Review';
                toggleBtn.style.background = 'linear-gradient(45deg, #851216, #EB1F27)';
            }
        }
    };

    // Star rating functionality - Fixed version
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    let currentRating = 0;

    if (stars.length && ratingInput) {
        stars.forEach(star => {
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
                const starValue = parseInt(star.getAttribute('data-value'));
                if (starValue <= rating) {
                    star.classList.remove('unselected');
                } else {
                    star.classList.add('unselected');
                }
            });
        }
    }

    // Form submission with AJAX
    const reviewForm = document.getElementById('purchaseReviewForm');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate required fields
            if (!ratingInput.value) {
                alert('Please select a rating before submitting your review.');
                return false;
            }

            const textarea = document.getElementById('details');
            if (!textarea.value.trim()) {
                alert('Please write some feedback before submitting your review.');
                textarea.focus();
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
                    document.querySelector('.review-btn').style.display = 'none';
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