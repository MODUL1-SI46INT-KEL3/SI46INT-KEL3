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
        <h1>Edit Symptom</h1>
        <a href="{{ route('adminsymptoms.index') }}" class="btn btn-primary">Back to Symptoms List</a>
    </div>

    <form action="{{ route('adminsymptoms.update', $symptom->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Symptom Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $symptom->name }}" required>
        </div>
        
        <div class="form-group">
            <label for="specializations">Select Specializations</label>
            <select name="specializations[]" id="specializations" class="form-control" multiple required>
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}" 
                        @if($symptom->specializations->contains($specialization->id)) selected @endif>
                        {{ $specialization->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Update Symptom</button>
    </form>
</div>
@endsection