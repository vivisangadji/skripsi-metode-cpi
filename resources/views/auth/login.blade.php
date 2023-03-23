<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &mdash; Skripsi CPI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />


    <link rel="stylesheet" href="{{asset('vendor/bootstrap/dist/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- <link rel="stylesheet" href="../vendor/themify-icons/themify-icons.css"> -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-override.css')}}">


</head>

<body>
<section class="container h-100">
    <div class="row justify-content-sm-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h1 class="fs-4 text-center fw-bold mb-4">Login</h1>
                    <form method="POST" action="{{ route('login') }}" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate=""
                        autocomplete="off">
                        @csrf  
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="email">Email</label>
                            <div class="input-group input-group-join mb-3">
                                <input id="email" type="email" placeholder="Masukkan Email" class="form-control"
                                    name="email" required autofocus>
                                    <span class="input-group-text rounded-end">&nbsp<i class="fa fa-envelope"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Email is invalid
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted" for="password">Password</label>
                                
                            </div>
                            <div class="input-group input-group-join mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Password required
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary ms-auto">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-5 text-muted">
                Copyright &copy; 2023 &mdash; Skripsi CPI
            </div>
        </div>
    </div>
</section>
    <script src="{{asset('assets/js/login.js')}}"></script>
</body>
</html>