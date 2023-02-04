


<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/morvin-django/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Nov 2021 16:37:30 GMT -->
<head>


    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
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
    <div class="home-center">
        <div class="home-desc-center">

            <div class="container">

                <div class="home-btn"><a href="{{url('/')}}" class="text-white router-link-active"><i
                            class="fas fa-home h2"></i></a></div>


                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="px-2 py-3">


                                    <div class="text-center">
                                        <a href="index.html">
                                            <img src="{{asset('templet/assets')}}/images/logo.png" height="60" alt="logo">
                                        </a>

                                        <h5 class="text-primary mb-2 mt-4">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to BG Haat.</p>
                                    </div>


                                    <form class="form-horizontal mt-4 pt-2" method="POST" action="{{ route('login') }}">
                                            @csrf
                                        <div class="mb-3">
                                            <label for="email">User name or Email</label>
                                            <input id="email" type="text" class="form-control @error('user_name') is-invalid @enderror @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('user_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email">password</label>
                                            <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-label"
                                                        for="customControlInline">Remember me</label>
                                                </div>
                                        </div>

                                        <div>
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            {{-- <p>Don't have an account? <a href="{{ route('register') }}">Create New Account</a></p> --}}
                                            @if (Route::has('password.request'))
                                                <a  href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                            @endif
                                        </div>


                                    </form>


                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center text-white">

                            <p>© <script>document.write(new Date().getFullYear())</script> BG Haat. Crafted with <i class="mdi mdi-heart text-danger"></i> by BG Group</p>
                        </div>
                    </div>
                </div>

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
