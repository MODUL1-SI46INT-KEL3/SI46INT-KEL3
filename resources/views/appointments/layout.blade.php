<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/appointments.css') }}">
</head>
<body>

    <div id="header">
        <header>
            <div class="logo">
                <a href="{{ route('patients.index') }}">
                    <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
                </a>
            </div>
        </header>
    </div>

    <div class="appoint_box">
        <h1>Book Appointment</h1>

        <div class="appoint_box_child">
            <div class="box_main">
                <div class="progress_bar">
                    <div class="text">
                        <p class="p1">Specialist</p>
                        <p class="p2">Time</p>
                        <p class="p3">Details</p>
                        <p class="p4">Finish</p>
                    </div>
                    <div class="progress_line">
                        <span class="dot dot-1"></span>
                        <div class="line">
                            <hr>
                        </div>
                        <span class="dot dot-2"></span>
                        <div class="line">
                            <hr>
                        </div>
                        <span class="dot dot-3"></span>
                        <div class="line">
                            <hr>
                        </div>
                        <span class="dot dot-4"></span>
                        <div class="line">
                            <hr>
                        </div>
                    </div>
                </div>

                <main>
                    @yield('content')
                </main>
            </div>

            <div class="image">
                <a href="{{ route('patients.index') }}">
                    <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
                </a>
            </div>


        
            



    </div>


    
</body>
</html>