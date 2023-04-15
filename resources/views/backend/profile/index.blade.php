@extends('backend.master.master')
@section('title')
Profile | {{ $ins_name }}
@endsection


@section('body')

<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Admin
                <small class="text-muted">Welcome to Admin Panel</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">


        <div class="row clearfix mt-5">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#home_with_icon_title"> <i class="material-icons">home</i> HOME </a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile_with_icon_title"><i class="material-icons">person</i>Update Profile </a></li>

                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#settings_with_icon_title"><i class="material-icons">settings</i>Update Password </a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane in" id="home_with_icon_title">
                               <div class="container">
                                          <div class="row">
                                            <div class="col-md-4">
                                              <div class="card card-bordered">
                                                @if(Auth::guard('admin')->user()->image == NUll)
                                <img class="card-img-top img-fluid" src="{{asset('/')}}public/admin/assets/images/xs/avatar1.jpg" alt="image">
                              @else
<img class="card-img-top img-fluid" src="{{asset('/')}}{{ Auth::guard('admin')->user()->image }}" alt="image">
                              @endif
                            </div>
                                            </div>
                                            <div class="col-md-8">
                                              <div class="card card-bordered">
                                        <div class="card-header bg-info">
                                          <center class="text-white">Personal Info</center>
                                        </div>
                                <div class="card-body">
                                    <h5 class="title"><i class="ti-user"></i><span style="padding-left:10px;">{{ Auth::guard('admin')->user()->name }}</span></h5>

                                    <h5 class="title"><i class="ti-email"></i><span style="padding-left:10px;">{{ Auth::guard('admin')->user()->email }}</span></h5>


                                </div>
                            </div>
                                            </div>
                                          </div>
                                        </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile_with_icon_title">

@if (Auth::guard('admin')->user()->can('profile.edit'))

                                <form action="{{ url('/') }}/admin/profile/update/{{ Auth::guard('admin')->user()->id  }}" method="POST" enctype="multipart/form-data">
                      @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-sm" value="{{ Auth::guard('admin')->user()->name }}"  name="name" placeholder="Enter a  Name">
                        </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control form-control-sm"  name="email" placeholder="Enter a  Email" value="{{ Auth::guard('admin')->user()->email}}">
                        </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                            <label for="name">Profile Photo</label>
                            <input type="file" class="form-control form-control-sm"  name="image" placeholder="Enter a  Image">
                        </div>
                            </div>
                        </div>

<div class="input_field_wrapper">

                               </div>


                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                    </form>

                    @endif
                            </div>

                            <div role="tabpanel" class="tab-pane active" id="settings_with_icon_title">

@if (Auth::guard('admin')->user()->can('profile.edit'))

                             <form method="POST" action="{{ route('admin.password.update') }}" class="form-horizontal">
                                    @csrf

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control form-control-sm-label">
                                            <label for="old_password">Old Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="old_password" class="form-control form-control-sm" placeholder="Enter your old password" name="old_password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control form-control-sm-label">
                                            <label for="password">New Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="password" class="form-control form-control-sm" placeholder="Enter your new password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control form-control-sm-label">
                                            <label for="confirm_password">Confirm Password : </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="confirm_password" class="form-control form-control-sm" placeholder="Enter your new password again" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect  btn-sm">UPDATE</button>
                                        </div>
                                    </div>
                                </form>

                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
     <script>
         /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
         }
     </script>

      <script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
