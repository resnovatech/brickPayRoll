@extends('backend.master.master')

@section('title')
Doctor Profile | {{ $ins_name }}
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
                    <h4 class="mb-sm-0">Doctor Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Information</a></li>
                            <li class="breadcrumb-item active">Doctor</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection



@section('script')

@endsection
