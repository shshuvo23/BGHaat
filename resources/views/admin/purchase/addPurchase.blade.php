@extends('layouts.templete')
@section('body_title')
<h4 class="header-title">Add Purchase</h4>
@endsection
@section('content')
<section id="add_purchase">
    <div class="justify-content-center container" >
        <div class="" >
            <div class="" >

                <div class=" " style="height: 100vh;">
                    <form method="POST" action="{{ route('add_purchase') }}">
                        @csrf


                        <div class="row mb-3 justify-content-center">

                            <div class="col-md-4">
                                <!-- <input  type="text" class="" name="product_id" value="{{ old('product_id') }}" required autocomplete="product_id" autofocus> -->
                                <label for="outlet_id" >{{ __('Outlet') }} <span>*</span></label>

                                <select id="outlet_id" name="outlet_id" class="form-select form-control @error('outlet_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('outlet_id') }}" required autocomplete="outlet_id" autofocus>
                                    <option value="" selected disabled hidden>--Select Outlet--</option>
                                    @foreach($outlets as $outlet)
                                        <option value="{{$outlet->id}}">{{$outlet->name}}({{$outlet->address}})</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-md-4">
                                <!-- <input  type="text" class="" name="product_id" value="{{ old('product_id') }}" required autocomplete="product_id" autofocus> -->
                                <label for="product_id" >{{ __('Product Name') }}<span>*</span></label> <br>

                                <select id="product_id" name="product_id" class="form-select form-control @error('product_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('product_id') }}" required autocomplete="product_id" autofocus>
                                    <option value="" selected disabled hidden>--Select Product--</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="date">{{ __('Date') }} <span>*</span></label>

                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3 justify-content-center">

                            <div class="col-md-4">
                                <label for="quantity" >{{ __('Quantity') }}<span>*</span></label>

                                <input step="0.1" onchange="totalPrice('quantity')" id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity">

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="free_quantity" >{{ __('Free Quantity') }}</label>

                                <input  step="0.1" onchange="currentPrice('free_quantity')" id="free_quantity" type="number" class="form-control @error('free_quantity') is-invalid @enderror" name="free_quantity" value="{{ old('free_quantity') }}"  autocomplete="free_quantity">

                                @error('free_quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="price" >{{ __('Purchase Unit Price') }}<span>*</span></label>

                                <input onchange="totalPrice('price')" id="price" type="number" step="0.1" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>








                        <div class="row mb-3 justify-content-center">

                            <div class="col-md-4">
                                <label for="total " >{{ __('Total Price') }}<span>*</span></label>

                                <input id="total" step="0.1" onchange="currentPrice('total')"step="0.01" type="number" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('total') }}" required autocomplete="total" autofocus>

                                @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="paid" >{{ __('Paid Amount') }}<span>*</span></label>

                                <input step="0.1" id="paid" onchange="currentPrice('paid')"step="0.01" type="number" class="form-control @error('paid') is-invalid @enderror" name="paid" value="{{ old('paid') }}"  autocomplete="paid" autofocus required>

                                @error('paid ')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label  for="" >{{ __('Current Unit Price') }}</label>
                                <input  id="current_price" type="number" step="0.1" class="form-control "  >

                                @error('current_price ')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>





                        <div class="row mb-3 justify-content-center">


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
        $(document).ready(function() {
            $('#product_id').select2();
        });
    </script>
    <script>
        function totalPrice(data){
            if(data == 'quantity')numberInputTracking('quantity');
            if(data == 'price')numberInputTracking('price');

            var quantity = document.getElementById('quantity').value;
            var price = document.getElementById('price').value;

            if(quantity != "" && price != ""){
                document.getElementById('total').value = (parseFloat(quantity) * parseFloat(price));
                currentPrice('total');
            }


        }
    </script>
    <script>
        function currentPrice(data){

            if(data == 'quantity')numberInputTracking('quantity');
            if(data == 'free_quantity')numberInputTracking('free_quantity');
            if(data == 'paid')numberInputTracking('paid');
            if(data == 'total')numberInputTracking('total');

            var quantity = document.getElementById('quantity').value;
            var free_quantity = document.getElementById('free_quantity').value;
            var paid = document.getElementById('paid').value;
            var total = document.getElementById('total').value;

            if(!paid){paid = 0;}
            if(!free_quantity){free_quantity = 0;}



            total_quantity = parseFloat(quantity) + parseFloat(free_quantity);

            if(quantity != "" && total != ""){
                document.getElementById('current_price').value = (parseFloat(paid)/parseFloat(total_quantity)).toFixed(2);
            }

        }
    </script>
@endsection
