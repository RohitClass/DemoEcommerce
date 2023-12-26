<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Ecommerce</title>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
        <link href="plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{ asset('assets/plugins/nprogress/nprogress.css') }} " rel="stylesheet" />

        <!-- MONO CSS -->
        <link id="main-css-href" rel="stylesheet" href="{{ asset('assets/css/style.css') }} " />

        <link href="images/favicon.png" rel="shortcut icon" />
        <script src="{{ asset('assets/plugins/nprogress/nprogress.js') }}  "></script>
    </head>

</head>

<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="card card-default mb-0">
                        <div class="card-header pb-0">
                            @if (session('error'))
                                <div class=" col-12 alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class=" col-12 alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                <a class="w-auto pl-0" href="/index.html">
                                    {{-- <img src="images/logo.png" alt="Mono"> --}}
                                    <span class="brand-name text-dark">DemoEcommerce</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-5 pb-5 pt-0">

                            <h4 class="text-dark mb-6 text-center">Admin Login</h4>

                            <form action="{{ route('login.loginSubmit') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="email"
                                            aria-describedby="emailHelp" placeholder="email" name="email">
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <input type="password" class="form-control input-lg" id="password"
                                            placeholder="Password" name="password">
                                    </div>
                                    <div class="col-md-12">

                                        <div class="d-flex justify-content-between mb-3">

                                            <div class="custom-control custom-checkbox mr-3 mb-3">

                                            </div>

                                            <a class="text-color" href="{{ route('forget.forgetPassword') }}"> Forgot
                                                password? </a>

                                        </div>

                                        <button type="submit" class="btn btn-primary btn-pill mb-4">Login</button>

                                        <p>only for admin login here !
                                            <a class="text-blue" href="/admin">login</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.querySelector('.alert-danger');
            var successMessage = document.querySelector('.alert-success');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>

</body>


</html>
