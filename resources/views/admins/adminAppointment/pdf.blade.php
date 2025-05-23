<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $nav }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            margin: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
        }
        
        td {
            max-width: 150px;
            overflow-wrap: break-word;
        }
    </style>
</head>
<body>
    <h1>{{ $nav }}</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Schedule Date</th>
                <th>Schedule Time</th>
                <th>Status</th>
                <th>Booking ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $index => $appointment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $appointment->patient->patient_name ?? '-' }}</td>
                    <td>{{ $appointment->doctor->name ?? '-' }}</td>
                    <td>{{ optional($appointment->schedule)->available_date ?? '-' }}</td>
                    <td>
                        @if($appointment->schedule)
                            {{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @php
                            $statusClass = match($appointment->status) {
                                'pending' => 'status-pending',
                                'canceled' => 'status-canceled',
                                'done' => 'status-done',
                                'no show' => 'status-no-show',
                                default => '',
                            };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            {{ ucfirst($appointment->status ?? '-') }}
                        </span>
                    </td>
                    <td>{{ $appointment->booking_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>