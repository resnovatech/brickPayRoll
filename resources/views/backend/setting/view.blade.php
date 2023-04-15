@extends('backend.master.master')

@section('title')
Profile | {{ $ins_name }}
@endsection


@section('body')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Admin Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Information</a></li>

                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


                    <div class="row">

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                 @if(!empty(Auth::guard('admin')->user()->image))
                                  <img class=" mx-auto d-block" src="{{asset('/')}}{{ Auth::guard('admin')->user()->image }}" alt="" width="60%">

                                 @else
                                    <img class=" mx-auto d-block" src="{{ asset('/') }}public/admin/assets/images/users/user-8.jpg" alt="" width="60%">
                                @endif
                                </div>
                            </div>
                        </div> <!-- end col -->

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">


                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">

                                            <tbody>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>{{  Auth::guard('admin')->user()->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td>{{  Auth::guard('admin')->user()->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone:</td>
                                                    <td>{{  Auth::guard('admin')->user()->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Position:</td>
                                                    <td>{{  Auth::guard('admin')->user()->position }}</td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>


                                </div>

                            </div>
                        </div>


                    </div> <!-- end row -->

    </div>

</div>
@endsection
