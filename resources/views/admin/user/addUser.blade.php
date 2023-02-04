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
                    <form method="POST" action="{{ route('add_user') }}">
                        @csrf

                        <div class="row mb-3 ">

                            <div class="col-md-6">
                                <label for="name">{{ __('Name') }} <span>*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="user_name">{{ __('User Name') }} <span>*</span></label>

                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3 ">

                            <div class="col-md-6">
                                <label for="outlet_id" >{{ __('Outlet') }} <span>*</span></label>

                                <!-- <input id="outlet" type="text" class="form-control @error('name') is-invalid @enderror" name="outlet" value="{{ old('outlet') }}" required autocomplete="outlet" autofocus> -->
                                <select id="outlet_id" name="outlet_id" class="form-select form-control @error('outlet_id') is-invalid @enderror" aria-label="Default select example" name="outlet_id" value="{{ old('outlet_id') }}" required autocomplete="outlet_id" autofocus>
                                    <option value="" selected hidden disabled>--Select Outlet--</option>
                                @foreach($outlets as $outlet)
                                <option value="{{$outlet->id}}">{{$outlet->name}} <span class="text-gray" style="font-size: 12px;">({{$outlet->address}})</span></option>
                                @endforeach
                                </select>
                                @error('outlet_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" >{{ __('Email Address') }} <span>*</span></label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3  ">

                            <div class="col-md-6">
                                <label for="password" >{{ __('Password') }} <span>*</span></label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" >{{ __('Confirm Password') }} <span>*</span></label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
