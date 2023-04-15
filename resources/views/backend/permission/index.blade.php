@extends('backend.master.master')

@section('title')
Permission  List | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Permission List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Permission</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Permission Info</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">

                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>



                                        @if (Auth::guard('admin')->user()->can('permission.create'))

 <a href="{{ route('admin.permission.create') }}" type="button"  class="btn btn-raised btn-primary waves-effect  btn-sm " ><i class="ri-add-line align-bottom me-1"></i> Add New Permission</a>
                                                                            @endif


                                    </div>
                                </div>

                            </div>

                </div>
                </div>
            </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('flash_message')
                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                            <thead class="table-light">
                                            <tr>
                                               <th>Sl</th>
                                    <th>Group Name</th>
                                    <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                         @foreach ($pers as $permission)

                               <tr>
                                <td>




{{ $loop->index+1 }}







                                </td>
                                <td>{{ $permission->group_name}}</td>
                                    <td>
                                      @if (Auth::guard('admin')->user()->can('admin.view'))
                                          <a  type="button" class="btn btn-primary waves-light waves-effect  btn-sm" href="{{ route('admin.permission.view', $permission->group_name) }}"><i class="ri-eye-fill"></i></a>
@endif


                                    </td>
                                </tr>
@endforeach


                                        </tbody>
                                    </table>
</div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->



    </div>

        </div>

@endsection

@section('script')

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
            text: "You will not be able to revert this!",
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

















