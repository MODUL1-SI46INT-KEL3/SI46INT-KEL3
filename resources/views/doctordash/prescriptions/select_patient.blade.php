<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Patient for Prescription</title>
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
    
    .table th {
      background-color: #B01116;
      color: white;
    }
    
    .btn-select {
      background-color: #28a745;
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
      <h2>Select Patient for Prescription</h2>
    </div>
    
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Patient Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>ID Card</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($patients as $index => $patient)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $patient->patient_name }}</td>
                <td>{{ $patient->date_of_birth->format('Y-m-d') }}</td>
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->phone }}</td>
                <td>{{ $patient->id_card }}</td>
                <td>
                  <a href="{{ route('prescriptions.create', ['patient_id' => $patient->id]) }}" class="btn btn-select btn-sm">Select</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center">No patients found</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
