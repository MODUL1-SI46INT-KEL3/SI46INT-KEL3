<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <style>
        .body {
            display: none;
            position: fixed;
            
        }

        .logout button {
            width: 100px;
            height: 50px;
            border-radius: 15px;
            font-size: 1rem;
            background-color: #efefef;
            border-color: #737373;
            color: #000000;
            font-family: 'Poppins', serif;
            font-weight: 500;
            border-width: 3px;
        }

        .logout button:hover {
            cursor: pointer;
            background-color: #851216;
            border-color: #851216;
            color: #fff;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <ul class="list-unstyled">
            <li>
                <a class="active" href="{{ route('doctordash.home') }}">
                    TELKOMEDIKA DOCTOR
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">---</a>
            </li>
        </ul>
        <a href="{{ route('views.landing') }}" class="logout">
            <button>Logout</button>
        </a>
    </aside>

</body>
</html>