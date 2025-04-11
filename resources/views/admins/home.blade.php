@extends('admins.index') 
@section('content')

<style>
    .mb-4 {
        font-size: 3.5rem;
        margin-top: 30px;
        color: #FFFFFF; 
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        animation: fadeIn 2s ease-in-out;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 1px;
        line-height: 1.2;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
        background: linear-gradient(90deg, #851216 10%, #FFFFFF 100%); 
        animation: none; 
    }

    .button-container {
        margin-top: 20px;
    }

    .btn {
        padding: 12px 25px;
        font-size: 1.2rem;
        color: #FFFFFF; 
        background-color: #851216; 
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-transform: uppercase;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-weight: bold;
    }

    .btn:hover {
        background-color: #851216;
        transform: translateY(-3px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container">
    <h1 class="mb-4">Welcome to Telkomedika<br>Management Website!</h1>
</div>

@endsection