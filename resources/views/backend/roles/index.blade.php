@extends('backend.master.master')

@section('title')
Role List | {{ $ins_name }}
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
                    <h4 class="mb-sm-0">Role List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Role</li>
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
                        <h4 class="card-title mb-0">Role Info</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">

                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>



                                        @if (Auth::guard('admin')->user()->can('role.create'))

 <a href="{{ route('admin.roles.create') }}" type="button"  class="btn btn-raised btn-primary waves-effect  btn-sm " ><i class="ri-add-line align-bottom me-1"></i> Add New Role</a>
                                                                            @endif


                                    </div>
                                </div>

                            </div>


                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>

                                        <th>sl</th>
                                        <th>Role Name</th>
                                        <th >Permission List</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @foreach ($roles as $role)

                                    <tr>
                                       <td>

                                        {{ $loop->index+1 }}

                                        <td>{{ $role->name }}</td>
                                        <td >



                                            @foreach ($role->permissions as $key=>$perm)


                                            @if(($key+1) == 6)
                                                {{ $perm->name }},<br>

                                                @elseif(($key+1) == 12)
                                                {{ $perm->name }},<br>
                                                @elseif(($key+1) == 18)
                                                {{ $perm->name }},<br>
                                                @elseif(($key+1) == 24)

                                                {{ $perm->name }},<br>
                                                @elseif(($key+1) == 30)
                                                {{ $perm->name }},<br>

                                                @elseif(($key+1) == 36)
                                                {{ $perm->name }},<br>

                                                @elseif(($key+1) == 42)
                                                {{ $perm->name }},<br>

                                                @elseif(($key+1) == 48)
                                                {{ $perm->name }},<br>

                                                @elseif(($key+1) == 54)
                                                {{ $perm->name }},<br>

                                                @elseif(($key+1) == 60)
                                                {{ $perm->name }},<br>

                                                @else
                                                {{ $perm->name }},
                                                @endif


                                            @endforeach

                                        </td>

                                                    <td>


    @if (Auth::guard('admin')->user()->can('admin.edit'))

                                                            <a href="{{ route('admin.roles.edit',$role->id) }}" type="button" class="btn-sm btn btn-primary waves-light waves-effect"><i class="ri-pencil-fill"></i></a>
    @endif
    @if (Auth::guard('admin')->user()->can('admin.delete'))


    @if($role->id == 3)


    @else

                                                            <button type="button" class="btn-sm btn btn-danger waves-light waves-effect" onclick="deleteTag({{ $role->id }})"><i class="ri-delete-bin-5-fill"></i></button>

     <form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.delete',$role->id) }}" method="POST" style="display: none;">
      @method('DELETE')
                                                        @csrf

                                                    </form>
                                                    @endif
                                                    @endif

                                                    </td>
                                                </tr>
                                              @endforeach


                                            </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
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












