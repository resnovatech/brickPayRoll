@extends('backend.master.master')
@section('title')
Setting | {{ $ins_name }}
@stop
@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Profile</a></li>

                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
<div class="row">
<div class="col-xl-12">

    <div class="card">
        <div class="card-body">

            {{-- <h4 class="card-title">Edit Profile</h4> --}}


            <!-- Nav tabs -->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#navpills-home" role="tab" aria-selected="false">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">About Setting</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#navpills-profile" role="tab" aria-selected="false">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Password Setting</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="navpills-home" role="tabpanel">
                    <p class="mb-0">
                        <form method="POST" action="{{ url('/') }}/admin/profile/update/{{ Auth::guard('admin')->user()->id  }}" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                           {{ method_field('PUT') }}
                            <div class="row clearfix mt-2">

                                    <label for="name"> Name: </label>

                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" class="form-control form-control-sm" placeholder="Enter your name" name="name" value="{{  Auth::guard('admin')->user()->name }}">
                                          <input type="hidden" class="form-control form-control-sm" name="id" value="{{  Auth::guard('admin')->user()->id }}" placeholder="Post Title">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix mt-2">

                                    <label for="email_address_2">Email</label>

                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email_address_2" class="form-control form-control-sm" placeholder="Enter your email address" name="email" value="{{  Auth::guard('admin')->user()->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix mt-2">

                                    <label for="email_address_2">Phone</label>

                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email_address_2" class="form-control form-control-sm" placeholder="Enter your phone" name="phone" value="{{  Auth::guard('admin')->user()->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row clearfix mt-2">

                                <label for="email_address_2">Position</label>

                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address_2" class="form-control form-control-sm" placeholder="Enter your position" name="position" value="{{  Auth::guard('admin')->user()->position }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                            <div class="row clearfix mt-2">

                                    <label for="email_address_2">Profile Image: </label>

                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                         <div class="row clearfix mt-2">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect  btn-sm">Update</button>
                                </div>
                            </div>
                        </form>
                    </p>
                </div>
                <div class="tab-pane" id="navpills-profile" role="tabpanel">
                    <p class="mb-0">
                        <form method="POST" action="{{ route('admin.password.update') }}" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix mt-2">

                                    <label for="old_password">Old Password: </label>

                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="old_password" class="form-control form-control-sm" placeholder="Enter your old password" name="old_password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix mt-2">

                                    <label for="password">New Password: </label>

                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" class="form-control form-control-sm" placeholder="Enter your new password" name="password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix mt-2">

                                    <label for="confirm_password">Confirm Password: </label>

                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="confirm_password" class="form-control form-control-sm" placeholder="Enter your new password again" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row clearfix mt-2">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect  btn-sm">Update</button>
                                </div>
                            </div>
                        </form>
                    </p>
                </div>

            </div>

        </div>
    </div>


</div>
</div>
</div>
</div>
@stop
