<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/patient_profile.css') }}">

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


    <div class="profile-box">

        <div class="patient-info">
            <p><b>Name:</b> {{ $patient->patient_name }}</p>
            <p><b>Date of Birth:</b> {{ $patient->date_of_birth }}</p>
            <p><b>Email:</b> {{ $patient->email }}</p>
            <p><b>Phone:</b> {{ $patient->phone }}</p>
            <p><b>Address:</b> {{ $patient->address }}</p>
        </div>

        <div class="actions">
            <div class="profile-edit">
                <a href="{{ route('patients.edit', $patient->id) }}">
                    <button>Edit Profile</button>
                </a>
            </div>
            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
            </form>
            
            <form action="{{ route('patients.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>

            
        </div>
    </div>

    
</div>
</body>

