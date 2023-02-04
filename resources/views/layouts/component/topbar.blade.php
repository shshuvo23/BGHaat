
    {{-- style="background-color: #000; color: #fff;" --}}
<div class="navbar-header" >
    <div class="d-flex">

            <!-- LOGO -->
        <div class="navbar-brand-box">
        <a href="{{route('home')}}" class="logo logo-dark">
            {{-- <span class="logo-sm">
                <img src="{{asset('templet')}}/assets/images/logo.png" alt="" height="22">
            </span> --}}
            <span class="logo-lg">
                <img src="{{asset('templet')}}/assets/images/logo.png" alt="" height="60">
            </span>
        </a>

        {{-- <a href="{{url('/')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('templet')}}/assets/images/logo.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('templet')}}/assets/images/logo.png" alt="" height="20">
            </span>
        </a> --}}
    </div>

        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
            <i class="mdi mdi-menu"></i>
        </button>



    </div>

        <!-- Search input -->
        <div class="search-wrap" id="search-wrap">
        <div class="search-bar">
            <input class="search-input form-control" placeholder="Search" />
            <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                <i class="mdi mdi-close-circle"></i>
            </a>
        </div>
    </div>

    <div class="d-flex ">


        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{asset('templet')}}/assets/images/profile.jpg"
                    alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                {{-- <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock-open-outline font-size-16 align-middle me-1"></i> Lock screen</a> --}}

                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="mdi mdi-power font-size-16 align-middle me-1 text-danger"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a class="dropdown-item text-success" href="{{route('profile')}}">Profile</a>
            </div>
        </div>
    </div>
</div>

