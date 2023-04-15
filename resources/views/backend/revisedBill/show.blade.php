@extends('backend.master.master')
@section('title')
Billing Information List | {{ $ins_name }}
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
                    <h4 class="mb-sm-0">Billing List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Billing</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xxl-12">
                <div class="card" >
                    <div class="card-body" >
                        <div class="btn-group">
                            <a href="{{ route('printInvoice',$patientHistory->id) }}" class="btn btn-primary">Print</a>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Payment</button>

                            <!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('paymentMoney') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                @csrf

                <label for="" class="form-label">Payment type</label>
                <select class="form-control" name="payment_type" id="payment_type" required>
                    <option value="cash">cash</option>
                    <option value="check">check</option>
                </select>

                <label for="" class="form-label">Amount</label>
                <input type="number" class="form-control" name="amount" id="" value="" >
                <input type="hidden" class="form-control" name="id" id="" value="{{ $patientHistory->id }}" >

                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>

      </div>
    </div>
  </div>
  <a href ="{{ route('medicineList',$patientHistory->id) }}" class="btn btn-info">Medicine List</a>
                            <a href ="{{ route('therapyListFromHistory',$patientHistory->id) }}" class="btn btn-info">Therapy List</a>
                          </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <img src="{{ asset('/') }}{{ $logo }}" class="card-logo card-logo-dark" alt="logo dark" height="17">
                                        <img src="{{ asset('/') }}{{ $logo }}" class="card-logo card-logo-light" alt="logo light" height="17">



                                        <div class="mt-sm-5 mt-4">
                                            <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                            @if(empty($getPhoneFromWalkByPatient))
                                            <p class="text-muted mb-1" id="address-details">{{ $getPhoneFromPatient }}</p>
                                            @else
                                            <p class="text-muted mb-1" id="address-details">{{ $getPhoneFromWalkByPatient }}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            @include('flash_message')
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    {{-- <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                        <h5 class="fs-14 mb-0">#VL<span id="invoice-no">25000355</span></h5>
                                    </div> --}}
                                    <!--end col-->
                                    <div class="col-lg-4 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $patientHistory->created_at->format('d F Y') }}</span></h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                        <span class="badge badge-soft-success fs-11" id="payment-status">

                                            @if($getAllPaymentHistoryAmount == ($totalPatientMedicalSupplementAmount + $totalMedicineAmount + $totalTherapyAmount) )
Paid
                                            @else

                                            Unpaid

                                            @endif

                                        </span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                        <h5 class="fs-14 mb-0">৳ <span id="total-amount">{{ $totalPatientMedicalSupplementAmount + $totalMedicineAmount + $totalTherapyAmount }}</span></h5>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4 border-top border-top-dashed">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                        <p class="fw-medium mb-2" id="billing-name">

                                            @if(empty($getNameFromWalkByPatient))

{{ $getNameFromPatient }}
                                            @else
                                            {{ $getNameFromWalkByPatient }}
                                            @endif

                                        </p>
                                        @if(empty($getPhoneFromWalkByPatient))
                                            <p class="text-muted mb-1" id="address-details">{{ $getPhoneFromPatient }}</p>
                                            @else
                                            <p class="text-muted mb-1" id="address-details">{{ $getPhoneFromWalkByPatient }}</p>
                                            @endif
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <form action="{{ route('revisedBillings.index') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                    @csrf
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                        <tr class="table-active">

                                            <th scope="col">Product Details</th>
                                            <th scope="col">Category</th>
                                           
                                            <th scope="col">Rate</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col" class="text-end">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            @foreach($patientTherapyList as $key=>$allPatientTherapyList)

                                            <?php
$getTherapyPrice = DB::table('therapy_lists')->where('name',$allPatientTherapyList->name)->value('amount');

                                              ?>
                                        <tr>

                                            <td class="text-start">
                                                <span class="fw-medium">{{ $allPatientTherapyList->name }}</span>

                                            </td>
                                             <td>Therapy</td>
                                            <td>৳ {{ $getTherapyPrice }}</td>
                                            <td>
                                  <input type="hidden" name="therapy_id[]" value="{{ $allPatientTherapyList->id }}" />
                                  <input type="text" class="form-control" name="therapy_amount[]" value="{{ $allPatientTherapyList->amount }}" />



                                            </td>
                                            <td class="text-end">৳ {{ $allPatientTherapyList->amount*$getTherapyPrice }}</td>
                                        </tr>
                                        @endforeach
                                        <?php

                                        $countData = count($patientTherapyList)

                                        ?>

                                        @foreach($patientHerb as $allPatientHerbList)
                                        <?php
$getPatientHerb = DB::table('medicines')->where('name',$allPatientHerbList->name)->value('amount');
                                        ?>
                                        <tr>

                                            <td class="text-start">
                                                <span class="fw-medium">{{ $allPatientHerbList->name }}</span>

                                            </td>
                                             <td>Medicine</td>
                                            <td>৳ {{ $getPatientHerb }}</td>
                                            <td>
                                                <input type="hidden" name="herb_id[]" value="{{ $allPatientHerbList->id }}" />
                                                <input type="text" class="form-control" name="herb_amount[]" value="{{ $allPatientHerbList->how_many_dose }}" />




                                            </td>
                                            <td class="text-end">৳ {{ $allPatientHerbList->how_many_dose*$getPatientHerb }}</td>
                                        </tr>
                                        @endforeach

                                        @foreach($patientMedicalSupplement as $allPatientMedicalSupplement)

                                        <?php
$getPatientMedicalSupplement =DB::table('health_supplements')->where('name',$allPatientMedicalSupplement->name)->value('amount');
                                        ?>
                                        <tr>

                                            <td class="text-start">
                                                <span class="fw-medium">{{ $allPatientMedicalSupplement->name }}</span>

                                            </td>
                                             <td>Health Suppliment</td>
                                            <td>৳ {{ $getPatientMedicalSupplement }}</td>


                                                <td>
                                                    <input type="hidden" name="suppliment_id[]" value="{{ $allPatientMedicalSupplement->id }}" />
                                                    <input type="text" class="form-control" name="suppliment_amount[]" value="{{ $allPatientMedicalSupplement->quantity }}" />




                                                </td>





                                            <td class="text-end">৳ {{ $getPatientMedicalSupplement*$allPatientMedicalSupplement->quantity  }}</td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table><!--end table-->
                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                </form>
                                <div class="border-top border-top-dashed mt-2">
                                    <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                        <tbody>
                                        <tr>
                                            <td>Total</td>
                                            <td class="text-end">৳ {{ $totalPatientMedicalSupplementAmount + $totalMedicineAmount + $totalTherapyAmount }}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>

                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                    {{-- <a href="javascript:window.print()" class="btn btn-soft-primary"><i class="ri-printer-line align-bottom me-1"></i> Print</a> --}}

                                </div>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-xxl-12">
                <div class="card" >
                    <div class="card-header" >
                        Payment history
                    </div>
                    <div class="card-body" >
                        <div class="table-responsive">
                            <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                <thead>
                                <tr class="table-active">

                                    <th scope="col">SL</th>
                                    <th scope="col">Payment type</th>
                                    <th scope="col">Payment Cash</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($getAllPaymentHistory as $key=>$allGetAllPaymentHistory)
                                    <tr>
                                        <th>{{ $key+1 }}</th>
<th>{{ $allGetAllPaymentHistory->payment_type }}</th>
<th>{{ $allGetAllPaymentHistory->payment_amount }}</th>
<th>{{ $allGetAllPaymentHistory->created_at->format('d F Y') }}</th>
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
    <!-- container-fluid -->
</div>
@endsection


@section('script')

@endsection
