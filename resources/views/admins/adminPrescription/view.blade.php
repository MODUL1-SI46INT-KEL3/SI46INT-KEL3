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
  
  .patient-info, .prescription-details, .prescription-file {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 15px 15px rgba(139, 0, 0, 0.5);
  }
  
  .prescription-details h5, .patient-info h5, .prescription-file h5 {
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
  }
  
  .prescription-details p, .patient-info p {
    margin-bottom: 10px;
  }
  
  .prescription-details .label, .patient-info .label {
    font-weight: 500;
    color: #555;
  }
  
  .prescription-file {
    text-align: center;
  }
  
  .prescription-file img {
    max-width: 100%;
    height: auto;
    max-height: 400px;
    margin-bottom: 15px;
  }
  
  .btn-back, .btn-print, .btn-primary, .btn-info, .btn-secondary {
    border: none;
    border-radius: 5px;
    color: white;
    padding: 5px 10px;
    cursor: pointer;
    text-decoration: none;
    margin: 2px;
  }
  
  .btn-back {
    background-color: #6c757d;
  }
  
  .btn-print {
    background-color: #28a745;
  }
</style>

<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h2>Prescription Details</h2>
      <div>
        <a href="{{ route('adminPrescription.print', $prescription->prescription_id) }}" class="btn btn-print" target="_blank">Print Prescription</a>
      </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    
    <div class="patient-info">
      <h5>Patient Information</h5>
      <div class="row">
        <div class="col-md-6">
          <p><span class="label">Name:</span> {{ $prescription->patient->patient_name }}</p>
          <p><span class="label">Date of Birth:</span> {{ is_string($prescription->patient->date_of_birth) ? $prescription->patient->date_of_birth : $prescription->patient->date_of_birth->format('Y-m-d') }}</p>
          <p><span class="label">Gender:</span> {{ $prescription->patient->gender }}</p>
        </div>
        <div class="col-md-6">
          <p><span class="label">Email:</span> {{ $prescription->patient->email }}</p>
          <p><span class="label">Phone:</span> {{ $prescription->patient->phone }}</p>
          <p><span class="label">ID Card:</span> {{ $prescription->patient->id_card }}</p>
        </div>
      </div>
    </div>
    
    <div class="prescription-details">
      <h5>Prescription Details</h5>
      <div class="row">
        <div class="col-md-6">
          <p><span class="label">Doctor:</span> Dr. {{ $prescription->doctor->doctor_name }}</p>
          <p><span class="label">Date of Issue:</span> {{ $prescription->issue_date->format('Y-m-d') }}</p>
        </div>
        <div class="col-md-6">
          <p><span class="label">Dosage:</span> {{ $prescription->dosage }}</p>
          <p><span class="label">Instructions:</span> {{ $prescription->instructions }}</p>
        </div>
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
            <a href="{{ route('adminPrescription.download', $prescription->prescription_id) }}" class="btn btn-primary">Download</a>
          </div>
        @else
          <div class="mb-3">
            <i class="fas fa-file-prescription upload-icon"></i>
            <p>Prescription file is available as a document</p>
          </div>
          <a href="{{ route('adminPrescription.download', $prescription->prescription_id) }}" class="btn btn-primary">Download Document</a>
        @endif
      @else
        <div class="mb-3">
          <i class="fas fa-upload upload-icon"></i>
          <p>No prescription file uploaded</p>
        </div>
      @endif
    </div>
    
    <div class="text-center mt-4">
      <a href="{{ route('adminPrescription.index') }}" class="btn btn-back">Back to Prescriptions</a>
    </div>
  </div>
</div>
@endsection
