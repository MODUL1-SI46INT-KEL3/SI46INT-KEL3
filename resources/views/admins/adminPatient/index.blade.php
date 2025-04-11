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

    .btn-success, .btn-warning, .btn-danger, .btn-primary, .btn-secondary {
        border: none;
        border-radius: 5px;
        color: white;
        width: 150px;
        height: 40px;
        cursor: pointer;
        text-decoration: none;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .btn-success { background-color: #28a745; }
    .btn-success:hover { background-color: #218838; }

    .btn-warning { background-color: #ff9900; }
    .btn-warning:hover { background-color: #e68a00; }

    .btn-danger { background-color: #dc3545; }
    .btn-danger:hover { background-color: #c82333; }

    .btn-primary { background-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; }

    .btn-secondary { background-color: #6c757d; }
    .btn-secondary:hover { background-color: #5a6268; }
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
        <h1>{{ $nav }}</h1>
        <p> <b>Default Password</b> : defaultPassword123 </p>
        <div>
            <a href="{{ route('adminPatient.create') }}" class="btn btn-primary" style="margin-right: 10px;">Add Patient</a>
            <a href="{{ route('adminPatient.patient_export') }}" class="btn btn-secondary">Export PDF</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Patient Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>ID Card</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $index => $patient)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $patient->patient_name }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->address }}</td>
                    <td>{{ $patient->id_card }}</td>
                    <td>
                        <a href="{{ route('adminPatient.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('adminPatient.destroy', $patient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No Patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
