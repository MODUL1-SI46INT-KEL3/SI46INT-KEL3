<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Medical Record</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      padding: 20px;
      background-color: #fff;
    }
    
    .header {
      text-align: center;
      margin-bottom: 30px;
      border-bottom: 2px solid #B01116;
      padding-bottom: 10px;
    }
    
    .header h1 {
      color: #B01116;
      font-weight: 700;
    }
    
    .header p {
      color: #555;
      font-size: 16px;
    }
    
    .section {
      margin-bottom: 20px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    
    .section h4 {
      color: #333;
      font-weight: 600;
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
      padding-bottom: 5px;
    }
    
    .info-row {
      margin-bottom: 10px;
    }
    
    .label {
      font-weight: 600;
      color: #555;
    }
    
    .footer {
      margin-top: 50px;
      text-align: center;
      font-size: 14px;
      color: #777;
    }
    
    .signature-section {
      margin-top: 50px;
    }
    
    .signature-box {
      border-top: 1px solid #000;
      width: 200px;
      text-align: center;
      padding-top: 5px;
      margin: 50px auto 0;
    }
    
    @media print {
      body {
        padding: 0;
        margin: 0;
      }
      
      .print-btn {
        display: none;
      }
      
      @page {
        size: A4;
        margin: 1cm;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>TELKOMEDIKA</h1>
      <p>Medical Record Report</p>
    </div>
    
    <div class="section">
      <h4>Patient Information</h4>
      <div class="row">
        <div class="col-md-6">
          <div class="info-row">
            <span class="label">Name:</span> {{ $medicalRecord->patient->patient_name }}
          </div>
          <div class="info-row">
            <span class="label">Date of Birth:</span> {{ is_string($medicalRecord->patient->date_of_birth) ? $medicalRecord->patient->date_of_birth : $medicalRecord->patient->date_of_birth->format('Y-m-d') }}
          </div>
          <div class="info-row">
            <span class="label">Gender:</span> {{ $medicalRecord->patient->gender }}
          </div>
        </div>
        <div class="col-md-6">
          <div class="info-row">
            <span class="label">Email:</span> {{ $medicalRecord->patient->email }}
          </div>
          <div class="info-row">
            <span class="label">Phone:</span> {{ $medicalRecord->patient->phone }}
          </div>
          <div class="info-row">
            <span class="label">ID Card:</span> {{ $medicalRecord->patient->id_card }}
          </div>
        </div>
      </div>
    </div>
    
    <div class="section">
      <h4>Medical Record Details</h4>
      <div class="row">
        <div class="col-md-6">
          <div class="info-row">
            <span class="label">Doctor:</span> {{ $medicalRecord->doctor->name }}
          </div>
          <div class="info-row">
            <span class="label">Specialization:</span> {{ $medicalRecord->doctor->specialization ? $medicalRecord->doctor->specialization->name : 'N/A' }}
          </div>
          <div class="info-row">
            <span class="label">Visit Date:</span> {{ $medicalRecord->visit_date->format('Y-m-d') }}
          </div>
          <div class="info-row">
            <span class="label">Visit Time:</span> {{ $medicalRecord->visit_time }}
          </div>
        </div>
        <div class="col-md-6">
          <div class="info-row">
            <span class="label">Assessment:</span> {{ $medicalRecord->assessment }}
          </div>
          <div class="info-row">
            <span class="label">Diagnosis:</span> {{ $medicalRecord->diagnosis }}
          </div>
          <div class="info-row">
            <span class="label">Treatment:</span> {{ $medicalRecord->treatment }}
          </div>
        </div>
      </div>
    </div>
    
    <div class="signature-section row">
      <div class="col-md-6 offset-md-6">
        <p>Date: {{ now()->format('Y-m-d') }}</p>
        <div class="signature-box">
          <p>Dr. {{ $medicalRecord->doctor->name }}</p>
        </div>
      </div>
    </div>
    
    <div class="footer">
      <p>This is an official medical record from TELKOMEDIKA. For any inquiries, please contact our office.</p>
    </div>
    
    <div class="text-center mt-4 print-btn">
      <button onclick="window.print()" class="btn btn-primary">Print</button>
      <button onclick="window.close()" class="btn btn-secondary ml-2">Close</button>
    </div>
  </div>
  
  <script>
    window.onload = function() {
      // Auto print when the page loads
      setTimeout(function() {
        window.print();
      }, 500);
    };
  </script>
</body>
</html>
