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
        <h1>Edit Medicine</h1>
        <a href="{{ route('adminmedicine.index') }}" class="btn btn-primary">Back to Medicines List</a>
    </div>
    <form action="{{ route('adminmedicine.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="medicine_name">Medicine Name</label>
            <input type="text" name="medicine_name" id="medicine_name" class="form-control" value="{{ $medicine->medicine_name }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $medicine->description }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $medicine->price }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="stock">Stock</label>
            <input type="text" name="stock" id="stock" class="form-control" value="{{ $medicine->stock }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="image">Medicine Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if($medicine->image)
                <div class="mt-2">
                    <img src="{{ asset($medicine->image) }}" alt="Current image" style="max-width: 120px; max-height: 120px;">
                </div>
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success">Update Medicine</button>
    </form>
</div>
@endsection