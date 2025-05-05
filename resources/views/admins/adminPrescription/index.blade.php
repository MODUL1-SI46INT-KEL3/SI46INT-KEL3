@extends('admins.index')
@section('content')

<style>
  .container {
    margin-top: 40px;
    padding: 20px;
  }
  
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .table {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 15px 15px rgba(139, 0, 0, 0.5);
    width: 100%;
    border-collapse: collapse;
  }
  
  .table th, .table td {
    text-align: center;
    vertical-align: middle;
    padding: 15px;
    border: 1px solid #ddd;
  }
  
  .table th {
    background-color: #851216;
    color: white;
  }
  
  .btn-view, .btn-print, .btn-success, .btn-primary, .btn-secondary {
    border: none;
    border-radius: 5px;
    color: white;
    padding: 5px 10px;
    cursor: pointer;
    text-decoration: none;
    margin: 2px;
  }
  
  .btn-view {
    background-color: #17a2b8;
  }
  
  .btn-print {
    background-color: #28a745;
  }
  
  .search-box {
    margin-bottom: 20px;
  }
</style>

<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h2>Prescription Management</h2>
      <div>
        <a href="{{ route('adminPrescription.export') }}" class="btn btn-success">Export to PDF</a>
      </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    
    <div class="card">
      <div class="card-body">
        <div class="search-box">
          <form action="{{ route('adminPrescription.index') }}" method="GET" class="form-inline">
            <div class="form-group mr-2">
              <input type="text" name="search" class="form-control" placeholder="Search by patient name" value="{{ $search ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            @if($search ?? false)
              <a href="{{ route('adminPrescription.index') }}" class="btn btn-secondary ml-2">Clear</a>
            @endif
          </form>
        </div>
        
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Date of Issue</th>
                <th>Dosage</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($prescriptions as $index => $prescription)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $prescription->patient->patient_name }}</td>
                <td>{{ $prescription->doctor->doctor_name }}</td>
                <td>{{ $prescription->issue_date->format('Y-m-d') }}</td>
                <td>{{ $prescription->dosage }}</td>
                <td>
                  <a href="{{ route('adminPrescription.view', $prescription->prescription_id) }}" class="btn btn-view btn-sm">View</a>
                  <a href="{{ route('adminPrescription.print', $prescription->prescription_id) }}" class="btn btn-print btn-sm" target="_blank">Print</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">No prescriptions found</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
