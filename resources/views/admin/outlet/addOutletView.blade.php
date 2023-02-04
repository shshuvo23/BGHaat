@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Add Outlet</h4>
@endsection
@section('content')

<section id="add_outlet">
    <div class="justify-content-center container" >
        <div class="" >
            <div class="" >


                <div style="height: 100vh;">
                    <form method="POST" action="{{ route('make_outlet') }}">
                        @csrf

                        <div class="row mb-3 d-flex justify-content-center">


                            <div class="col-md-6">
                                <label for="name" >{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
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


@endsection
