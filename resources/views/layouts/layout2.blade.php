<!doctype html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Validation | Morvin - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ asset('templet/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('templet/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('templet/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templet') }}/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templet') }}/assets/css/select2.min.css" rel="stylesheet" />

</head>


<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            {{-- style="background-color: #000; color: #fff;" --}}
            @include('layouts.component.topbar')
        </header>
        <div class="vertical-menu" style="z-index: 1040">

         @include('layouts.component.sidebar')
        </div>

        <!-- ========== Left Sidebar Start ========== -->
        {{-- @include('layouts.component.sidebar'); --}}
        <!-- Left Sidebar End -->

        <div class="main-content">
            <div class="page-content">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">

                            </div>
                            <div class="col-sm-6">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @yield('content')

            </div>


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © BG Haat.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by BG Group
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('templet/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templet/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templet/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('templet/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('templet/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('templet/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('templet/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('templet/assets/js/app.js') }}"></script>


    {{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
@yield('js')
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
{{-- for select2 --}}


<script src="{{asset('js')}}/select2.min.js"></script>

<script>
    function numberInputTracking(id){
        // data = document.getElementById(id).value;
        // document.getElementById(id).value = data.replace(/^\s+|\s+$/gm,'');
         if(document.getElementById(id).value<1 && document.getElementById(id).value != ""){
            document.getElementById(id).value = 1;
         }
    }
</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function Warning(title, message){
        Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
       // showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        // confirmButtonText: 'Yes, delete it!'
        // }).then((result) => {
        // if (result.isConfirmed) {
        //     Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        //     )
        // }
        })
    }
</script>

</body>

</html>
