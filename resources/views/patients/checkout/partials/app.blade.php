<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Telkomedika</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
  <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', serif;
    }

    #header {
      margin-bottom: 40px;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-image: linear-gradient(to right, #EB1F27 , #851216);
      margin-left: 100px;
      padding: 10px;
      padding-bottom: 20px;
      border-radius: 0 0 0 60px;
    }

    .logo {
      background-color: #fff;
      border-radius: 50%;
      height: 90px;
      width: 90px;
      margin-left: 50px;    
    }

    .logo img {
      float: left;
      height: 50px;
      margin-left: 15px;
      margin-top: 20px;
    }

    .hero {
      background-image: linear-gradient(to right, #EB1F27 , #851216);
      color: white;
      text-align: center;
      padding: 20px 20px;
      margin-bottom: 40px;
      font-size: 1rem;
    }

    .search-bar {
      justify-content: center;
      margin: 20px 0;
      margin-left: 120px ;
      margin-right: 100px ;
    }

    .search-bar input {
      width: 80%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px 0 0 4px;
    }

    .card {
      display: flex;
      flex-direction: row;
      align-items: center;
      border: 2px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 15px 15px rgba(139, 0, 0, 0.2);
      padding: 20px;
      height: 100%;
    }

    .card-img {
      height: 185px;          
      width: 120px;          
      object-fit: cover;     
      margin-right: 20px;
      border-radius: 10px;
      border: 1px solid #eee;
      background: #fff;
    }

    .card-body {
      padding: 0;
    }

    .card-title {
      font-size: 1.25rem;
      font-weight: bold;
    }

    .card-text {
      color: #6c757d;
    }

    .btn-primary {
      background-color: #851216;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-primary:hover {
      background-color: #A31E2A;
      text-decoration: underline;
    }

    .clinic-text, .working-hours {
      font-size: 1rem;
      color: #6c757d;
    }

    footer {
      background-color: #FFE2E3;
      display: flex;
      margin-left: 30px;
      margin-right: 30px;
      border-radius: 40px 40px 0 0;
      margin-top: 60px;
    }

    footer a {
      color: #000000;
      text-decoration: none;
    }

    footer a:hover {
      cursor: pointer;
      text-decoration: underline;
    }

    footer img {
      margin: 40px;
      width: 150px;
      height: 120px;
    }

    .footer_text {
      display: flex;
      gap: 100px;
      margin: 20px;
      margin-left: 50px;
      text-align: left;
      font-weight: 500;
    }

    .footer_text h1 {
      font-size: 1.5rem;
      color: #851216;
    }

    .footer_opt {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 20px;
    }

    footer hr {
      width: 300px;
      height: 2px;
      background-color: #000000;
    }
  </style>
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

<div class="container">
    @yield('content')
</div>

</body>
</html>
