<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
</head>
<body>
<div class="container mt-4">
    <div id="header">
        <header>
            <div class="logo">
                <a href="{{ route('patients.index') }}">
                    <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
                </a>
            </div>
        </header>
    </div>

    <div class="hero">
        <h1>{{ $nav }}</h1>
    </div>

    <div class="edit-form'">
        <div class="profile-box">
            <div class="edit-form">
            <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="patient-edit-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="patient_name" class="form-label">Patient Name</label>
                    <input type="text" class="form-control @error('patient_name') is-invalid @enderror" id="patient_name"
                        name="patient_name" placeholder="Enter Patient Name" 
                        value="{{ old('patient_name', $patient->patient_name) }}" required>
                    @error('patient_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth"
                        name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}" required>
                    @error('date_of_birth')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Enter Email" 
                        value="{{ old('email', $patient->email) }}" required>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" placeholder="Enter Phone Number" 
                        value="{{ old('phone', $patient->phone) }}" required>
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" placeholder="Enter Address" 
                        value="{{ old('address', $patient->address) }}" required>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="update-edit">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>

            <div class="actions">
                <a href="{{ route('patients.profile') }}" class="btn btn-secondary">
                    <button>Cancel</button>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
