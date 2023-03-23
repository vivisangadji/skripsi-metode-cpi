<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('') }}vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/perfect-scrollbar/css/perfect-scrollbar.css">

    <!-- CSS for this page only -->
    @stack('css')
    <!-- End CSS  -->

    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap-override.min.css">
    <link rel="stylesheet" id="theme-color" href="{{ asset('') }}assets/css/dark.min.css">
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        @include('layouts.header')
        @include('layouts.nav')    
           
        @yield('content')

        @include('layouts.settings') 

        <footer>
            Copyright © 2023 &nbsp<span> . Skripsi CPI</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('') }}vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('') }}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}assets/js/page/datatables.js"></script>
    <script src="{{ asset('') }}vendor/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="{{ asset('') }}vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>

    <!-- js for this page only -->
    @stack('js')
    <!-- ======= -->
    <script src="{{ asset('') }}assets/js/main.js"></script>
    <script>
        Main.init()
    </script>
</body>

</html>