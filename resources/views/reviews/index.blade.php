<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback and Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS and Google Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
        }
        .header-bar {
            display: flex;
            background-image: linear-gradient(to right, #EB1F27 , #851216);
            margin-left: 100px;
            padding: 10px;
            padding-bottom: 20px;
            border-radius: 0 0 0 60px;
        }
        .header-logo {
            background-color: #fff;
            border-radius: 50%;
            height: 90px;
            width: 90px;
            margin-left: 50px;  
        }
        .header-logo img {
            float: left;
            height: 50px;
            margin-left: 15px;
            margin-right: auto;
            margin-top: 20px;
        }
        .header-bar-title {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 600;
            margin-left: 18px;
        }
        .main-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 40px 0 10px 28px;
            margin-right: 20px;
        }
        .card-custom {
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            background: #fff;
            border: none;
        }
        .card-custom label, .card-custom select, .card-custom textarea {
            font-size: 1rem;
        }

         #reviewSelector, #doctorSelector {
            padding: 12px 16px !important;
            font-size: 1.1rem !important;
            height: auto !important;
            min-height: 50px !important;
            border: 2px solid #e0e0e0 !important;
            border-radius: 10px !important;
            background-color: #fff !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08) !important;
            transition: all 0.3s ease !important;
        }

        #reviewSelector:focus, #doctorSelector:focus {
            border-color: #851216 !important;
            box-shadow: 0 3px 10px rgba(133,18,22,0.15) !important;
            outline: none !important;
        }

        #reviewSelector option, #doctorSelector option {
            padding: 12px !important;
            font-size: 1.05rem !important;
            line-height: 1.4 !important;
        }

        #doctorDropdownContainer {
            display: none;
            margin-top: 15px;
        }

        #star-rating {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 1rem;
        }

        .star {
            cursor: pointer;
            color: #FFD700;
            font-size: 3rem;
            transition: color 0.2s;
        }
        .star.unselected {
            color: #ccc;
        }
        .review-btn {
            background: #851216;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            padding: 10px 0;
            width: 100%;
            margin-top: 10px;
            font-size: 1rem;
            letter-spacing: .5px;
            transition: background-color 0.3s;
        }
        .review-btn:hover {
            background: #6d0e10;
        }
        .form-select, .form-control {
            border-radius: 8px;
        }
        .category-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #851216;
        }
        .category-info h5 {
            color: #851216;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .category-info p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
        @media (max-width: 800px) {
            .header-logo { margin-left: 20px;}
            .form-image {
            height: auto;
            object-fit: contain;
            }
        }
        .form-image {
            max-width: 240%;
            max-height: 640px;
            height: auto;
            object-fit: contain;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-bottom: 24px;
            margin-left: 150px;
        }
        .alert {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header-bar">
        <div class="header-logo">
            <a href="{{ route('patients.index') }}">
                <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
            </a>
        </div>
    </div>

    <div class="container" style="max-width: 1050px;">
        <div class="row d-flex align-items-stretch">
            <div class="main-title mb-4">
                Feedback and Review
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 600px; text-align: center; margin: 20px auto;">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Left: Review Card -->
            <div class="col-md-7">
                <div class="card card-custom p-4 mb-4">
                    <div class="mb-3" style="font-weight:600;">Review us!</div>

                    <label for="reviewSelector" style="font-weight:400;">What would you like to review?</label>
                    <select id="reviewSelector" class="form-select mb-3" style="margin-top:2px;" onchange="toggleDoctorDropdown()">
                        <option value="web" {{ ($category ?? 'web') == 'web' ? 'selected' : '' }}>🌐 TelkomMedika Website</option>
                        <option value="appointment" {{ ($category ?? '') == 'appointment' ? 'selected' : '' }}>📅 Appointment Experience</option>
                        <option value="shop" {{ ($category ?? '') == 'shop' ? 'selected' : '' }}>💊 Medicine Purchase</option>
                    </select>

                    <!-- Doctor Dropdown Container -->
                    <div id="doctorDropdownContainer" style="display: {{ ($category ?? '') === 'appointment' ? 'flex' : 'none' }}; flex-direction: column; margin-bottom: 20px; widthL 100%;">
                        <label for="doctorSelector" style="font-weight:400;">Which doctor would you like to review?</label>
                        <select id="doctorSelector" class="form-select" style="margin-top:2px; width: 100%;">
                            <option value="">Select a doctor...</option>
                            @if(isset($doctors))
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>


                    <!-- Dynamic Category Info -->
                    <div id="categoryInfo" class="category-info">
                        <h5 id="categoryTitle">Website Experience</h5>
                        <p id="categoryDescription">Share your thoughts about our website's usability, design, and overall experience.</p>
                    </div>

                    <label class="form-label fw-bold mt-2" style="font-size:1.1rem;">
                        Give us your feedback!
                    </label>

                    <div id="star-rating" class="mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}">&#9733;</span>
                        @endfor
                    </div>

                    <form action="{{ route('reviews.store') }}" method="POST" id="reviewForm">
                        @csrf
                        <input type="hidden" name="category" id="categoryInput" value="{{ $category ?? 'web' }}">
                        <input type="hidden" name="doctor_id" id="doctorInput" value="">
                        <input type="hidden" name="rating" id="rating" required>
                        <input type="hidden" name="submitted_at" value="{{ now() }}">
                        
                        <textarea 
                            name="details" 
                            class="form-control mb-2" 
                            rows="5" 
                            id="reviewTextarea"
                            placeholder="Share your experience with us..."
                            required
                        ></textarea>
                        
                        <button type="submit" class="review-btn" id="submitBtn">
                            Submit Website Review
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Right: Image -->
            <div class="col-md-5 d-flex align-items-center justify-content-center form-image-container">
                <img src="{{ asset('images/review.png') }}" alt="Doctor holding hands" class="img-fluid rounded shadow form-image">
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Category information
        const categoryInfo = {
            'web': {
                title: 'Website Experience',
                description: 'Share your thoughts about our website\'s usability, design, and overall experience.',
                placeholder: 'How was your experience using our website? Any suggestions for improvement?',
                buttonText: 'Submit Website Review'
            },
            'appointment': {
                title: 'Appointment Experience',
                description: 'Tell us about your appointment booking process and experience with the doctor.',
                placeholder: 'How was your appointment experience? Was the doctor helpful?',
                buttonText: 'Submit Appointment Review'
            },
            'shop': {
                title: 'Medicine Purchase Experience',
                description: 'Share your experience with our medicine ordering and delivery service.',
                placeholder: 'How was your medicine purchase experience? Quality, delivery, customer service?',
                buttonText: 'Submit Purchase Review'
            }
        };

        // Star rating logic
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
        
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                ratingInput.value = value;
                stars.forEach((s, idx) => {
                    if (idx < value) {
                        s.classList.remove('unselected');
                    } else {
                        s.classList.add('unselected');
                    }
                });
            });
        });
        
        // Set default selected stars
        stars.forEach(s => s.classList.add('unselected'));

        // Dropdown change logic
        document.getElementById('reviewSelector').addEventListener('change', function () {
            const selectedCategory = this.value;
            const categoryData = categoryInfo[selectedCategory];
            const doctorContainer = document.getElementById('doctorDropdownContainer');
            
            // Update category input
            document.getElementById('categoryInput').value = selectedCategory;
            
            // Show/hide doctor dropdown
            if (selectedCategory === 'appointment') {
                doctorContainer.style.display = 'block';
            } else {
                doctorContainer.style.display = 'none';
                document.getElementById('doctorInput').value = '';
                document.getElementById('doctorSelector').value = '';
            }
            
            // Update category info display
            document.getElementById('categoryTitle').textContent = categoryData.title;
            document.getElementById('categoryDescription').textContent = categoryData.description;
            
            // Update form elements
            document.getElementById('reviewTextarea').placeholder = categoryData.placeholder;
            document.getElementById('submitBtn').textContent = categoryData.buttonText;
            
            // Reset form rating
            ratingInput.value = '';
            stars.forEach(s => s.classList.add('unselected'));
        });

        // Doctor selection logic
        document.getElementById('doctorSelector').addEventListener('change', function () {
            document.getElementById('doctorInput').value = this.value;
        });

        // Initialize with current category
        document.addEventListener('DOMContentLoaded', function() {
            const currentCategory = document.getElementById('categoryInput').value;
            const categoryData = categoryInfo[currentCategory];
            
            if (categoryData) {
                document.getElementById('categoryTitle').textContent = categoryData.title;
                document.getElementById('categoryDescription').textContent = categoryData.description;
                document.getElementById('reviewTextarea').placeholder = categoryData.placeholder;
                document.getElementById('submitBtn').textContent = categoryData.buttonText;
            }

            // Show doctor dropdown if appointment is selected
            if (currentCategory === 'appointment') {
                document.getElementById('doctorDropdownContainer').style.display = 'block';
            }
        });

        // Form submission with validation
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            if (!ratingInput.value) {
                e.preventDefault();
                alert('Please select a rating before submitting your review.');
                return false;
            }
            
            const textarea = document.getElementById('reviewTextarea');
            if (!textarea.value.trim()) {
                e.preventDefault();
                alert('Please write some feedback before submitting your review.');
                textarea.focus();
                return false;
            }

            // Validate doctor selection for appointment reviews
            const category = document.getElementById('categoryInput').value;
            const doctorId = document.getElementById('doctorInput').value;
            
            if (category === 'appointment' && !doctorId) {
                e.preventDefault();
                alert('Please select a doctor for your appointment review.');
                document.getElementById('doctorSelector').focus();
                return false;
            }


            

        });

        function toggleDoctorDropdown() {
                const selectedCategory = document.getElementById('reviewSelector').value;
                const doctorDropdown = document.getElementById('doctorDropdownContainer');

                if (selectedCategory === 'appointment') {
                    doctorDropdown.style.display = 'flex';
                } else {
                    doctorDropdown.style.display = 'none';
                }
            }

            // Trigger on page load too
            document.addEventListener('DOMContentLoaded', toggleDoctorDropdown);

    </script>
</body>
</html>