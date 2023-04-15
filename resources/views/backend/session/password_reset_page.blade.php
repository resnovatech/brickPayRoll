<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title>Password Reset Page</title>

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
                    <p class="mt-3">Password Reset Page</p>
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

                                    <h4>Your email <b>{{ $user->email }}</b></h4>
                                    <p class="mb-2">Please enter the new password</p>

                                    <form method="POST" action="{{ route('password_change_confirmed') }}">
                                        @csrf
                                        <input type="hidden" id="id" name="id" value="{{ $user->id }}" class="form-control form-control-lg text-center" >
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="digit1-input" class="visually-hidden"> Password</label>
                                                    <input type="password" id="password" name="password" class="form-control form-control-lg text-center" >

                                                    <small id="password_result" class="text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="digit1-input" class="visually-hidden">Confirm Password</label>
                                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg text-center" >

                                                    <small id="confirm_password_result" class="text-danger"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"  class="btn btn-success w-md" id="final_reset_button">Confirm</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>{{ $ins_name }}. Design by Resnova Tech Limited
                    </p>
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
<!-- two-step-verification js -->
<script src="{{ asset('/') }}public/new_admin/assets/js/pages/two-step-verification.init.js"></script>

<!-- App js -->
<script src="{{ asset('/') }}public/new_admin/assets/js/app.js"></script>

<script>

$(document).ready(function(){

$("#password").keyup(function(){

    var count_password = $(this).val().length;

    //alert(count_password);

    if(count_password < 5){

        $("#password_result").html('Password Must Be At Least 5 digit');

$('#final_reset_button').prop('disabled', true);

}else{

$("#password_result").html('');
$('#final_reset_button').prop('disabled', false);

}


});

/// check password with confirm password
$("#confirm_password").keyup(function(){

    var password = parseInt($('#password').val());
    var confirm_password = parseInt($(this).val());

//alert(password);
    if(password != confirm_password){

$("#confirm_password_result").html('Password And Confirm Password Did Not Matched');

$('#final_reset_button').prop('disabled', true);

}else{

$("#confirm_password_result").html('');
$('#final_reset_button').prop('disabled', false);

}

    });
});
</script>

</body>

</html>
