<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title>Session Timeout screen</title>

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
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Session Timeout screen</h5>
                                    <p>Enter your password to unlock the screen!</p>
                                    @include('flash_message')
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ asset('/') }}public/new_admin/assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <a href="#">
                                <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('/') }}public/new_admin/assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                        </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
<?php

   $name = DB::table('admins')->where('email',$lock_email)->value('name');
   $image = DB::table('admins')->where('email',$lock_email)->value('image');

    ?>
                            <form method="POST" action="{{route('admin.login_from_session')}}">
@csrf
                                <div class="user-thumb text-center mb-4">
                                    @if($image == NUll)
                                    <img src="{{ asset('/') }}public/admin/assets/images/users/avatar-2.jpg" class="rounded-circle img-thumbnail avatar-md" alt="thumbnail">
@else
<img src="{{asset('/')}}{{ $image }}" class="rounded-circle img-thumbnail avatar-md" alt="thumbnail">
@endif

                                    <h5 class="font-size-15 mt-3">{{ $name }}</h5>
                                </div>

                                <div class="mb-3">
                                    <label for="userpassword">Password</label>
                                    <input type="hidden" class="form-control" name="main_url" value="{{ $main_url }}" id="email" placeholder="Enter password">
                                    <input type="hidden" class="form-control" name="email" value="{{ $lock_email }}" id="email" placeholder="Enter password">
                                    <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Unlock</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Not you ? return <a href="{{ route('admin.login') }}" class="fw-medium text-primary"> Sign In </a> </p>
                    <p>© <script>
                            document.write(new Date().getFullYear())
                        </script> {{ $ins_name }}. Design by Resnova Tech Limited</p>
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

</html>
