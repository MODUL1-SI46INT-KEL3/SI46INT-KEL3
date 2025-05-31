<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Medical Record Management</title>
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
    
    .patient-info {
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .table th {
      background-color: #B01116;
      color: white;
    }
    
    .btn-primary {
      background-color: #B01116;
      border-color: #B01116;
    }
    
    .btn-primary:hover {
      background-color: #8a0e12;
      border-color: #8a0e12;
    }
    
    .btn-edit {
      background-color: #ffc107;
      color: #212529;
    }
    
    .btn-delete {
      background-color: #dc3545;
      color: white;
    }

    .btn-print {
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
      <h2>Medical Record</h2>
      <div>
        <a href="{{ route('medical-records.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary mr-2">Add New Record</a>
        <a href="{{ route('prescriptions.create', ['patient_id' => $patient->id]) }}" class="btn btn-success">Add Prescription</a>
      </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    
    <div class="patient-info">
      <h4>Patient Personal Detail</h4>
      <div class="row mt-3">
        <div class="col-md-6">
          <p><strong>Name:</strong> {{ $patient->patient_name }}</p>
          <p><strong>Date of Birth:</strong> {{ is_string($patient->date_of_birth) ? $patient->date_of_birth : $patient->date_of_birth->format('Y-m-d') }}</p>
          <p><strong>Gender:</strong> {{ $patient->gender }}</p>
        </div>
        <div class="col-md-6">
          <p><strong>Email:</strong> {{ $patient->email }}</p>
          <p><strong>Phone:</strong> {{ $patient->phone }}</p>
          <p><strong>ID Card:</strong> {{ $patient->id_card }}</p>
        </div>
      </div>
    </div>
    
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Doctor</th>
                <th>Date of Consultation</th>
                <th>Email</th>
                <th>Specialist</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($medicalRecords as $index => $record)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->doctor->name }}</td>
                <td>{{ $record->visit_date->format('Y-m-d') }}</td>
                <td>{{ $record->doctor->email }}</td>
                <td>{{ $record->doctor->specialization ? $record->doctor->specialization->name : 'N/A' }}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('medical-records.edit', $record->record_id) }}" class="btn btn-edit btn-sm">Edit</a>
                    <a href="{{ route('medical-records.print', $record->record_id) }}" class="btn btn-print btn-sm" target="_blank">Print</a>
                    <form action="{{ route('medical-records.destroy', $record->record_id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">No medical records found</td>
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
