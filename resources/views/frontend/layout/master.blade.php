<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('desc')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Favicon -->
    <link href="assets/images/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light text-dark py-0">
        <div class="container">
            <div class="row gx-0 d-lg-flex">
                <div class="col-lg-8 col-12 text-start py-2">
                    <div class="h-100 d-inline-flex align-items-center">
                        <small><a href="#main-content" class="text-dark pe-2 border-end border-secondary text-hover-primary">Skip to Main Content</a></small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center ms-1">
                        <small><a href="screen-reader.php" class="text-dark pe-2 border-end border-secondary text-hover-primary">Screen Reader</a></small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center ms-1">
                        <small><a href="#" xml:lang="en" lang="en" class="text-dark pe-2 border-end border-secondary text-hover-primary">English</a></small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center ms-1">
                        <small><a href="#" xml:lang="pa" lang="pa" class="text-dark pe-2 border-end border-secondary text-hover-primary">ਪੰਜਾਬੀ</a></small>
                    </div>
                    <div class="h-100 d-none d-lg-inline-block d-inline-flex align-items-center ms-1">
                        <small>Text Size
                            <a href="#" class="text-white ps-2">
                                <img src="assets/images/fs14.gif" alt="Normal Font Size" title="Font Size Normal">
                            </a>
                            <a href="#" class="text-white ps-2">
                                <img src="assets/images/fs12.gif" alt="Decrease Font Size" title="Font Size Decrease">
                            </a>
                            <a href="#" class="text-white ps-2">
                                <img src="assets/images/fs16.gif" alt="Increase Font Size" title="Font Size Increase">
                            </a>
                        </small>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block col-12 text-end">
                    <div class="h-100 d-inline-flex align-items-center me-4">
                        <small class="fa fa-phone-alt text-dark me-2"></small>
                        <small>+012 345 6789</small>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center mx-n2">
                        <a class="btn btn-square btn-link rounded-0 text-dark" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-link rounded-0 text-dark" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-link rounded-0 text-dark" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-square btn-link rounded-0 text-dark" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <div class="container-fluid py-3 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="assets/images/punlogo.gif" class="" width="80" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <a href="{{url('/')}}" class="">
                                <h3 class="mb-0 text-dark">Credit Monitoring System</h3>
                                <p class="h6 text-primary">Distt. SAS Nagar, Govt. of Punjab</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/g20.png" class="float-end" width="100" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <img src="assets/images/advt.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top p-0">
        <div class="container">
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="javascript:void()" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About Us</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="{{url('/about-us')}}" class="dropdown-item">About Department</a>
                            <a href="#" class="dropdown-item">Organisation Structure</a>
                            <a href="#" class="dropdown-item">Who's Who</a>
                            <a href="#" class="dropdown-item">Director's Desk</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Schemes</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="#" class="dropdown-item">Punjab Govt. Schemes</a>
                            <a href="#" class="dropdown-item">Scholarship Schemes</a>
                            <a href="#" class="dropdown-item">Community Development (CDTP)</a>
                        </div>
                    </div>
                    <a href="#" class="nav-item nav-link">Public Notices</a>
                    <a href="{{url('/contact-us')}}" class="nav-item nav-link">Contact</a>
                </div>
                <!-- <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Get Started<i class="fa fa-arrow-right ms-3"></i></a> -->
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div id="main-content"></div>
    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-6 mb-3">
                    <a href="#">
                        <img src="assets/images/my-gov.jpg" class="img-fluid border" alt="">
                    </a>
                </div>
                <div class="col-lg-2 col-6 mb-3">
                    <a href="#">
                        <img src="assets/images/indiaportal.jpg" class="img-fluid border" alt="">
                    </a>
                </div>
                <div class="col-lg-2 col-6 mb-3">
                    <a href="#">
                        <img src="assets/images/digital-india.jpg" class="img-fluid border" alt="">
                    </a>
                </div>
                <div class="col-lg-2 col-6 mb-3">
                    <a href="#">
                        <img src="assets/images/makeinindia.jpg" class="img-fluid border" alt="">
                    </a>
                </div>
                <div class="col-lg-2 col-6 mb-3">
                    <a href="#">
                        <img src="assets/images/punjab-govt.jpg" class="img-fluid border" alt="">
                    </a>
                </div>
                <div class="col-lg-2 col-6 mb-3">
                    <a href="#">
                        <img src="assets/images/dtepunjab.jpg" class="img-fluid border" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light footer mb-6 mb-0 py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Get In Touch</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Sector 76, SAS Nagar, Mohali</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 172 123456</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@domainname.com</p>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="#">About Us</a>
                    <a class="btn btn-link" href="#">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="#">Public Notices</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Other Links</h5>
                    <a class="btn btn-link" href="">Copyright</a>
                    <a class="btn btn-link" href="">Disclaimer</a>
                    <a class="btn btn-link" href="">Terms & Conditions</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">Follow Us</h5>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; {{date('Y')}} <a href="#">Credit Monitoring System</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    Powered By <a href="https://www.dukeinfosys.com" target="_blank">Duke Infosys</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>