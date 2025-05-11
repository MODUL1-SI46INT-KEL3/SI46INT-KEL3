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
            background: linear-gradient(to right, #EB1F27, #851216);
            padding: 16px 0 10px 0;
            border-radius: 0 0 0 40px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
        }
        .header-logo {
            background: #fff;
            border-radius: 50%;
            height: 70px;
            width: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 60px;
        }
        .header-logo img {
            height: 38px;
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
            margin: 0 0 10px 0;
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
        .star {
            cursor: pointer;
            color: #FFD700;
            font-size: 2rem;
            transition: color 0.2s;
            margin-right: 3px;
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
        }
        .review-btn .highlight {
            background: #FFD700;
            color: #851216;
            font-weight: 700;
        }
        .form-select, .form-control {
            border-radius: 8px;
        }
        @media (max-width: 800px) {
            .header-logo { margin-left: 20px;}
            .form-image {
            height: auto;       /* Maintain aspect ratio */
            object-fit: contain; /* Scale image to fit container without cropping */
            }
}
            .form-image {
                max-width: 90%;
                max-height: 450px;
                height: auto;
                object-fit: contain;
                display: flex;
                justify-content: center;
                align-items: flex-start;
                margin-bottom: 24px;
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
        <div class="header-bar-title">
            Telkomedika
        </div>
    </div>

    <div class="container" style="max-width: 1050px;">
    <div class="row d-flex align-items-stretch">
    <div class="main-title mb-4">
    Feedback and Review
</div>
        </div>
        <div class="row">
            <!-- Left: Review Card -->
            <div class="col-md-7">
                <div class="card card-custom p-4 mb-4">
                    <div class="mb-3" style="font-weight:600;">Review us!</div>
                    <label for="reviewSelector" style="font-weight:400;">What would you like to review?</label>
                    <select id="reviewSelector" class="form-select mb-3" style="margin-top:2px;">
                        <option value="">&#128253; TelkomMedika Website</option>
                        <option value="#">Appointment Experience</option>
                        <option value="#">Medicine Purchase</option>
                    </select>
                                        <label class="form-label fw-bold mt-2" style="font-size:1.1rem;">
                        Give us your feedback!
                    </label>

                    <div id="star-rating" class="mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}">&#9733;</span>
                        @endfor
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 600px; margin: 20px auto;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                   @endif
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category" value="web">
                        <input type="hidden" name="rating" id="rating" required>
                        <textarea name="details" class="form-control mb-2" rows="5" placeholder="Nice Web..."></textarea>
                        <input type="hidden" name="submitted_at" value="{{ now() }}">
                        <button type="submit" class="review-btn">
                            Submit Feedback or Review
                        </button>

                        </button>
                    </form>
                </div>
            </div>
            <!-- Right: Image -->
            <div class="col-md-5 d-flex align-items-center justify-content-center form-image-container">
    <img src="{{ asset('images/review.png') }}" alt="Doctor holding hands" class="img-fluid rounded shadow form-image">
</div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
        // Dropdown redirection (if you want to use real routes)
        document.getElementById('reviewSelector').addEventListener('change', function () {
            if (this.value && this.value !== "#") window.location.href = this.value;
        });
    </script>
</body>
</html>
