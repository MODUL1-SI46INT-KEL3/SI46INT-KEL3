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
        <h1>Create New Article</h1>
        <a href="{{ route('adminarticle.index') }}" class="btn btn-primary">Back to Article List</a>
    </div>
    <form method="POST" action="{{ route('adminarticle.store') }}">
    @csrf
    <div class="mb-3">
        <label for="header" class="form-label">Header</label>
        <input type="text" class="form-control @error('header') is-invalid @enderror" id="header" name="header" value="{{ old('header') }}">
        @error('article_header')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Article Author</label>
        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}">
        @error('author')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="img_file" class="form-label">Upload Image (optional)</label>
        <input type="file" name="img_file" id="img_file" accept="image/*" onchange="validateImage(this)" class="form-control">
    </div>

    <div class="mb-3">
        <label for="img_link" class="form-label">Or Paste Image Link (optional)</label>
        <input type="text" name="img_link" id="img_link" class="form-control" value="{{ old('img_link') }}">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</div>
@endsection

<script>
function validateImage(input) {
    const file = input.files[0];
    if (!file) return;

    const maxSize = 10 * 1024 * 1024; // 10MB

    if (file.size > maxSize) {
        alert("Image size exceeds 10MB. Please choose a smaller file.");
        input.value = ""; // Clear the input
    }
}
</script>
<!-- this is the view for when an admin want to add new article -->