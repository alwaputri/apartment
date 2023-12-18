<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Welcome to Easton Apartment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/img/easton-icon.png" />
    
    <!-- Google Fonts and Font Awesome -->
    <!-- Menggunakan CDN untuk Font Awesome -->
    <script src="https://kit.fontawesome.com/7eb77830ad.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
    
    <!-- Include jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column">
    <div class="wrapper flex-grow-1">
        <!-- Sidebar -->
        <div class="sidebar" data-color="white" data-active-color="danger"> 
        <div class="logo">
    <a class="simple-text logo-apartment text-center">
        <div class="text-center">
        <i class="fa fa-building" style="font-size:80px"></i><br>
        <br>
            <h6 class="text-dark" style="font-size:10px">Apartement Easton Park Jatinangor</h6>
            <h6 class="text-dark" style="font-size:10px">by Yunus</h6>
            <!-- <img src="../assets/img/easton-icons.png" alt="Easton Apartment Logo" width="190" height="120"> -->
        </div>
    </a>
</div>

            <div class="sidebar-wrapper">
                <!-- Include the sidebar menu -->
                @include('layout.menu')
            </div>
        </div>
        <!-- End Sidebar -->
        
        <div class="main-panel flex-grow-1">
            <!-- Navbar -->
            <!-- Include your navbar or header content here -->
            
            <!-- Content Section -->
            <div class="content">
                @yield('content') <!-- Your content goes here -->
            </div>
            <!-- End Content Section -->
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer footer-black footer-white">
        @include('layout.footer') <!-- Include your footer content here -->
    </footer>
</body>
</html>
