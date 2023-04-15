@extends('backend.master.master')
@section('title')
DOCTOR PRESCRIPTION | {{ $ins_name }}
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
                    <h4 class="mb-sm-0">Doctor Prescription</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Doctor Prescription Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!--end row-->
        <form action="{{ route('postPatientPrescriptionInfo') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
            @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Patient History
                    </div>
                    <div class="card-body">

                            <label for="">Patient History</label>
                            <input type="file"  class="form-control" name="history_file" required>
                            <input type="hidden"  class="form-control" value="{{ $doctor_appoinment }}" name="appoinment_id">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Therapy Add</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <p class="text-muted">Add Therapy</p>

                            <table class="table table-bordered" id="dynamicAddRemove1">
                                <tr>
                                    <th>Name</th>
                                    <th>How many amount they take</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-select mb-3" name="name[]" aria-label="Default select example" required>
                                            <option>--- Please Select ---</option>
                                            @foreach($therapyLists as $allTherapyLists)
                                            <option value="{{ $allTherapyLists->name }}">{{ $allTherapyLists->name }}</option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="amount[]" value=""
                                               class="form-control" required/>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="dynamic-ar1"
                                                class="btn btn-outline-primary">Add New Therapy
                                        </button>
                                    </td>
                                </tr>
                            </table>


                        <!--end col-->
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Herbs Add</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <p class="text-muted">Add Herbs</p>

                            <table class="table table-bordered" id="dynamicAddRemove2">
                                <tr>
                                    <th>Name</th>
                                    <th>Parts of day</th>
                                    <th>How Many Dose</th>
                                    <th>when</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select required class="form-select mb-3" aria-label="Default select example" name="herb_name[]">
                                            <option>--- Please Select ---</option>
                                            @foreach($medicineLists as $allMedicineLists)
                                            <option value="{{ $allMedicineLists->name }}">{{ $allMedicineLists->name }}</option>
                                             @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select required class="form-control" name="part_of_the_day[]" >
                                            <option value="Morning">Morning</option>
                                            <option value="Noon">Noon</option>
                                            <option value="Evening">Evening</option>
                                            <option value="Night">Night</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" required class="form-control" id="" name="how_many_dose[]">
                                    </td>
                                    <td>
                                        <select class="form-select mb-3" required  aria-label="Default select example" name="main_time[]">
                                            <option value="After Food">After Food</option>
                                            <option value="Before Food">Before Food</option>
                                            <option value="With Food">With Food</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="dynamic-ar2"
                                                class="btn btn-outline-primary">Add New Medicine
                                        </button>
                                    </td>
                                </tr>
                            </table>


                        <!--end col-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Medical Supplement</h4>
                </div><!-- end card header -->
                <div class="card-body">


                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th>Supplement Name</th>
                                <th>Quantity</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="supplement_name[]" required class="form-select mb-3" aria-label="Default select example">
                                        <option>--- Please Select ---</option>
@foreach($healthSupplements as $allHealthSupplements)
                                        <option value="{{ $allHealthSupplements->name }}">{{ $allHealthSupplements->name }}</option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="quantity[]" required value=""
                                           class="form-control"/>
                                </td>
                                <td>
                                    <button type="button" name="add" id="dynamic-ar"
                                            class="btn btn-outline-primary">Add New Therapy
                                    </button>
                                </td>
                            </tr>
                        </table>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>


    <div class="text-end mb-3">
        <button type="submit" class="btn btn-primary w-sm">Submit
        </button>
    </div>
</form>
</div>
@endsection


@section('script')
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr>' +
            '<td>' +
            ' <select name="supplement_name[]" class="form-select mb-3" aria-label="Default select example" required>' +
            '@foreach($healthSupplements as $allHealthSupplements)<option value="{{ $allHealthSupplements->name }}">{{ $allHealthSupplements->name }}</option>@endforeach</select>' +
            '</td>' +
            '<td>' +
            '<input type="text" name="quantity[]" value="" class="form-control" required/></td>' +
            '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar1").click(function () {
        ++i;
        $("#dynamicAddRemove1").append('<tr>' +
            '<td>' +
            ' <select class="form-select mb-3" name="name[]" aria-label="Default select example" required>' +
            ' @foreach($therapyLists as $allTherapyLists)<option value="{{ $allTherapyLists->id }}">{{ $allTherapyLists->name }}</option>@endforeach</select>' +
            '</td>' +
            '<td>' +
            '<input type="text" name="amount[]" class="form-control" required /></td>' +
            '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar2").click(function () {
        ++i;
        $("#dynamicAddRemove2").append('<tr>' +
            '<td>' +
            ' <select class="form-select mb-3"  name="herb_name[]" required aria-label="Default select example">' +
            '@foreach($medicineLists as $allMedicineLists)<option value="{{ $allMedicineLists->name }}">{{ $allMedicineLists->name }}</option>@endforeach</select>' +
            '</td>' +
            '<td>'+
            '<select class="form-control" name="part_of_the_day[]" required >'+
            ' <option value="Morning">Morning</option><option value="Noon">Noon</option><option value="Evening">Evening</option><option value="Night">Night</option> </select>'+
            '</td>'+
            '<td>' +
            '<input type="text"  class="form-control" name="how_many_dose[]" required /></td>' +
            '<td>'+
            '<select class="form-select mb-3" name="main_time[]" required aria-label="Default select example">'+
            '   <option value="After Food">After Food</option><option value="Before Food">Before Food</option><option value="With Food">With Food</option></select>'+
            '</td>'+
            '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
