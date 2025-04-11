@extends('admins.index')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">{{ $nav }}</h1>

    <div class="card">
        <form action="{{ route('adminPatient.store') }}" method="post" style="padding:20px;">
            @csrf

            <div class='mb-3'>
                <label for="patient_name" class="form-label">Patient Name</label>
                <input type="text" class="form-control @error('patient_name') is-invalid @enderror" id="patient_name"
                    name="patient_name" placeholder="Enter Patient Name" value="{{ old('patient_name') }}" required>
                @error('patient_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class='mb-3'>
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth"
                    name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                @error('date_of_birth')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class='mb-3'>
                <label>Gender</label>
                <div>
                    <input type="radio" id="male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <label for="female">Female</label>
                </div>
            </div>

            <div class='mb-3'>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class='mb-3'>
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}" required>
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class='mb-3'>
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" placeholder="Enter Address" value="{{ old('address') }}" required>
                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class='mb-3'>
                <label for="id_card" class="form-label">ID Card</label>
                <input type="text" class="form-control @error('id_card') is-invalid @enderror" id="id_card"
                    name="id_card" placeholder="Enter ID Card Number" value="{{ old('id_card') }}" required>
                @error('id_card')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('adminPatient.index') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>

@endsection
