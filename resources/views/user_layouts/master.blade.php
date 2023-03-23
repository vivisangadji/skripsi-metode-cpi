<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Kost PK7</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="Version" content="v3.2.0" />
        <!-- favicon -->
        <link rel="shortcut icon" href="{{asset('user/images/favicon.ico')}}">
        <!-- Bootstrap -->
        <link href="{{asset('user/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="{{asset('user/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <!-- Slider -->               
        <link rel="stylesheet" href="{{asset('user/css/tiny-slider.css')}}"/>
        <!-- Main Css -->
        <link href="{{asset('user/css/style.css')}}" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="{{asset('user/css/colors/default.css')}}" rel="stylesheet" id="color-opt">
    </head>

    <body>
        <!-- Loader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
        <!-- Loader -->
        
        <!-- Navbar STart -->
        <header id="topnav" class="defaultscroll sticky bg-white">
            <div class="container">
                <!-- Logo container-->
                <a class="logo" href="{{ url('/') }}">
                    <h3 class="mt-3">CPI</h3>
                </a>
                <!-- End Logo container-->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
        
                <div id="navigation">
                    <!-- Navigation Menu-->   
                    <ul class="navigation-menu">
                        <li><a href="/" class="sub-menu-item">Home</a></li>
                        <li><a href="#" class="sub-menu-item">About</a></li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div><!--end container-->
        </header><!--end header-->
        <!-- Navbar End -->

        <!-- Hero Start -->
        <section class="home-slider position-relative">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <div class="bg-home-75vh d-flex align-items-center" style="background: url('{{asset('user/images/blog/bg1.jpg')}}') center center;">
                            <div class="bg-overlay"></div>
                            <div class="container">
                                <div class="row mt-5 justify-content-center">
                                    <div class="col-12">
                                        <div class="title-heading text-center">
                                            <h2 class="text-white title-dark mb-3">Selamat datang di Aplikasi pencarian Kost sekitar Perintis Kemerdekaan VII</h2>
                                            <p class="para-desc mx-auto text-white-50 mb-0">Implementasi metode <span class="text-primary fw-bold">Composite Performance Index(CPI)</span> untuk Kost sekitar wilayah PK7.</p>
                                            <div class="mt-4">
                                                
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                        </div><!--end slide-->
                    </div>

                    
                </div>
                <!-- <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a> -->
            </div>
        </section><!--end section-->
        <!-- Hero End -->

        @yield('content')

        <!-- Footer Start -->
        <footer class="footer footer-bar">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="text-sm-start">
                            <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Aplikasi Kost PK7.</p>
                        </div>
                    </div><!--end col-->

                    <div class="col-sm-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </footer><!--end footer-->
        <!-- Footer End -->

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="btn btn-icon btn-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>
        <!-- Back to top -->

        

        <!-- javascript -->
        <script src="{{asset('user/js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{asset('user/js/bootstrap.bundle.min.js')}}"></script>
        <!-- SLIDER -->
        <script src="{{asset('user/js/tiny-slider.js')}} "></script>
        <!-- Icons -->
        <script src="{{asset('user/js/feather.min.js')}}"></script>
        <!-- Main Js -->
        <script src="{{asset('user/js/plugins.init.js')}}"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
        <script src="{{asset('user/js/app.js')}}"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
        @stack('js')
    </body>
</html>