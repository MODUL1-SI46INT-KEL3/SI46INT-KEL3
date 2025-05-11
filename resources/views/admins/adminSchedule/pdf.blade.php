<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <h1>Schedule List</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Start_Time</th>
                <th>End-Time</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->doctor_id }}</td>
                    <td>{{ $schedule->doctor->name }}</td>
                    <td>{{ $schedule->available_date }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>{{ $schedule->is_available }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
