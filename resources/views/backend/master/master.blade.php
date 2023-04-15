<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $ins_name }}" />
	<meta property="og:title" content="{{ $ins_name }}" />
	<meta property="og:description" content="{{ $ins_name }}" />
	<meta property="og:image" content="{{ asset('/') }}{{ $logo }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/') }}{{ $icon }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/') }}{{ $icon }}" type="image/x-icon">
    <title>@yield('title')</title>


        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- jsvectormap css -->
    <link href="{{ asset('/') }}public/new_admin/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ asset('/') }}public/new_admin/assets/libs/gridjs/theme/mermaid.min.css">

    <!-- Layout config Js -->
    <script src="{{ asset('/') }}public/new_admin/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('/') }}public/new_admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/') }}public/new_admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/') }}public/new_admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('/') }}public/new_admin/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <style>

        .swal2-confirm{

            margin-left:10px;
        }

        #buttons-datatables_filter{

            width: 400px;
        }

        </style>
        @yield('css')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <link rel="stylesheet" href="https://parsleyjs.org/src/parsley.css">

<script src="{{ asset('/')}}public/new_admin/parsely1.js"></script>

<style>

    .parsley-required{

        margin-top:10px;
    }

    .box

    {

     width:100%;

     max-width:600px;

     background-color:#f9f9f9;

     border:1px solid #ccc;

     border-radius:5px;

     padding:16px;

     margin:0 auto;

    }

    input.parsley-success,

    select.parsley-success,

    textarea.parsley-success {

      color: #468847;

      background-color: #DFF0D8;

      border: 1px solid #D6E9C6;

    }

    input.parsley-error,

    select.parsley-error,

    textarea.parsley-error {

      color: #B94A48;

      background-color: #F2DEDE;

      border: 1px solid #EED3D7;

    }


    .parsley-errors-list {

      margin: 2px 0 3px;

      padding: 0;

      list-style-type: none;

      font-size: 0.9em;

      line-height: 0.9em;

      opacity: 0;


      transition: all .3s ease-in;

      -o-transition: all .3s ease-in;

      -moz-transition: all .3s ease-in;

      -webkit-transition: all .3s ease-in;

    }


    .parsley-errors-list.filled {

      opacity: 1;

    }



    .error,.parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{

     color:#ff0000;

    }



    </style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">



    @include('backend.include.sidebar')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

       @yield('body')
        <!-- End Page-content -->


        @include('backend.include.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->

@include('backend.include.back_to_top')

<!-- JAVASCRIPT -->



<script src="{{ asset('/') }}public/new_admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/node-waves/waves.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/feather-icons/feather.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
{{-- <script src="{{ asset('/') }}public/new_admin/assets/js/plugins.js"></script> --}}

<!-- apexcharts -->
<script src="{{ asset('/') }}public/new_admin/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="{{ asset('/') }}public/new_admin/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="{{ asset('/') }}public/new_admin/assets/libs/jsvectormap/maps/world-merc.js"></script>

<!-- gridjs js -->
<script src="{{ asset('/') }}public/new_admin/assets/libs/gridjs/gridjs.umd.js"></script>

<!-- Dashboard init -->
<script src="{{ asset('/') }}public/new_admin/assets/js/pages/dashboard-job.init.js"></script>


  <!--datatable js-->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

  <script src="{{ asset('/') }}public/new_admin/assets/js/pages/datatables.init.js"></script>

<!-- App js -->
<script src="{{ asset('/') }}public/new_admin/assets/js/app.js"></script>

<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@yield('script')
</body>

</html>
















