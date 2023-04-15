<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title>{{ $ins_name }}</title>

    <!-- ResNova App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}{{ $icon }}">

    <!-- ResNova Bootstrap Css -->
    <link href="{{ asset('/') }}public/new_admin/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- ResNova Icons Css -->
    <link href="{{ asset('/') }}public/new_admin/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- ResNova App Css-->
    <link href="{{ asset('/') }}public/new_admin/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>

</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5 text-muted">
                    <a href="#" class="d-block auth-logo">
                        <img src="{{ asset('/') }}{{ $logo }}" alt="" height="20" class="auth-logo-dark mx-auto">
                        <img src="{{ asset('/') }}{{ $logo }}" alt="" height="20" class="auth-logo-light mx-auto">
                    </a>
                    <p class="mt-3">{{ $ins_name }}</p>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body">

                        <div class="p-2">
                            <div class="text-center">

                                <div class="avatar-md mx-auto">
                                    <div class="avatar-title rounded-circle bg-light">
                                        <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <div class="p-2 mt-4">
                                    @include('flash_message')
                                    <h4>Verify your email</h4>
                                    <p>We have sent you verification email <span class="fw-semibold">{{ $user }}</span>, Please check it</p>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Did't receive an email ? <a href="{{ route('admin.recovery_password') }}" class="fw-medium text-primary"> Resend </a> </p>
                    <p>© <script>
                            document.write(new Date().getFullYear())
                        </script>{{ $ins_name }}. Design by Resnova Tech Limited</p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="{{ asset('/') }}public/new_admin/assets/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/node-waves/waves.min.js"></script>
<!-- App js -->
<script src="{{ asset('/') }}public/new_admin/assets/js/app.js"></script>
</body>
