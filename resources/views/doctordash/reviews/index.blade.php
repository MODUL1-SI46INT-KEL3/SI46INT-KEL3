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
    
    .table th {
      background-color: #851216;
      color: white;
    }
    
    .btn-view {
      background-color: #17a2b8;
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

<nav class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse" id="sidebarMenu">
    @include('navigation.docbar')
</nav>

<div class="content">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h2 style="max-width: 70%;">
            Customer Reviews
            @if($selectedDoctorId)
                @php
                    $selectedDoctor = $doctors->firstWhere('id', $selectedDoctorId);
                @endphp
                @if($selectedDoctor)
                    – Appointments for Dr. {{ $selectedDoctor->name }}
                @endif
            @else
                – All Appointments
            @endif
        </h2>

        <div class=" d-flex justify-content-end align-items-center" style="display: flex; gap: 5px; flex-direction: column; margin:5px 0">
            <select id="doctorSelect" class="form-control" style="width: 200px;" onchange="filterByDoctor()">
                <option value="">All Doctors</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $selectedDoctorId == $doctor->id ? 'selected' : '' }}>
                        Dr. {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <script>
        function filterByDoctor() {
            const doctorId = document.getElementById('doctorSelect').value;
            const url = new URL(window.location.href);
            if (doctorId) {
                url.searchParams.set('doctor_id', doctorId);
            } else {
                url.searchParams.delete('doctor_id');
            }
            window.location.href = url.toString();
        }
    </script>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 20%;">Patient Name</th>
                        <th style="width: 10%;">Rating</th>
                        <th style="width: 15%;">Submitted At</th>
                        <th style="width: 50%;">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->patient_name }}</td>
                            <td>{{ $review->rating }} / 5</td>
                            <td>{{ \Carbon\Carbon::parse($review->submitted_at)->format('d M Y') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($review->details, 80) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No reviews available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
