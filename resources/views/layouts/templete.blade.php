


<!doctype html>
<html lang="en">


<head>


        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>BG Haat</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="icon" href="{{asset('images/fabicon.png')}}" />
        <link rel="apple-touch-icon" href="{{asset('images/fabicon.png')}}" />

        <!-- Bootstrap Css -->
        <link href="{{asset('templet')}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('templet')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('templet')}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


         <!-- Responsive Table css -->
         <link href="{{asset('templet')}}/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

         <!-- End templete link -->
        @yield('css')

         <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <!-- for fontawesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        {{-- for Select2 --}}
        <link href="{{asset('templet')}}/assets/css/select2.min.css" rel="stylesheet" />
    <!-- Styles -->


    </head>


    <body>

        <!-- Begin page -->
        <div id="layout-wrapper " >

            {{-- @include('layouts.component.topbar'); --}}

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

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content" >

                <div class="page-content" >

                    <!-- start page title -->
                    <div class="page-title-box" >
                        <div class="container-fluid" >
                         <div class="row align-items-center" >
                             <div class="col-sm-6">

                             </div>
                             <div class="col-sm-6">
                                <div class="float-end d-none d-sm-block">

                                </div>
                             </div>
                         </div>
                        </div>
                     </div>
                     <!-- end page title -->


                    <div class="container-fluid" >

                        <div class="page-content-wrapper" >




                            <div class="row" >
                                <div class="col-12">
                                    {{-- style="background-color: #000; color: #fff;" --}}
                                    <div class="card " >
                                        <div class="card-body" >

                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                                @yield('body_title')
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}

                                            @if(Session::has('status'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                                                    </button>
                                                    <strong>Well done!</strong> {{ nl2br(Session::get('status')) }}
                                                </div>
                                            @endif

                                            @if(Session::has('failed'))
                                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                                                    </button>
                                                    <strong>Oh snap!</strong> {{ nl2br(Session::get('failed')) }}
                                                </div>
                                            @endif



                                            <p class="card-title-desc"></p>

                                            {{-- style="color: #fff;" --}}
                                            <div class="table-rep-plugin" >
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                                    @yield('content')
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}
                                            {{--  --}}


                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                        </div>


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->



                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © BG Haat.
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
        <!-- END layout-wrapper -->









        <!-- JAVASCRIPT -->




        <script src="{{asset('templet')}}/assets/libs/jquery/jquery.min.js"></script>
        <script src="{{asset('templet')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('templet')}}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{asset('templet')}}/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{asset('templet')}}/assets/libs/node-waves/waves.min.js"></script>

        <!-- Responsive Table js -->
        <script src="{{asset('templet')}}/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

        <!-- Init js -->
        <script src="{{asset('templet')}}/assets/js/pages/table-responsive.init.js"></script>

        <script src="{{asset('templet')}}/assets/js/app.js"></script>
        <!-- templete js end -->









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
         if(document.getElementById(id).value<0 && document.getElementById(id).value != ""){
            document.getElementById(id).value = 0;
         }
    }
</script>

<!-- <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> -->
</body>

</html>





