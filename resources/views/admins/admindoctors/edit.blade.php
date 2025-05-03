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
</style>
<h1>Edit Doctor</h1>
<form action="{{ route('admindoctors.update', $doctor->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $doctor->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $doctor->email }}" required>
    </div>
    <div class="form-group">
        <label for="working_hours">Working Hours</label>
        <input type="text" name="working_hours" class="form-control" value="{{ $doctor->working_hours }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" value="{{ $doctor->password }}" required>
    </div>
    <div class="form-group">
        <label for="specialization_id">Specialization ID</label>
        <input type="number" name="specialization_id" class="form-control" value="{{ $doctor->specialization_id }}" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $doctor->phone }}" required>
    </div>
    <div class="form-group">
        <label for="license_number">License Number</label>
        <input type="text" name="license_number" class="form-control" value="{{ $doctor->license_number }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection