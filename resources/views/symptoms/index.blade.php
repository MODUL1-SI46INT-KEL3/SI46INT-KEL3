<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom Checker - Telkomedika</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', serif;
            font-weight: 500;
        }

        header {
            display: flex;
            background-image: linear-gradient(to right, #EB1F27 , #851216);
            margin-left: 100px;
            padding: 10px;
            padding-bottom: 20px;
            border-radius: 0 0 0 60px;

        }

        .logo {
            background-color: #fff;
            border-radius: 50%;
            height: 90px;
            width: 90px;
            margin-left: 50px;    
        }

        .logo img {
            float: left;
            height: 50px;
            margin-left: 15px;
            margin-right: auto;
            margin-top: 20px;
        }

        .hero {
            background-image: linear-gradient(to right, #EB1F27, #851216);
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 40px;
            margin-top: 40px;
        }
        .btn-primary {
            background-color: #851216;
            border: none;
        }
        .btn-primary:hover {
            background-color: #A31E2A;
        }
        
        footer {
            background-color: #FFE2E3;
            margin: 60px 30px 0 30px;
            border-radius: 40px 40px 0 0;
            padding: 20px;
        }
        .footer-content {
            display: flex;
            gap: 40px;
        }
        .footer-section h3 {
            color: #851216;
            font-size: 1.5rem;
        }

        footer img{
            margin: 40px;
            width: 150px;
            height: 120px;
        }

        .footer_text {
            display: flex;
            gap: 100px;
            margin: 20px;
            margin-left: 50px;
            text-align: left;
            font-weight: 500;
            color
        }

        .footer_text h1 {
            font-size: 1.5rem;
            color: #851216;
        }

        .footer_opt {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        footer a {
            color: #000;
        }

        footer hr {
            width: 300px;
            height: 2px;
            background-color: #000000;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="{{ route('patients.index') }}">
                <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
            </a>
        </div>
    </header>

    <div class="hero">
        <h1>Symptom Checker</h1>
    </div>

    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @isset($recommendedSpecializations)
            <div class="card mb-4">
                <div class="card-body">
                    <h2>Recommended Specializations:</h2>
                    <ul class="list-group list-group-flush">
                        @foreach($recommendedSpecializations as $specialization)
                            <li class="list-group-item">{{ $specialization->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endisset

        <p>Select between 2 and 4 symptoms:</p>

        <div class="card">
    <div class="card-body">
        <form id="symptom-form" action="{{ route('symptoms.recommend') }}" method="POST">
            @csrf
            <div class="row">
                @foreach($symptoms as $symptom)
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   name="symptoms[]" 
                                   value="{{ $symptom->id }}" 
                                   id="symptom-{{ $symptom->id }}"
                                   @if(isset($selectedSymptomIds) && in_array($symptom->id, $selectedSymptomIds)) checked @endif>
                            <label class="form-check-label" for="symptom-{{ $symptom->id }}">
                                {{ $symptom->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
</div>
<div class="text-left mt-3">
    <button type="submit" form="symptom-form" class="btn btn-primary">Get Recommendation</button>
    <a href="{{ url('appointments/create') }}"><button class="btn btn-primary">Book Now!</button></a>
</div>

    </div>

    <footer>
        <img src="icons/logo.png" alt="telkomedika">
        <div class="footer_text">
            <div class="book_footer">
                <h1>Book Now</h1>
                <hr>
                <div class="footer_opt">
                    <a href="{{ url('appointments') }}">Book Appointment</a>
                </div>
            </div>
            <div class="discover_footer">
                <h1>Discover Us</h1>
                <hr>
                <div class="footer_opt">
                    <a href="#services">Services</a>
                    <a href="#about_us">About Us</a>
                    <a href="{{ url('doctors') }}" >Our Doctors</a>
                </div>
            </div>
            <div class="contact_footer">
                <h1>Contact Us</h1>
                <hr>
                <div class="footer_opt">
                  <a href="tel:1500115">1500115</a>
                  <a href="mailto:cs@telkomedika.co.id">cs@telkomedika.co.id</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>