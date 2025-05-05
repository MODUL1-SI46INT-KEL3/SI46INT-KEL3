<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Details - Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
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
        
        .prescription-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .prescription-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            padding: 30px;
        }
        
        .prescription-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }
        
        .prescription-title {
            font-size: 1.8rem;
            color: #333;
            font-weight: 700;
        }
        
        .prescription-date {
            color: #666;
            font-size: 1rem;
            font-weight: 500;
        }
        
        .prescription-section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 1.2rem;
            color: #EB1F27;
            margin-bottom: 15px;
            font-weight: 600;
            border-left: 4px solid #EB1F27;
            padding-left: 10px;
        }
        
        .doctor-info, .medication-info {
            display: flex;
            flex-wrap: wrap;
        }
        
        .info-item {
            flex: 1;
            min-width: 250px;
            margin-bottom: 15px;
        }
        
        .info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #333;
        }
        
        .prescription-file {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            border: 1px dashed #ddd;
            border-radius: 8px;
        }
        
        .prescription-file img {
            max-width: 100%;
            max-height: 400px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .file-icon {
            font-size: 60px;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .prescription-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
            transform: translateX(-5px);
        }
        
        .btn-download {
            background-image: linear-gradient(to right, #EB1F27, #851216);
            color: white;
        }
        
        .btn-download:hover {
            transform: scale(1.05);
        }
        
        .btn-print {
            background-color: #28a745;
            color: white;
        }
        
        .btn-print:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 40px 0;
            text-align: center;
            margin-top: 50px;
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
        
        @media print {
            header, footer, .prescription-actions, .no-print {
                display: none;
            }
            
            body {
                background-color: white;
            }
            
            .prescription-container {
                width: 100%;
                padding: 0;
                margin: 0;
            }
            
            .prescription-card {
                box-shadow: none;
                border: none;
            }
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
        <h1>Prescription Details</h1>
    </div>

    <div class="prescription-container">
        <div class="prescription-card">
            <div class="prescription-header">
                <div class="prescription-title">Prescription #{{ $prescription->prescription_id }}</div>
                <div class="prescription-date">{{ $prescription->issue_date->format('F d, Y') }}</div>
            </div>
            
            <div class="prescription-section">
                <div class="section-title">Doctor Information</div>
                <div class="doctor-info">
                    <div class="info-item">
                        <div class="info-label">Doctor Name:</div>
                        <div class="info-value">Dr. {{ $prescription->doctor->doctor_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Specialization:</div>
                        <div class="info-value">{{ $prescription->doctor->specialization ? $prescription->doctor->specialization->name : 'General Practitioner' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email:</div>
                        <div class="info-value">{{ $prescription->doctor->email }}</div>
                    </div>
                </div>
            </div>
            
            <div class="prescription-section">
                <div class="section-title">Medication Details</div>
                <div class="medication-info">
                    <div class="info-item">
                        <div class="info-label">Dosage:</div>
                        <div class="info-value">{{ $prescription->dosage }}</div>
                    </div>
                    <div class="info-item" style="flex: 2;">
                        <div class="info-label">Instructions:</div>
                        <div class="info-value">{{ $prescription->instructions }}</div>
                    </div>
                </div>
            </div>
            
            @if($prescription->prescription_file)
            <div class="prescription-section">
                <div class="section-title">Prescription File</div>
                <div class="prescription-file">
                    @php
                        $extension = pathinfo(storage_path('app/public/' . $prescription->prescription_file), PATHINFO_EXTENSION);
                    @endphp
                    
                    @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                        <img src="{{ asset('storage/' . $prescription->prescription_file) }}" alt="Prescription">
                    @else
                        <div class="file-icon">
                            <i class="fas fa-file-prescription"></i>
                        </div>
                        <p>Prescription file is available as a document</p>
                    @endif
                </div>
            </div>
            @endif
            
            <div class="prescription-actions">
                <a href="{{ route('patients.prescriptions') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Prescriptions
                </a>
                <div>
                    @if($prescription->prescription_file)
                    <a href="{{ route('patients.prescriptions.download', $prescription->prescription_id) }}" class="btn btn-download">
                        <i class="fas fa-download"></i> Download
                    </a>
                    @endif
                    <a href="javascript:window.print()" class="btn btn-print no-print">
                        <i class="fas fa-print"></i> Print
                    </a>
                </div>
            </div>
        </div>
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
