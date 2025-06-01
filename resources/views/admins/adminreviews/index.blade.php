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
        width: 60px;
        height: 40px;
        cursor: pointer;
        text-decoration: none;
        margin-bottom: 5px;
        margin-top: 5px;
    }
    .btn-warning { background-color:rgb(224, 166, 127); }
    .btn-warning:hover { background-color:rgb(241, 174, 133); }
    .btn-danger { background-color:rgb(206, 84, 79); }
    .btn-danger:hover { background-color:rgb(160, 83, 81); }
    .danger2 {background-color:rgb(211, 121, 118);}
</style>

<div class="container">
    <div class="header">
        <h1>
            Customer Reviews{{ $category ? ' for ' . ucfirst($category) : '' }}
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

    @if(session('message'))
    <div class="alert alert-{{ session('alert-type', 'success') }}">
        {{ session('message') }}
    </div>
    @endif


    <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 20%;">Patient Name</th>
                <th style="width: 8%;">Rating</th>
                <th style="width: 10%;">Category</th>
                <th style="width: 12%;">Submitted At</th>
                <th style="width: 35%;">Details</th>
                <th style="width: 10%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $review->patient_name }}</td>
                        <td>{{ $review->rating }} / 5</td>
                        @php
                            $categoryMap = [
                                'web' => 'Web',
                                'appointment' => 'Appt.',
                                'shop' => 'Shop',
                            ];
                        @endphp

                        <td>{{ $categoryMap[$review->category] ?? $review->category }}</td>
                        <td>{{ \Carbon\Carbon::parse($review->submitted_at)->format('d M Y') }}</td>
                        <td>{{ Str::limit($review->details, 100) }}</td>
                        <td>
                            @if($review->category === 'appointment')
                                @if($review->status)
                                    <form method="POST" action="{{ route('adminreviews.markUnsent', $review->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button dusk="unsend-button" type="submit" class="btn btn-danger danger2" onclick="return confirm('Are you sure you want to retract this review?');">
                                            <img src="{{ asset('icons/cancelsend.png') }}" alt="Retract" style="width: 20px; height: 20px;">
                                        </button>
                                    </form>
                                @else
                                    {{-- Not Sent: show send form --}}
                                    <form method="POST" action="{{ route('adminreviews.markSent', $review->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button dusk="send-button" type="submit" class="btn btn-warning">
                                            <img src="{{ asset('icons/send.png') }}" alt="Send" style="width: 20px; height: 20px;">
                                        </button>
                                    </form>
                                @endif
                            @endif

                            <form action="{{ route('adminreviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button dusk="delete-button" type="submit" class="btn btn-danger" onclick="confirmDelete(event)">
                                    <img src="{{ asset('icons/trash.png') }}" alt="Send" style="width: 20px; height: 20px;">  
                                </button>
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
