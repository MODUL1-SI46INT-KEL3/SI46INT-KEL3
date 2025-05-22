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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault();
        const form = event.target.closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
<div class="container">
    <div class="header">
        <h1>Medicines</h1>
        <div class="buttons">
            <a href="{{ route('adminmedicine.create') }}" class="btn btn-primary">Add Medicine</a>
            <a href="{{ route('adminmedicine.medicine_export') }}" class="btn btn-secondary" style="margin-left: 10px;">Export PDF</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $medicine)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($medicine->image)
                            <img src="{{ asset($medicine->image) }}" alt="Medicine Image" style="max-width: 60px; max-height: 60px;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $medicine->medicine_name }}</td>
                    <td>{{ $medicine->description }}</td>
                    <td>Rp {{ number_format($medicine->price, 0, ',', '.') }}</td>
                    <td>{{ $medicine->stock }}</td>
                    <td>
                        <a href="{{ route('adminmedicine.edit', $medicine->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('adminmedicine.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection