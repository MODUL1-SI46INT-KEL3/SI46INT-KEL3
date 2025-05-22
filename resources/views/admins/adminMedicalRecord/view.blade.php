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
  
  .patient-info, .record-details, .record-file {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 15px 15px rgba(139, 0, 0, 0.5);
  }
  
  .record-details h5, .patient-info h5, .record-file h5 {
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
  }
  
  .record-details p, .patient-info p {
    margin-bottom: 10px;
  }
  
  .record-details .label, .patient-info .label {
    font-weight: 500;
    color: #555;
  }
  
  .record-file {
    text-align: center;
  }
  
  .record-file img {
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
      <h2>Medical Record Details</h2>
      <div>
        <a href="{{ route('adminMedicalRecord.print', $medicalRecord->record_id) }}" class="btn btn-print" target="_blank">Print Report</a>
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
          <p><span class="label">Name:</span> {{ $medicalRecord->patient->patient_name }}</p>
          <p><span class="label">Date of Birth:</span> {{ is_string($medicalRecord->patient->date_of_birth) ? $medicalRecord->patient->date_of_birth : $medicalRecord->patient->date_of_birth->format('Y-m-d') }}</p>
          <p><span class="label">Gender:</span> {{ $medicalRecord->patient->gender }}</p>
        </div>
        <div class="col-md-6">
          <p><span class="label">Email:</span> {{ $medicalRecord->patient->email }}</p>
          <p><span class="label">Phone:</span> {{ $medicalRecord->patient->phone }}</p>
          <p><span class="label">ID Card:</span> {{ $medicalRecord->patient->id_card }}</p>
        </div>
      </div>
    </div>
    
    <div class="record-details">
      <h5>Medical Record Details</h5>
      <div class="row">
        <div class="col-md-6">
          <p><span class="label">Doctor:</span> Dr. {{ $medicalRecord->doctor->doctor_name }}</p>
          <p><span class="label">Visit Date:</span> {{ $medicalRecord->visit_date->format('Y-m-d') }}</p>
          <p><span class="label">Visit Time:</span> {{ $medicalRecord->visit_time }}</p>
        </div>
        <div class="col-md-6">
          <p><span class="label">Assessment:</span> {{ $medicalRecord->assessment }}</p>
          <p><span class="label">Diagnosis:</span> {{ $medicalRecord->diagnosis }}</p>
          <p><span class="label">Treatment:</span> {{ $medicalRecord->treatment }}</p>
        </div>
      </div>
    </div>
    
    <div class="record-file">
      <h5>Medical Record File</h5>
      @if($medicalRecord->file_path)
        @php
          $extension = pathinfo(storage_path('app/public/' . $medicalRecord->file_path), PATHINFO_EXTENSION);
        @endphp
        
        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
          <img src="{{ asset('storage/' . $medicalRecord->file_path) }}" alt="Medical Record">
          <div>
            <a href="{{ asset('storage/' . $medicalRecord->file_path) }}" target="_blank" class="btn btn-info">View Full Size</a>
            <a href="{{ route('adminMedicalRecord.download', $medicalRecord->record_id) }}" class="btn btn-primary">Download</a>
          </div>
        @else
          <div class="mb-3">
            <i class="fas fa-file-medical upload-icon"></i>
            <p>Medical record file is available as a document</p>
          </div>
          <a href="{{ route('adminMedicalRecord.download', $medicalRecord->record_id) }}" class="btn btn-primary">Download Document</a>
        @endif
      @else
        <div class="mb-3">
          <i class="fas fa-upload upload-icon"></i>
          <p>No medical record file uploaded</p>
        </div>
      @endif
    </div>
    
    <div class="text-center mt-4">
      <a href="{{ route('adminMedicalRecord.index') }}" class="btn btn-back">Back to Medical Records</a>
    </div>
  </div>
</div>
@endsection
