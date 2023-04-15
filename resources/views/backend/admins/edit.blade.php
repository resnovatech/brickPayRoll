@extends('admin.master.master')

@section('title')
{{ trans('ward.UpdateWardAdmin')}}|{{ $ins_name }}
@endsection


@section('body')

<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title-box">
                                <h4 class="font-size-18">{{ trans('ward.wardadmin')}}</h4>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="index.php">{{ trans('message.sakho')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">{{ trans('ward.wardadminlist')}}</a></li>
                                    <li class="breadcrumb-item"><a href="#">{{ trans('ward.UpdateWardAdmin')}}</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                              <form action="{{ route('admin.users.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">{{ trans('message.name')}}</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name" value="{{ $user->name }}">

                <input type="hidden" class="form-control form-control-sm" id="name" name="id" placeholder="Enter Name" value="{{ $user->id }}">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="email">{{ trans('ward.Email')}}</label>
                                <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                            </div>
                             <div class="form-group col-md-4 col-sm-12">
                                <label for="email">{{ trans('ward.Phone')}}</label>
                                <input type="text" class="form-control form-control-sm" id="email" name="phone" placeholder="Enter Phone" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">{{ trans('message.password')}}</label>
                                <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Enter Password" value="{{ $user->password }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">{{ trans('ward.confirmpassword')}}</label>
                                <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Enter Password" value="{{ $user->password }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">{{ trans('ward.assignrolls')}}</label>
                                <select name="roles[]" id="roles" class="form-control form-control-sm" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">{{ trans('ward.profileimage')}}</label>
                                <input type="file" class="form-control form-control-sm" id="password_confirmation" name="image" placeholder="Enter Image">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ trans('message.update')}}</button>
                    </form>

                                    </div>

                                </div>
                            </div>







                        </div> <!-- end col -->




                </div> <!-- container-fluid -->
            </div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
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
            implementAllChecked();
         }
         function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);
            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
         }

</script>

@endsection

















