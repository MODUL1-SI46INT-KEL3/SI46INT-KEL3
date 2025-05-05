<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Medical Record Management create</title>
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
    
    .form-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .form-group label {
      font-weight: 500;
    }
    
    .btn-primary {
      background-color: #B01116;
      border-color: #B01116;
    }
    
    .btn-primary:hover {
      background-color: #8a0e12;
      border-color: #8a0e12;
    }
    
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
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
      <h2>Medical Record</h2>
    </div>
    
    <div class="form-card">
      <h4 class="mb-4">Create New Medical Record</h4>
      
      <form action="{{ route('medical-records.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Patient Name</label>
              <input type="text" class="form-control" value="{{ $patient->patient_name }}" readonly>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="date_of_consultation">Date of Consultation</label>
              <input type="date" class="form-control @error('date_of_consultation') is-invalid @enderror" id="date_of_consultation" name="date_of_consultation" value="{{ old('date_of_consultation', date('Y-m-d')) }}" required>
              @error('date_of_consultation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="assessment">Assessment</label>
              <input type="text" class="form-control @error('assessment') is-invalid @enderror" id="assessment" name="assessment" value="{{ old('assessment') }}" required>
              @error('assessment')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="diagnosis">Diagnosis</label>
              <input type="text" class="form-control @error('diagnosis') is-invalid @enderror" id="diagnosis" name="diagnosis" value="{{ old('diagnosis') }}" required>
              @error('diagnosis')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="treatment">Treatment</label>
              <input type="text" class="form-control @error('treatment') is-invalid @enderror" id="treatment" name="treatment" value="{{ old('treatment') }}" required>
              @error('treatment')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="file">Upload File (Optional)</label>
          <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">
          @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Create Record</button>
          <a href="{{ route('medical-records.show', $patient->id) }}" class="btn btn-secondary ml-2">Back</a>
        </div>
      </form>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
