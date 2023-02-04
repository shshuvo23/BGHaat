{{-- <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <title>BG Haat</title>
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-warning" href="#">BG Haat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (Route::has('login'))
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                            <a href="{{ url('/home') }}" class="text-sm btn btn-primary text-gray-700 dark:text-gray-500 underline">Dashbord</a>
                    </li>
                </ul>
            @else
            <ul class=" me-auto mb-2 mb-lg-0">
                    <li class="nav-item">

                    </li>
            </ul>
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-primary mx-2 text-sm text-gray-700 dark:text-gray-500">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-success d-none mx-2 ml-4 text-sm text-gray-700 dark:text-gray-500">Register</a>
                @endif
            </div>
            @endauth
        @endif
    </div>
  </div>
</nav>

<div class="carusal" >
  <div class="inner-div">
      <h1 class="display-1 text-warning text-center">Welcome <span class="text-white">to</span></h1>
<h1 class="display-1 text-white text-center">BG <span class="text-warning">Haat</span></h1>
  </div>
</div>






    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html> --}}







<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/morvin-django/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Nov 2021 16:37:30 GMT -->
<head>


    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="icon" href="{{asset('images/fabicon.png')}}" />
    <link rel="apple-touch-icon" href="{{asset('images/fabicon.png')}}" />

    <!-- Bootstrap Css -->
    <link href="{{asset('templet/assets')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('templet/assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('templet/assets')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>


<body class="authentication-bg " style="background-color: #073e0a !important;">
    <span class="logo-lg" >
        <img src="{{asset('templet')}}/assets/images/logo.png" alt="" height="60" class="m-3">
    </span>
    <div class="home-center">
        <div class="home-desc-center">

            <div class="container">

                                <h1 class="display-1 text-warning text-center">Welcome <span class="text-white">to</span></h1>
                                <h1 class="display-1 text-white text-center">BG <span class="text-warning">Haat</span></h1>
                @if (Route::has('login'))
                    @auth
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                            <li class="nav-item d-flex justify-content-center">
                                    <a href="{{ url('/home') }}" class="text-sm btn btn-primary text-gray-700 dark:text-gray-500 underline">Dashbord</a>
                            </li>
                        </ul>
                    @else
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-primary mx-2 text-sm text-gray-700 dark:text-gray-500">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-success d-none mx-2 ml-4 text-sm text-gray-700 dark:text-gray-500">Register</a>
                        @endif
                    </div>
                    @endauth
                @endif

            </div>


        </div>
        <!-- End Log In page -->

    </div>




    <!-- JAVASCRIPT -->
    <script src="{{asset('templet/assets')}}/libs/jquery/jquery.min.js"></script>
    <script src="{{asset('templet/assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('templet/assets')}}/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{asset('templet/assets')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('templet/assets')}}/libs/node-waves/waves.min.js"></script>

    <script src="{{asset('templet/assets')}}/js/app.js"></script>

</body>


<!-- Mirrored from themesdesign.in/morvin-django/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Nov 2021 16:37:30 GMT -->
</html>

{{-- <?php
    function recurtion($data){
       foreach ($data as $key => $value) {
           if(is_array($value)){
               echo '<br>';
               recurtion($value);
               echo '<br>';
           }
           else{
            echo $value.',';
           }
       }
   }

   $data = [
        'a' => 'apple',
        'b' => 'ball',
        'c' =>[
            '1' => ['1','2','3'],
            '2' => ['a','b', 'c' =>[
            '1' => ['1','2','3'],
            '2' => ['a','b','c'],
            '3' => 'd',
        ],],
            '3' => 'd',
        ],
        'd' => ['dall', 'don', 'dov'],
        'e' => 'eee',
    ];
    recurtion($data)


?> --}}


