@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Add Product</h4>
@endsection
@section('content')
<section id="add_product">
    <div class="justify-content-center container" >
        <div class="" >
            <div class="" >

                <div class=" " style="height: 100vh;">
                    <form method="POST" action="{{ route('add_product') }}">
                        @csrf

                        <div class="row mb-3 d-flex justify-content-center">

                            <div class="col-md-3">
                                <label for="product_name" >{{ __('Product Name') }}<span>*</span></label>

                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="product_name" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="brand" >{{ __('Brand') }}<span>*</span></label>

                                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" autofocus>

                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="unit" >{{ __('Unit') }}<span>*</span></label>

                                <select id="unit" name="unit" class="form-select form-control @error('unit') is-invalid @enderror" aria-label="Default select example" name="unit" value="{{ old('unit') }}" required autocomplete="unit" autofocus>

                                    <option value="kg">kg</option>
                                    <option value="gm">gm</option>
                                    <option value="Ltr">Ltr</option>
                                    <option value="Ml">ml</option>
                                    <option value="Piece">Piece</option>
                                    </select>

                                    {{-- <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" autofocus> --}}

                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="barcode" >{{ __('Barcode') }}</label>

                                <input id="barcode" type="number" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}"autocomplete="barcode" autofocus>

                                @error('barcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-3 d-flex justify-content-center">

                            <div id="unit_div" class="col-md-6">
                                <label for="price_per_unite" >{{ __('Regular MRP') }}<span>*</span></label>

                                <input  step="0.1"  id="price_per_unite" onchange="numberInputTracking('price_per_unite')"  type="number" class="form-control @error('price_per_unite') is-invalid @enderror" name="price_per_unite" value="{{ old('price_per_unite') }}" required autocomplete="price_per_unite" autofocus>

                                @error('price_per_unite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="offer_div" class="col-md-6">
                                <label for="offer_mrp" >{{ __('Offer MRP') }}</label>

                                <input id="offer" name="offer"  type="checkbox">

                                <input  step="0.1"  id="offer_mrp" onchange="expireDateFild('offer_mrp')"  type="number" class="form-control @error('offer_mrp') is-invalid @enderror" name="offer_mrp" value="{{ old('offer_mrp') }}" autocomplete="offer_mrp" autofocus>

                                @error('offer_mrp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="expire_div" class="col-md-4 d-none">
                                <label for="expire_date" >{{ __('Offer Expire Date') }}<span>*</span></label>

                                <input id="expire_date"  type="date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date" value="{{ old('expire_date') }}" autocomplete="expire_date" autofocus>

                                @error('expire_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-3 d-flex justify-content-center">

                            <div class="col">
                                <label for="product_description" >{{ __('Description') }}</label>

                               <textarea id="product_description" type="text" class="form-control @error('product_description') is-invalid @enderror" name="product_description" value="{{ old('product_description') }}"  autocomplete="product_description"> </textarea>

                                @error('product_description')
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


@section('js')

    <script>
        $(document).ready( function () {
            numberInputTracking('offer_mrp');
            data = document.getElementById('offer_mrp').value;
            if(data != ""){
                document.getElementById('expire_div').classList.remove('d-none');
                document.getElementById('expire_date').setAttribute('required', '');

                document.getElementById('unit_div').classList.remove('col-md-6');
                document.getElementById('offer_div').classList.remove('col-md-6');

                document.getElementById('unit_div').classList.add('col-md-4');
                document.getElementById('offer_div').classList.add('col-md-4');

            }
        });
    </script>

    <script>
        function expireDateFild(){
            numberInputTracking('offer_mrp');
            data = document.getElementById('offer_mrp').value;
            if(data != ""){
                document.getElementById('expire_div').classList.remove('d-none');
                document.getElementById('expire_date').setAttribute('required', '');


                document.getElementById('unit_div').classList.remove('col-md-6');
                document.getElementById('offer_div').classList.remove('col-md-6');

                document.getElementById('unit_div').classList.add('col-md-4');
                document.getElementById('offer_div').classList.add('col-md-4');
            }
            else{
                document.getElementById('expire_date').value = "";
                document.getElementById('expire_div').classList.add('d-none');
                document.getElementById('expire_date').removeAttribute('required');


                document.getElementById('unit_div').classList.remove('col-md-4');
                document.getElementById('offer_div').classList.remove('col-md-4');

                document.getElementById('unit_div').classList.add('col-md-6');
                document.getElementById('offer_div').classList.add('col-md-6');
            }
        }
    </script>
@endsection


