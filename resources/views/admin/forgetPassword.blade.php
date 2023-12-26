<!DOCTYPE html>
<html lang="en">

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
    <link href="{{ asset('assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    <link href="images/favicon.png" rel="shortcut icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/plugins/nprogress/nprogress.js') }}"></script>
</head>

<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="card col-12 card-default mb-0">
                        <div class="card-header pb-0">
                            @if (session('error'))
                                <div class=" col-12 alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class=" col-12 alert alert-danger error d-none" role="alert">
                            </div>

                            <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                <a class="w-auto pl-0" href="/index.html">
                                    {{-- <img src="images/logo.png" alt="Mono"> --}}
                                    <span class="brand-name text-dark">DemoEcommerce</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-5 pb-5 pt-0">
                            <h4 class="text-dark textt mb-6 text-center">Enter your Email</h4>

                            <form id="submit" method="POST">
                                @csrf
                                <div class="row col-12">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="email"
                                            aria-describedby="emailHelp" placeholder="Email" name="email">
                                    </div>
                                    <div class="text-danger form-group col-md-12 mb-4 small mt-1" id="errors"></div>

                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-pill mb-4">Submit</button>
                                    </div>
                                </div>
                            </form>

                            <form id="forgrt" method="POST" class="d-none">
                                @csrf
                                <div class="row col-12">
                                    <div class="form-group col-md-12" id="forget_password">
                                        <input type="password" class="form-control input-lg" id="password"
                                            placeholder="Password" name="password">
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-pill mb-4">Submit</button>
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
        // document.addEventListener('DOMContentLoaded', function() {
        //     var successMessage = document.querySelector('.alert-danger');
        //     if (successMessage) {
        //         setTimeout(function() {
        //             successMessage.style.display = 'none';
        //         }, 10000);
        //     }
        // });

        $(document).ready(function() {
            $('#submit').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: "post",
                    url: "{{ route('forget.forgetSubmit') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.status === false) {
                            var message = response.message;
                            // console.log(message);
                            if (response.message_notmatch) {
                                $('.error').removeClass('d-none');
                                $('.error').append(response.message_notmatch);
                            }

                            if (message.email) {
                                // console.log(message.email);
                                $('#email').addClass('is-invalid').parent().siblings('#errors')
                                    .addClass('').html(message.email);
                            } else {
                                $('#email').removeClass('is-invalid').parent().siblings(
                                    '#errors').removeClass(
                                    '').html('');
                            }
                        } else {
                            $('.error').addClass('d-none');
                            $('#forgrt').removeClass('d-none');
                            $('#submit').hide();
                            $('.textt').empty();
                            $('.textt').append('Enter your password');
                        }
                    },
                    error: function(error) {

                        console.log(error);
                    }
                });
            });

            $('#forgrt').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "post",
                    url: "{{ route('update.updatePassword') }}",
                    dataType: "json",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == true) {
                            window.location.href = "/admin";
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
