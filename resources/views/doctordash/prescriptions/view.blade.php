<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription View</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    
    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      width: 250px;
      padding: 20px 0;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-header {
      padding: 15px 20px;
      background-color: #B01116;
      color: white;
      text-align: center;
      margin-bottom: 20px;
    }
    
    .sidebar-menu {
      list-style: none;
      padding: 0;
    }
    
    .sidebar-menu li {
      margin-bottom: 10px;
    }
    
    .sidebar-menu a {
      display: block;
      padding: 10px 20px;
      color: #333;
      text-decoration: none;
      transition: all 0.3s;
    }
    
    .sidebar-menu a:hover, .sidebar-menu a.active {
      background-color: #f1f1f1;
      color: #B01116;
    }
    
    .content {
      margin-left: 250px;
      padding: 20px;
    }
    
    .page-header {
      background-color: #fff;
      padding: 15px 20px;
      margin-bottom: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .prescription-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    
    .prescription-details {
      margin-bottom: 20px;
    }
    
    .prescription-details h5 {
      font-weight: 600;
      margin-bottom: 15px;
      color: #333;
    }
    
    .prescription-details p {
      margin-bottom: 10px;
    }
    
    .prescription-details .label {
      font-weight: 500;
      color: #555;
    }
    
    .prescription-file {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      text-align: center;
    }
    
    .prescription-file img {
      max-width: 100%;
      height: auto;
      max-height: 400px;
      margin-bottom: 15px;
    }
    
    .prescription-file .upload-icon {
      font-size: 48px;
      color: #6c757d;
      margin-bottom: 15px;
    }
    
    .btn-back {
      background-color: #6c757d;
      color: white;
    }
    
    .logout-btn {
      position: absolute;
      bottom: 20px;
      width: 80%;
      left: 10%;
      padding: 10px;
      background-color: #f8f9fa;
      color: #333;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }
    
    .logout-btn:hover {
      background-color: #e9ecef;
    }

    .sidebar {
            background-color: #f1f1f1;
            font-size: 1rem;
            height: 100vh;
            padding: 10px;
            position: fixed;
            top: 0; 
            left: 1%;
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
            border-radius:5px;  
            margin:5px;
        }

        .sidebar a.active {
            background-color:  #851216;
            color: white;
        }

        .sidebar-link:hover {
            background-color: #555;
            color: #fff;
        }
  </style>
</head>
<body>
<nav class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse" id="sidebarMenu">
                @include('navigation.docbar')
            </nav>
  
  <div class="content">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h2>Prescription</h2>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    
    <div class="prescription-card">
      <div class="prescription-details">
        <h5>Prescription Details</h5>
        <p><span class="label">Patient Name:</span> {{ $prescription->patient->patient_name }}</p>
        <p><span class="label">Date of Issue:</span> {{ $prescription->issue_date->format('Y-m-d') }}</p>
        <p><span class="label">Dosage:</span> {{ $prescription->dosage }}</p>
        <p><span class="label">Instructions:</span> {{ $prescription->instructions }}</p>
        <p><span class="label">Prescribed By:</span> Dr. {{ $prescription->doctor->doctor_name }}</p>
      </div>
    </div>
    
    <div class="prescription-file">
      <h5>Prescription File</h5>
      @if($prescription->prescription_file)
        @php
          $extension = pathinfo(storage_path('app/public/' . $prescription->prescription_file), PATHINFO_EXTENSION);
        @endphp
        
        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
          <img src="{{ asset('storage/' . $prescription->prescription_file) }}" alt="Prescription">
          <div>
            <a href="{{ asset('storage/' . $prescription->prescription_file) }}" target="_blank" class="btn btn-info">View Full Size</a>
          </div>
        @else
          <div class="mb-3">
            <i class="fas fa-file-prescription upload-icon"></i>
            <p>Prescription file is available as a document</p>
          </div>
          <a href="{{ asset('storage/' . $prescription->prescription_file) }}" target="_blank" class="btn btn-info">View Document</a>
        @endif
      @else
        <div class="mb-3">
          <i class="fas fa-upload upload-icon"></i>
          <p>No prescription file uploaded yet</p>
        </div>
        <a href="{{ route('prescriptions.upload', $prescription->prescription_id) }}" class="btn btn-primary">Upload Prescription</a>
      @endif
    </div>
    
    <div class="text-center mt-4">
      <a href="{{ route('prescriptions.index') }}" class="btn btn-back">Back to Prescriptions</a>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
