<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Prescriptions - Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', serif;
            font-weight: 600;
            background-color: #f8f9fa;
        }
        
        header {
            top: 0;
            background-color: #ffffff;
        }
        
        .logo img{
            float: left;
            height: 100px;
            padding: 40px;
            padding-right: 50px;
            padding-left: 40px;
        }
        
        .top_header {
            display: flex;
            justify-content: flex-end;
            gap: 640px;
            background-image: linear-gradient(to right, #EB1F27 , #851216);
            margin-left: 30px;
            padding: 10px;
            padding-bottom: 10px;
            border-radius: 0 0 0 60px;
            color: #ffffff;
        }
        
        .top_headerchild {
            display: flex;
            flex-direction: row;
            float: right;
            font-size: 1.5rem;
        }
        
        .contact {
            display: flex;
            gap: 40px;
        }
        
        .contact_item {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 20px;
        }
        
        .main_header {
            display: flex;
            justify-content: flex-end;
            margin-right: 30px;
            margin-top: 20px;
        }
        
        .nav {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        
        .main_nav a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .main_nav a:hover {
            color: #EB1F27;
        }
        
        .gradient button {
            background-image: linear-gradient(to right, #EB1F27, #851216);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.3s;
        }
        
        .gradient button:hover {
            transform: scale(1.05);
        }
        
        .hero {
            background-color: #f8f9fa;
            padding: 50px 0;
            text-align: center;
        }
        
        .hero h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        
        .prescriptions-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .prescription-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s;
        }
        
        .prescription-card:hover {
            transform: translateY(-5px);
        }
        
        .prescription-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .prescription-date {
            color: #666;
            font-size: 0.9rem;
        }
        
        .prescription-doctor {
            font-weight: 700;
            color: #333;
        }
        
        .prescription-details {
            margin-bottom: 15px;
        }
        
        .prescription-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        
        .prescription-value {
            color: #333;
            margin-bottom: 15px;
        }
        
        .prescription-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }
        
        .btn-view {
            background-color: #17a2b8;
            color: white;
        }
        
        .btn-view:hover {
            background-color: #138496;
        }
        
        .btn-download {
            background-color: #28a745;
            color: white;
        }
        
        .btn-download:hover {
            background-color: #218838;
        }
        
        .no-prescriptions {
            text-align: center;
            padding: 50px 0;
            color: #666;
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .footer_text {
            display: flex;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 30px;
        }
        
        .footer_text h1 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .footer_text hr {
            width: 50px;
            margin: 10px auto;
            border: 1px solid #EB1F27;
        }
        
        .footer_opt {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }
        
        .footer_opt a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer_opt a:hover {
            color: #EB1F27;
        }
        
        footer img {
            height: 60px;
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

            <div class="navigation">
                <div class="top_header">
                    <div class="top_headerchild">
                        <div class="contact">
                            <div class="contact_item">
                                <img src="{{ asset('icons/email icon.png') }}">
                                <p>cs@telkomedika.co.id</p>
                            </div>
                            <div class="contact_item">
                                <img src="{{ asset('icons/phone icon.png') }}">
                                <p>1500115</p>
                            </div>
                        </div>
                    </div>

                    <div class="profile">
                        <a href="{{ route('patients.profile') }}"><img src="{{ asset('icons/profile.png') }}" alt="Your Profile"></a>
                    </div>
                </div>

                <div class="main_header">
                    <nav>
                        <ul style="list-style-type:none;" class="nav">
                            <li class="main_nav"><a href="{{ route('patients.index') }}#services">Our Services</a></li>
                            <li class="main_nav"><a href="{{ url('doctors') }}">Doctors</a></li>
                            <li class="main_nav"><a href="{{ url('symptoms') }}">Check Symptoms</a></li>
                            <li class="main_nav"><a href="{{ url('medicines') }}">Medicine</a></li>
                            <li class="main_nav"><a href="{{ url('articles') }}">Articles</a></li>
                            <li class="main_nav"><a href="{{ route('patients.prescriptions') }}" style="color: #EB1F27;">My Prescriptions</a></li>
                            <li class="gradient">
                                <a href="{{ url('appointments') }}"><button> Book Appointment > </button></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>   
        </header>
    </div>

    <div class="hero">
        <h1>My Prescriptions</h1>
    </div>

    <div class="prescriptions-container">
        @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
        @endif

        @if(count($prescriptions) > 0)
            @foreach($prescriptions as $prescription)
            <div class="prescription-card">
                <div class="prescription-header">
                    <div class="prescription-doctor">Dr. {{ $prescription->doctor->doctor_name }}</div>
                    <div class="prescription-date">{{ $prescription->issue_date->format('F d, Y') }}</div>
                </div>
                <div class="prescription-details">
                    <div class="prescription-label">Dosage:</div>
                    <div class="prescription-value">{{ $prescription->dosage }}</div>
                    
                    <div class="prescription-label">Instructions:</div>
                    <div class="prescription-value">{{ $prescription->instructions }}</div>
                </div>
                <div class="prescription-actions">
                    <a href="{{ route('patients.prescriptions.view', $prescription->prescription_id) }}" class="btn btn-view">View Details</a>
                    @if($prescription->prescription_file)
                    <a href="{{ route('patients.prescriptions.download', $prescription->prescription_id) }}" class="btn btn-download">Download</a>
                    @endif
                </div>
            </div>
            @endforeach
        @else
            <div class="no-prescriptions">
                <h3>You don't have any prescriptions yet.</h3>
                <p>Your prescriptions will appear here after your doctor visits.</p>
            </div>
        @endif
    </div>

    <footer>
        <img src="{{ asset('icons/logo.png') }}" alt="telkomedika">
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
                    <a href="{{ route('patients.index') }}#services">Services</a>
                    <a href="{{ route('patients.index') }}#about_us">About Us</a>
                    <a href="{{ url('doctors') }}">Our Doctors</a>
                    <a href="{{ route('patients.prescriptions') }}">My Prescriptions</a>
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
</body>
</html>
