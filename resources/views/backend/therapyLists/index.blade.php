@extends('backend.master.master')

@section('title')
Therapy List | {{ $ins_name }}
@endsection


@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Therapy List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Therapy List</li>
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
                        <h4 class="card-title mb-0">Therapy Info</h4>
                        @include('flash_message')
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#myModal"><i class="ri-add-line align-bottom me-1"></i> Add New Therapy Info </button>

                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">Sl</th>
                                        <th class="sort" data-sort="customer_name"> Name</th>
                                        <th class="sort" data-sort="customer_name"> Amount</th>
                                        <th class="sort" data-sort="customer_name"> Ingredient</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                        @foreach($therapyLists as $key=>$allTherapyLists)
                                    <tr>

                                        <td class="id">{{ $key+1 }}</td>
                                        <td class="customer_name">{{ $allTherapyLists->name }}</td>

                                        <td class="customer_name">{{ $allTherapyLists->amount }}</td>
                                        <td>
                                          <?php    $allTherapyLists->therapyDetails  ?>

                                          @foreach($allTherapyLists->therapyDetails as $allTherapyIngredient)





                                                      <?php

                                                    $getFinalName = DB::table('therapy_ingredients')->where('id',$allTherapyIngredient->therapy_ingredient_id )->value('name');

                                                      ?>

{{ $getFinalName  }} - {{ $allTherapyIngredient->quantity }} {{ $allTherapyIngredient->unit }}<br>



                                          @endforeach

                                        </td>


                                        <td>



                                            @if (Auth::guard('admin')->user()->can('therapyIngredientsUpdate'))
                                            <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $allTherapyLists->id }}"
                                            class="btn btn-primary waves-light waves-effect  btn-sm" >
                                            <i class="ri-pencil-fill"></i></button>

                                              <!--  Large modal example -->
                                              <div class="modal fade bs-example-modal-lg{{ $allTherapyLists->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="myLargeModalLabel">Update Therapy  Info</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                              </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form action="{{ route('therapyLists.update',$allTherapyLists->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Name</label>
                                                                        <input type="text" value="{{ $allTherapyLists->name }}" name ="name" class="form-control" id="" placeholder="Name" required>
                                                                    </div>


                                                                    <div class="col-12 mb-2">
                                                                        <label for="" class="form-label">Amount</label>
                                                                        <input type="text" value="{{ $allTherapyLists->amount }}" name ="amount" class="form-control" id="" placeholder="Amount" required>
                                                                    </div>



                                                                    <div class="col-12">
                                                                        <table class="table table-bordered" id="dynamicAddRemove">
                                                                            <tr>
                                                                                <th>Therapy Ingredient</th>
                                                                                <th>Quantity</th>
                                                                                <th>Unit</th>
                                                                            </tr>
                                                                            @foreach($allTherapyLists->therapyDetails as $key=>$allTherapyIngredient)
                                                                            @if($key+1 == 1)
                                                                            <tr>
                                                                                <td>
                                                                                    <select class="form-select mb-3" name="therapy_ingredient_id[]" aria-label="Default select example">
                                                                                        @foreach($therapyIngredients as $allTherapyIngredients)
                                                                                        <option value="{{ $allTherapyIngredients->id }}"  {{ $allTherapyIngredient->therapy_ingredient_id ==  $allTherapyIngredients->id ? 'selected':'' }}>{{ $allTherapyIngredients->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="quantity[]"  value="{{ $allTherapyIngredient->quantity  }}"
                                                                                           class="form-control"/>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select mb-3" name="unit[]" aria-label="Default select example">
                                                                                        <option value="gram" {{ 'gram' ==  $allTherapyIngredient->unit ? 'selected':'' }}>gram</option>
                                                                                        <option value="milligram" {{ 'milligram' ==  $allTherapyIngredient->unit ? 'selected':'' }}>milligram</option>
                                                                                        <option value="liter" {{ 'liter' ==  $allTherapyIngredient->unit ? 'selected':'' }}>liter</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" name="add" id="dynamic-ar"
                                                                                            class="btn btn-outline-primary">Add New Therapy
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                            @else
                                                                            <tr>
                                                                                <td>
                                                                                    <select class="form-select mb-3" name="therapy_ingredient_id[]" aria-label="Default select example">
                                                                                        @foreach($therapyIngredients as $allTherapyIngredients)
                                                                                        <option value="{{ $allTherapyIngredients->id }}"  {{ $allTherapyIngredient->therapy_ingredient_id ==  $allTherapyIngredients->id ? 'selected':'' }}>{{ $allTherapyIngredients->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="quantity[]"  value="{{ $allTherapyIngredient->quantity  }}"
                                                                                           class="form-control"/>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select mb-3" name="unit[]" aria-label="Default select example">
                                                                                        <option value="gram" {{ 'gram' ==  $allTherapyIngredient->unit ? 'selected':'' }}>gram</option>
                                                                                        <option value="milligram" {{ 'milligram' ==  $allTherapyIngredient->unit ? 'selected':'' }}>milligram</option>
                                                                                        <option value="liter" {{ 'liter' ==  $allTherapyIngredient->unit ? 'selected':'' }}>liter</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                                                                                </td>
                                                                            </tr>
                                                                            @endif
                                                                            @endforeach
                                                                        </table>
                                                                    </div>



                                                                </div>
                                                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                                                            </form>
                                                          </div>
                                                      </div><!-- /.modal-content -->
                                                  </div><!-- /.modal-dialog -->
                                              </div><!-- /.modal -->


  @endif

  {{-- <button type="button" class="btn btn-primary waves-light waves-effect  btn-sm" onclick="window.location.href='{{ route('admin.users.view',$user->id) }}'"><i class="fa fa-eye"></i></button> --}}

                                    @if (Auth::guard('admin')->user()->can('therapyListsDelete'))

  <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $allTherapyLists->id}})" data-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
  <form id="delete-form-{{ $allTherapyLists->id }}" action="{{ route('therapyLists.destroy',$allTherapyLists->id) }}" method="POST" style="display: none;">
    @method('DELETE')
                                  @csrf

                              </form>
                                                  @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>


                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->

<!-- Default Modals -->
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Therapy Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('therapyLists.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name ="name" class="form-control" id="" placeholder="Name" required>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Amount</label>
                            <input type="text"  name ="amount" class="form-control" id="" placeholder="Amount" required>
                        </div>

                        <div class="col-12">
                            <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <th>Therapy Ingredient</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-select mb-3" name="therapy_ingredient_id[]" aria-label="Default select example">
                                            @foreach($therapyIngredients as $allTherapyIngredients)
                                            <option value="{{ $allTherapyIngredients->id }}">{{ $allTherapyIngredients->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="quantity[]" value=""
                                               class="form-control"/>
                                    </td>
                                    <td>
                                        <select class="form-select mb-3" name="unit[]" aria-label="Default select example">
                                            <option value="gram">gram</option>
                                            <option value="milligram">milligram</option>
                                            <option value="liter">liter</option>
                                        </select>
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
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@section('script')
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr>' +
            '<td>' +
            ' <select class="form-select mb-3" name="therapy_ingredient_id[]" aria-label="Default select example">' +
            '@foreach($therapyIngredients as $allTherapyIngredients)<option value="{{ $allTherapyIngredients->id }}">{{ $allTherapyIngredients->name }}</option>@endforeach</select>' +
            '</td>' +
            '<td>' +
            '<input type="text" name="quantity[]"  class="form-control" /></td>' +
            '<td>' +
            ' <select class="form-select mb-3" name="unit[]" aria-label="Default select example">' +
            ' <option value="gram">gram</option><option value="milligram">milligram</option><option value="liter">liter</option></select>' +
            '</td>' +
            '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
