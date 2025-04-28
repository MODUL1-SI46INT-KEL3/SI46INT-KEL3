<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription Upload</title>
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
    
    .upload-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .upload-area {
      border: 2px dashed #ddd;
      border-radius: 5px;
      padding: 30px;
      text-align: center;
      margin-bottom: 20px;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .upload-area:hover {
      border-color: #aaa;
    }
    
    .upload-icon {
      font-size: 48px;
      color: #6c757d;
      margin-bottom: 15px;
    }
    
    .upload-text {
      color: #6c757d;
      margin-bottom: 5px;
    }
    
    .upload-subtext {
      color: #999;
      font-size: 14px;
    }
    
    .btn-primary {
      background-color: #28a745;
      border-color: #28a745;
    }
    
    .btn-primary:hover {
      background-color: #218838;
      border-color: #1e7e34;
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
    
    #file-selected {
      margin-top: 10px;
      font-weight: 500;
      color: #28a745;
      display: none;
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
    
    <div class="upload-card">
      <h4 class="mb-4">Upload Prescription</h4>
      
      <form action="{{ route('prescriptions.upload.store', $prescription->prescription_id) }}" method="POST" enctype="multipart/form-data" id="upload-form">
        @csrf
        
        <div class="upload-area" id="upload-area" onclick="document.getElementById('prescription_file').click();">
          <i class="fas fa-upload upload-icon"></i>
          <h5 class="upload-text">Upload Prescription</h5>
          <p class="upload-subtext">Click to browse or drag and drop</p>
          <p class="upload-subtext">PDF, JPG, JPEG, PNG (Max. 2MB)</p>
          <p id="file-selected"></p>
        </div>
        
        <input type="file" name="prescription_file" id="prescription_file" class="d-none" accept=".pdf,.jpg,.jpeg,.png">
        @error('prescription_file')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary">Save Prescription</button>
          <a href="{{ route('prescriptions.view', $prescription->prescription_id) }}" class="btn btn-secondary ml-2">Back</a>
        </div>
      </form>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script>
    document.getElementById('prescription_file').addEventListener('change', function() {
      const fileSelected = document.getElementById('file-selected');
      if (this.files.length > 0) {
        fileSelected.textContent = 'File selected: ' + this.files[0].name;
        fileSelected.style.display = 'block';
        document.getElementById('upload-area').style.borderColor = '#28a745';
      } else {
        fileSelected.style.display = 'none';
        document.getElementById('upload-area').style.borderColor = '#ddd';
      }
    });
  </script>
</body>
</html>
