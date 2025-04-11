
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkomedika</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/register_patient.css') }}">

</head>
<body>
    <div id="header">
        <header>
        <div class="logo">
                <a href="{{ route('views.landing') }}">
                    <img src="{{ asset('icons/logo.png') }}" alt="Telkomedika">
                </a>
            </div>
        </header>
    </div>

    <div>
        <div class="form_body">
            <div class="form_head">
                <h1>Register an Account</h1>
                <hr>
                <p>Please fill in your information</p>
            </div>
            <div class="form_child">
                <form action="{{ route('patients.store') }}" method="post">
                
                    <div class=form_field>
                        @csrf
                        <div class="form_box">
                            <div class="form_input">
                                <label for="patient_name">Your Full Name</label>
                                <input type="text" id="patient_name" name="patient_name" placeholder="Full Name" value="{{ old('patient_name') }}" required>
                                @error('patient_name')
                                    <div class="error_message">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" placeholder="mm/dd/yyyy" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <div class="error_message">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="gender-group">
                                    <label>Gender</label>
                                    <div>
                                        <input type="radio" id="male" name="gender" value="male" checked>
                                        <label for="male">Male</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="female" name="gender" value="female">
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="form_box">
                            <div class="form_input">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="error_message">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="error_message">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" placeholder="Address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="error_message">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label for="id_card">ID Card Number</label>
                                <input type="text" id="id_card" name="id_card" placeholder="ID Card Number" value="{{ old('id_card') }}" required>
                                @error('id_card')
                                    <div class="error_message">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div> 

                        <div class="form_box">
                            <div class="form_input">

                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                                @error('password')
                                    <div class="error_message">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="show_password">
                                    <input type="checkbox" name="show_password" onclick="myFunction()">Show Password
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="submit">
                        <div class="buttons">
                            <button type="submit" class="register_account">Register</button>
                            <button class="cancel">Cancel</button>
                        </div>
                    </div>
                </form>               
            </div>
        </div>
    </div>
</body>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</html>
