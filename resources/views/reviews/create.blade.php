@extends('layouts.app') {{-- or your main layout --}}

@section('content')
<div class="container">
    <h2>Submit Your Review</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="category">Review Category</label>
            <select name="category" id="category" class="form-control" required>
                <option value="">Select Review Category</option>
                <option value="web" {{ old('category') == 'web' ? 'selected' : '' }}>Website Experience</option>
                <option value="appointment" {{ old('category') == 'appointment' ? 'selected' : '' }}>Appointment Experience</option>
                <option value="shop" {{ old('category') == 'shop' ? 'selected' : '' }}>Medicine Shop</option>
            </select>
        </div>

        <div class="form-group mb-3" id="doctor-select" style="display:none;">
            <label for="doctor_id">Select Doctor</label>
            <select name="doctor_id" id="doctor_id" class="form-control">
                <option value="">-- Choose Doctor --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="rating">Rating (1 to 5 stars)</label>
            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" value="{{ old('rating') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="submitted_at">Date of Experience</label>
            <input type="date" name="submitted_at" id="submitted_at" class="form-control" value="{{ old('submitted_at', date('Y-m-d')) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="details">Your Feedback</label>
            <textarea name="details" id="details" class="form-control" rows="5" required>{{ old('details') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category');
    const doctorSelectDiv = document.getElementById('doctor-select');

    function toggleDoctorSelect() {
        if (categorySelect.value === 'appointment') {
            doctorSelectDiv.style.display = 'block';
        } else {
            doctorSelectDiv.style.display = 'none';
            document.getElementById('doctor_id').value = '';
        }
    }

    toggleDoctorSelect();

    categorySelect.addEventListener('change', toggleDoctorSelect);
});
</script>
@endsection
