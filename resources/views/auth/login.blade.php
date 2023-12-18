<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login - Easton Apartment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/img/easton-icon.png" />
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <style>
        /* Center the login form vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa; /* Set your desired background color */
        }

        /* Style the card */
        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #ffffff; /* Set the card background color */
            border-radius: 10px; /* Adjust the border radius as needed */
        }

        /* Style the logo */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px; /* Adjust the size of the logo */
        }

        /* Style the form elements */
        .form-group label {
            font-weight: bold;
            color: #333; /* Text color */
        }

        .form-control {
            border: 1px solid #ccc; /* Add a light gray border */
            border-radius: 5px; /* Rounded corners for input fields */
        }

        .custom-control-label {
            color: #333; /* Checkbox label color */
        }

        .btn-primary {
            background-color: #ff6b6b; /* Primary button color */
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff4747; /* Darker shade on hover */
        }
        h3, label, .custom-control-label {
        color: #333; /* Warna teks utama */
    }
    .form-control:focus {
        border-color: #007bff; /* Warna border input saat fokus */
    }

    /* Tambahkan animasi untuk card login */
    .card {
        animation: fadeIn 1s ease-in-out;
    }

    /* Tambahkan animasi untuk tombol Login */
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Animasi fadeIn untuk card */
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

    </style>
</head>
<body>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <div class="logo">
                            <img src="../assets/img/easton-icon.png" alt="Easton Apartment Logo">
                        </div>
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.aksi') }}">
                            @csrf
                            @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            

                            
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>

                                <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>
