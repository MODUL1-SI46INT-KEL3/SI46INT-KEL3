<div class="form-group">
    <label for="doctor_id">Doctor</label>
    <select name="doctor_id" class="form-control" required>
        @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}" {{ isset($schedule) && $schedule->doctor_id == $doctor->id ? 'selected' : '' }}>
                {{ $doctor->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="patient_id">Patient</label>
    <select name="patient_id" class="form-control" required style="color: black; background-color: white;">
        @foreach($patients as $patient)
            <option 
                value="{{ $patient->id }}" 
                style="color: black; background-color: white;" 
                {{ isset($schedule) && $schedule->patient_id == $patient->id ? 'selected' : '' }}>
                {{ $patient->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" class="form-control" value="{{ old('date', $schedule->date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="time">Time</label>
    <input type="time" name="time" class="form-control" value="{{ old('time', $schedule->time ?? '') }}" required>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <input type="text" name="status" class="form-control" value="{{ old('status', $schedule->status ?? '') }}" required>
</div>
