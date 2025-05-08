<div class="form-group">
    <label for="doctor_id">Doctor</label>
    <select name="doctor_id" class="form-control" required>
        @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}"
                {{ isset($schedule) && $schedule->doctor_id == $doctor->id ? 'selected' : '' }}>
                {{ $doctor->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="available_date">Available Date</label>
    <input type="date" name="available_date" class="form-control"
        value="{{ old('available_date', $schedule->available_date ?? '') }}" required>
</div>

<div class="form-group">
    <label for="start_time">Start Time</label>
    <input type="time" name="start_time" class="form-control"
        value="{{ old('start_time', $schedule->start_time ?? '') }}" required>
</div>

<div class="form-group">
    <label for="end_time">End Time</label>
    <input type="time" name="end_time" class="form-control"
        value="{{ old('end_time', $schedule->end_time ?? '') }}" required>
</div>

<div class="form-group">
    <label for="is_available">Is Available?</label>
    <select name="is_available" class="form-control">
        <option value="1" {{ old('is_available', $schedule->is_available ?? '') == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ old('is_available', $schedule->is_available ?? '') == 0 ? 'selected' : '' }}>No</option>
    </select>
</div>
