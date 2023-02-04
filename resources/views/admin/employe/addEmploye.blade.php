@extends('layouts.templete')
@section('body_title')
<h4 class="header-title">Add Employee</h4>
@endsection
@section('content')
<div class="container">
<section id="add_employe">
    <div class="justify-content-center" >
        <div class="" style="padding: 50px;">
            <div class="" >

                <div class=" " style="height: 100vh;">
                    <form method="POST" action="{{ route('add_employe') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">

                            <div class="col-md-4">
                            <label for="employe_name" >{{ __('Name') }} <span>*</span></label>

                                <input id="employe_name" type="text" class="form-control @error('employe_name') is-invalid @enderror" name="employe_name" value="{{ old('employe_name') }}" required autocomplete="employe_name" autofocus>

                                @error('employe_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="designation">{{ __('Designation') }}</label>

                                    <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation') }}"  autocomplete="designation" >

                                    @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="depertment" >{{ __('Depertment') }}<span>*</span></label>

                                    <input id="depertment" type="text" class="form-control @error('depertment') is-invalid @enderror" name="depertment" value="{{ old('depertment') }}" required autocomplete="depertment" >

                                    @error('depertment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>





                        <div class="row mb-3 justify-content-center">

                            <div class="col-md-3">
                            <label for="id_card_number" >{{ __('ID Card Number') }}<span>*</span></label>

                                <input id="id_card_number" type="text" class="form-control @error('id_card_number') is-invalid @enderror" name="id_card_number" value="{{ old('id_card_number') }}" autocomplete="id_card_number" required>

                                @error('id_card_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="contact_no" >{{ __('Contact No') }}</label>

                                    <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" autocomplete="contact_no">

                                    @error('contact_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="salary" >{{ __('Salary') }}<span>*</span></label>

                                    <input  step="0.1"  id="salary" onchange="numberInputTracking('salary')" type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" required autocomplete="salary">

                                    @error('salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="col-md-3">


                                <label for="credit_limit" >{{ __('Credit Limit') }}<span>*</span></label>
                                <div class="input-group">
                                    <input id="credit_limit" onchange="numberInputTracking('credit_limit')" type="number" class="form-control @error('credit_limit') is-invalid @enderror" name="credit_limit" value="{{ old('credit_limit') ? old('credit_limit') : 30 }}" required autocomplete="credit_limit">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                @error('credit_limit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>







                        <div class="row mb-0 ">
                            <div class="col-md-6">
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
