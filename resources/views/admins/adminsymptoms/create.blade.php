@extends('admins.index')

@section('content')
<style>
    .container {
        margin-top: 40px;
        padding: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .header h1 {
        margin: 0;
    }
    .btn-success {
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Create New Symptom</h1>
        <a href="{{ route('adminsymptoms.index') }}" class="btn btn-primary">Back to Symptoms List</a>
    </div>

    <form method="POST" action="{{ route('adminsymptoms.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Symptom Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="specializations" class="form-label">Specializations</label>
        <select class="form-select @error('specializations') is-invalid @enderror" id="specializations" name="specializations[]" multiple>
            @foreach ($specializations as $specialization)
                <option value="{{ $specialization->id }}" {{ in_array($specialization->id, old('specializations', [])) ? 'selected' : '' }}>
                    {{ $specialization->name }}
                </option>
            @endforeach
        </select>
        @error('specializations')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save Symptom</button>
    </form>

</div>
@endsection