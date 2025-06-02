<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">


</head>
<body>

    <div id="header">
        <header>
            <div class="logo">
            <a href="{{ route('views.landing') }}">
                    <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
                </a>
            </div>

            <div class="navigation">
                <div class="top_header">
                    <div class="top_headerchild">
                        <div class="contact">
                            <div class="contact_item">
                                <img src="icons/email icon.png">
                                <p>cs@telkomedika.co.id</p>
                            </div>
                            <div class="contact_item">
                                <img src="icons/phone icon.png">
                                <p>1500115</p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="main_header">
                    <nav>
                        <ul style="list-style-type:none;" class="nav">
                            <li class="main_nav"><a href="{{ url('medicines') }}">Medicine</a></li> 
                            <li class="main_nav"><a href="{{ url('symptoms') }}">Check Symptoms</a></li>
                            <li class="main_nav"><a href="{{ url('articles') }}">Articles</a></li>
                            <li class="main_nav"><a href="/">Review Us</a></li>
                            <li class="gradient">
                                <a href="{{ url('appointments') }}"><button> Book Appointment > </button></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>   
        </header>
    </div>
</body>