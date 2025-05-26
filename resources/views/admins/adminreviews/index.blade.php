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
    .table {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 15px 15px rgba(139, 0, 0, 0.5);
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        padding: 15px;
        border: 1px solid #ddd;
    }
    .table th {
        background-color: #851216;
        color: white;
    }
    .btn-primary, .btn-success, .btn-warning, .btn-danger {
        border: none;
        border-radius: 5px;
        color: white;
        width: 150px;
        height: 40px;
        cursor: pointer;
        text-decoration: none;
        margin-bottom: 5px;
        margin-top: 5px;
    }
    .btn-success { background-color: #28a745; }
    .btn-success:hover { background-color: #218838; }
    .btn-warning { background-color: #ff9900; }
    .btn-warning:hover { background-color: #e68a00; }
    .btn-danger { background-color: #dc3545; }
    .btn-danger:hover { background-color: #c82333; }
</style>

<div class="container">
    <div class="header">
        <h1>
            Customer Reviews{{ $category ? ' on ' . ucfirst($category) : '' }}
        </h1>
        <form method="GET" action="{{ route('adminreviews.index') }}">
            <select name="category" onchange="this.form.submit()" class="form-select" style="width: 200px; height: 40px; border-radius: 5px;">
                <option value="" {{ $category == '' ? 'selected' : '' }}>No Filter</option>
                <option value="web" {{ $category == 'web' ? 'selected' : '' }}>Web</option>
                <option value="shop" {{ $category == 'shop' ? 'selected' : '' }}>Shop</option>
                <option value="appointment" {{ $category == 'appointment' ? 'selected' : '' }}>Appointment</option>
            </select>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Patient Name</th>
                <th>Rating</th>
                <th>Submitted At</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $review->patient_name }}</td>
                    <td>{{ $review->rating }} / 5</td>
                    <td>{{ \Carbon\Carbon::parse($review->submitted_at)->format('d M Y') }}</td>
                    <td>{{ Str::limit($review->details, 50) }}</td>
                    <td>
                        <a href="{{ route('adminreviews.show', $review->id) }}" class="btn btn-primary">View</a>
                        <form action="{{ route('adminreviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)">Delete</button>
                        </form>

                        </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No reviews available for this category.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(event) {
        if (!confirm('Are you sure you want to delete this review?')) {
            event.preventDefault();
        }
    }
</script>

@endsection
