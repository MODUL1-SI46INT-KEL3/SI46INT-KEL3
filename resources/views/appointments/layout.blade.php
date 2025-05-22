<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkomedika</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/appointment.css') }}">
    <style>
        /* ...your CSS from previous code, unchanged... */
        .review-section-right {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #e9ecef;
            width: 100%;
            max-width: 460px;
        }
        .review-section-right h3 {
            color: #851216;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 12px;
            text-align: center;
        }
        .review-section-right p {
            text-align: center;
            color: #6c757d;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        .review-section-right .toggle-btn {
            background: #851216;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        .review-section-right .toggle-btn:hover {
            background: #EB1F27;
            transform: translateY(-1px);
        }
        .review-section-right .review-form {
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
            background: #fff;
            border: none;
            padding: 20px;
            margin-top: 15px;
        }
        .review-section-right .star-rating {
            display: flex;
            gap: 3px;
            margin-bottom: 12px;
            justify-content: center;
        }
        .review-section-right .star {
            cursor: pointer;
            color: #ccc;
            font-size:  48px;
            transition: all 0.2s ease;
            user-select: none;
        }
        .review-section-right .star:hover {
            transform: scale(1.1);
        }
        .review-section-right .star.active {
            color: #FFD700;
        }
        .review-section-right .form-control {
            width: 100%;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px;
            resize: vertical;
            font-size: 0.9rem;
            margin-bottom: 12px;
            transition: border-color 0.3s ease;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
        .review-section-right .form-control:focus {
            outline: none;
            border-color: #851216;
            box-shadow: 0 0 0 3px rgba(133, 18, 22, 0.1);
        }
        .review-section-right .submit-btn {
            background: #851216;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            padding: 10px 0;
            width: 100%;
            margin-top: 8px;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .review-section-right .submit-btn:hover {
            background: #EB1F27;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div id="header">
        <header>
            <div class="logo">
                <a href="{{ route('patients.index') }}">
                    <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
                </a>
            </div>
        </header>
    </div>
    <div class="appoint_box">
        <h1>Book Appointment</h1>
        <div class="appoint_box_child">
            <div class="box_main">
                <div class="progress_bar">
                    <div class="text">
                        <p class="p1">Specialist</p>
                        <p class="p2">Time</p>
                        <p class="p3">Details</p>
                        <p class="p4">Finish</p>
                    </div>
                    <div class="progress_line">
                        <span class="dot dot-1"></span>
                        <div class="line"><hr class="line1"></div>
                        <span class="dot dot-2"></span>
                        <div class="line"><hr class="line2"></div>
                        <span class="dot dot-3"></span>
                        <div class="line"><hr class="line3"></div>
                        <span class="dot dot-4"></span>
                        <div class="line"><hr class="line4"></div>
                    </div>
                </div>
                <main>
                    @yield('content')
                </main>
            </div>
            <div class="image">
                <a href="{{ route('patients.index') }}">
                    <img src="{{ asset('images/review.png') }}" alt="Telkomedika">
                </a>
                @yield('review-section')
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>