<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title> Reset Password</title>

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
                                    <h5 class="text-primary"> Reset Password</h5>
                                    <p>Re-Password with {{ $ins_name }}.</p>
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
                            <div class="alert alert-success text-center mb-4" role="alert">
                                Enter your Email and instructions will be sent to you!
                            </div>
                            @include('flash_message')
                            <form class="form-horizontal" method="POST" action="{{ route('send_mail_get_from_list') }}">
@csrf
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="useremail" id="useremail" placeholder="Enter email">
                                </div>
<small class="text-danger" id="main_content_table"></small>
                                <div class="text-end">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit" id="final_reset_button">Reset</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Remember It ? <a href="{{ route('admin.login') }}" class="fw-medium text-primary"> Sign In here</a> </p>
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

<script>
    $(document).ready(function(){

        $("input").keyup(function(){

            var type_email = $(this).val();

            $.ajax({
            url: "{{ route('check_mail_from_list') }}",
            method: 'GET',
            data: {type_email:type_email},
            success: function(data) {
            //   $("#main_content_table").html('');

            if(type_email == data){

                $("#main_content_table").html('');

                $('#final_reset_button').prop('disabled', false);

            }else{

                $("#main_content_table").html('You Have Typed Wrong Email');
                $('#final_reset_button').prop('disabled', true);

            }

            }
        });

        });
    });
    </script>
</body>
