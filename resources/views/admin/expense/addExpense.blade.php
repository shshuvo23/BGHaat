@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Add Expense</h4>
@endsection
@section('content')
<section id="add_expense" >
    <div class="justify-content-center container" >
        <div class="" style="padding: 50px;">
            <div class="" >

                <div class=" " style="height: 100vh;">
                    <form method="POST" action="{{ route('add_expense') }}">
                        @csrf

                        <div class="row mb-3  d-flex justify-content-center">

                            <div class="col-md-6">
                            <label for="expense_title" >{{ __('Title') }} <span>*</span></label>

                                <input id="expense_title" type="text" class="form-control @error('expense_title') is-invalid @enderror" name="expense_title" value="{{ old('expense_title') }}" required autocomplete="expense_title" autofocus>

                                @error('expense_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="expense_amount" >{{ __('Amount') }}<span>*</span></label>

                                <input step="0.1"  id="expense_amount" onchange="numberInputTracking('expense_amount')" type="number" value="{{ old('expense_amount') }}"class="form-control @error('expense_amount') is-invalid @enderror" name="expense_amount" required autocomplete="expense_amount">

                                @error('expense_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>






                        <div class="row mb-3  d-flex justify-content-center">

                            <div class="col-md-6">
                                <label for="outlet_id" >{{ __('Outlet') }}<span>*</span></label>

                                <select id="outlet_id" name="outlet_id" class="form-select form-control @error('outlet_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('outlet_id') }}" required autocomplete="outlet_id" autofocus>

                                    <option value="" selected hidden disabled>--Select Outlet--</option>
                                    @foreach($outlets as $outlet)
                                        <option value="{{$outlet->id}}">
                                            <span class="">({{$outlet->name}})</span>
                                            <span class="">{{$outlet->address}}</span>
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="expense_date">{{ __('Date') }} <span>*</span></label>

                                <input id="expense_date" type="date" class="form-control @error('expense_date') is-invalid @enderror" name="expense_date" value="{{ old('date') }}" required autocomplete="expense_date">

                                @error('expense_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3  d-flex justify-content-center">

                            <div class="col">
                            <label for="expense_description" >{{ __('Description') }} </label>

                                <textarea id="expense_description" class="form-control @error('expense_description') is-invalid @enderror" name="expense_description" value="{{ old('expense_description') }}"  autocomplete="expense_description"></textarea>

                                @error('expense_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
@endsection
