@extends('admins.index')
@section('content')
<style>
    .form-container {
        margin-top: 40px;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 15px 15px rgba(139, 0, 0, 0.5);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        width: 120px;
        height: 40px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
        color: white;
        width: 120px;
        height: 40px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .photo-preview {
        max-width: 150px;
        margin-top: 10px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0,0,0,0.15);
    }
</style>

<div class="form-container">
    <h1>Edit Doctor</h1>
    <form action="{{ route('admindoctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="working_hours">Working Hours</label>
            <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', $doctor->working_hours) }}" required>
            @error('working_hours')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password">Password <small>(Leave blank to keep current password)</small></label>
            <input type="password" name="password" class="form-control" placeholder="Enter new password if you want to change">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="specialization_id">Specialization ID</label>
            <input type="number" name="specialization_id" class="form-control" value="{{ old('specialization_id', $doctor->specialization_id) }}" required>
            @error('specialization_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}" required>
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="license_number">License Number</label>
            <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $doctor->license_number) }}" required>
            @error('license_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Photo Upload -->
        <div class="form-group">
            <label for="photo">Doctor Photo</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if($doctor->photo)
                <img src="{{ asset($doctor->photo) }}" alt="Doctor Photo" class="photo-preview">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admindoctors.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
