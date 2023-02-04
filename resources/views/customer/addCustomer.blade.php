@extends('layouts.templete')
@section('body_title')
<h4 class="header-title">Add Customer</h4>
@endsection
@section('content')
<div class="container">
<section id="add_employe">
    <div class="justify-content-center" >
        <div style="padding: 50px;" >
            <div class="" >

                <div class=" " style="height: 100vh;">
                    <form method="POST" action="add_coustomer">
                        @csrf

                        <div class="row mb-3 d-flex justify-content-center">

                            <div class="col-md-6">
                            <label for="customer_name" >{{ __('Name') }}</label>

                                <input id="customer_name" type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ old('customer_name') }}" required autocomplete="customer_name" autofocus>

                                @error('customer_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-center">

                            <div class="col-md-6">
                            <label for="address" >{{ __('Address') }}</label>

                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-center">

                            <div class="col-md-6">
                            <label for="contact_no" >{{ __('Contact No') }}</label>

                                <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" required autocomplete="contact_no" autofocus>

                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0 d-flex justify-content-center">
                            <div class="col-md-6 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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
