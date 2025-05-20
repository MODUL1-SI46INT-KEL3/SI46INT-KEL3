@extends('appointments.layout')

@section('content')

<style>
    .fields {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin: 20px 0;
    }

    select {
        width: 720px;
        height: 50px;
        font-size: 1rem; 
        padding: 5px; 
        padding-left: 15px;
        box-sizing: border-box;
        border-radius: 5px;
        font-family: 'Poppins', serif;
    }

    h2{
        font-size: 1.3rem;
        font-weight: 550; 
        margin-bottom: 30px;
    }

    .dot.dot-1 {
        background-color: #851216;
        border: 2px solid #851216;
    }


    .buttons {
        display:flex;
        justify-content: space-between;
    }

    .buttons a.back-button,
    .buttons button.next {
        width: 150px;
        border: 2px solid gray;
        background-color: white;
        font-size: 1rem;
        padding: 7px 0;
        text-align: center;
        display: inline-block;
        cursor: pointer;
        border-radius: 20px;
        color: black;
        text-decoration: none;
        box-sizing: border-box;
    }

    .buttons button.next {
        background-color: #851216;
        border: 2px solid #851216;
        color: white;
        padding: 10px 0;
    }

    .buttons button.next:disabled {
        background-color: gray;
        border-color: gray;
        color: #ddd;
        cursor: not-allowed;
    }

    
</style>

<h2>Please select a specialist :</h2>

<form method="POST" action="{{ route('appointments.step1_specialist') }}">
    @csrf

    <div class="fields">
        <label for="specialization_id">Specialization:</label>
        <select name="specialization_id" id="specialization_id" required>
            <option value="">-- Select Specialization --</option>
            @foreach($specializations as $spec)
                <option value="{{ $spec->id }}">{{ $spec->name }}</option>
            @endforeach
        </select>
        @error('specialization_id')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="fields">
        <label for="doctor_id">Doctor:</label>
        <select name="doctor_id" id="doctor_id" required disabled>
            <option value="">Please select a specialization first</option>
        </select>
        <div id="no-doctors-message" style="color: red; display: none;">
            Sorry, no doctors available for this specialization.
        </div>
        @error('doctor_id')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="buttons">
        <a href="{{ route('patients.index') }}" class="back-button">Back</a>
        <button class="next" type="submit" id="submit-btn" disabled>Next</button>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const specializationSelect = document.getElementById('specialization_id');
    const doctorSelect = document.getElementById('doctor_id');
    const noDoctorsMessage = document.getElementById('no-doctors-message');
    const submitBtn = document.getElementById('submit-btn');

    specializationSelect.addEventListener('change', function () {
        const specializationId = this.value;

        doctorSelect.innerHTML = '';
        noDoctorsMessage.style.display = 'none';
        submitBtn.disabled = true;

        if (!specializationId) {
            doctorSelect.innerHTML = '<option value="">Please select a specialization first</option>';
            doctorSelect.disabled = true;
            return;
        }

        fetch(`/specializations/${specializationId}/doctors`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    doctorSelect.disabled = true;
                    noDoctorsMessage.style.display = 'block';
                } else {
                    doctorSelect.disabled = false;
                    noDoctorsMessage.style.display = 'none';

                    doctorSelect.innerHTML = '<option value="">-- Select Doctor --</option>';
                    data.forEach(function (doctor) {
                        const option = document.createElement('option');
                        option.value = doctor.id;
                        option.textContent = doctor.name;
                        doctorSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching doctors:', error);
                doctorSelect.disabled = true;
                noDoctorsMessage.textContent = 'Error loading doctors.';
                noDoctorsMessage.style.display = 'block';
            });
    });

    doctorSelect.addEventListener('change', function () {
        submitBtn.disabled = !this.value;
    });
});
</script>
@endsection