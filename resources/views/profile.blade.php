@extends('layouts.templete')
@section('body_title')
<h4 class="header-title">Add User</h4>
@endsection
@section('content')
<div class="container">
<section id="add_user" >
    <div class="justify-content-center" >
        <div class="" >
            <div class="" >
                <div class=" " style="height: 100vh;">
                    @if(session()->get('verified') == 0)
                    <form method="post" action="{{route('match_password')}}">
                        @csrf
                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <label for="old_password">{{ __('Password') }} <span>*</span></label>
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autofocus>

                                @if(session()->get('old_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ session()->get('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6"><label for=""> </label><button class="btn btn-primary " style="margin-top: 1.9rem;" type="submit">Continue</button></div>
                        </div>
                    </form>
                    @endif

                    @if(session()->get('verified') == 1)
                    <form method="POST" action="{{route('update_user_info')}}">
                        @csrf

                        <div class="row mb-3 ">
                            @if(auth()->user()->user_role == 'Admin')
                            <div class="col-md-6">
                                <label for="name">{{ __('Name') }} <span>*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endif

                            <div class="{{auth()->user()->user_role == 'Admin' ? 'col-md-6': 'col-12'}}">
                                <label for="user_name">{{ __('User Name') }} <span>*</span></label>

                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ auth()->user()->user_name }}" required autocomplete="user_name" autofocus>

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        @if(auth()->user()->user_role == 'Admin')
                        <div class="row mb-3 ">

                            <div class="col">
                                <label for="email" >{{ __('Email Address') }} <span>*</span></label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        @endif

                        <div class="row mb-3  ">

                            <div class="col-md-6">
                                <label for="password" >{{ __('New Password') }} </label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" >{{ __('Confirm Password') }} </label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>



                        <div class="row mb-0 ">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
