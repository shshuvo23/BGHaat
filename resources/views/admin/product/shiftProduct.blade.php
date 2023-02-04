@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Shift Product</h4>
@endsection
@section('content')


<div  class="">



    <form method="POST" action="{{ route('add_to_shift') }}">
        @csrf

        <table class="table">
            <tbody>
                <tr class="" id="">
                    <td>
                        <div class="row">


                            @if(auth()->user()->user_role == 'Admin')
                                <div class="col-6">
                                    <label for="sender_outlet_id" >{{ __('Sender outlet') }}</label>

                                        <select onchange="shiftList('from_outlet')" id="sender_outlet_id" name="sender_outlet_id" class="form-select form-control @error('sender_outlet_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('sender_outlet_id') }}" required autocomplete="sender_outlet_id" autofocus>

                                            @foreach($outlets as $outlet)
                                                <option value="{{$outlet->outlet_id}}" {{auth()->user()->outlet_id == $outlet->outlet_id ? 'selected' : '' }}>{{$outlet->outlate_name}} ({{$outlet->address}})</option>
                                            @endforeach
                                        </select>
                                </div>
                            @endif




                            <div class="col-6">
                                <label for="outlet_id" >{{ __('Receiver outlet') }}</label>

                                    <select onchange="shiftList()" id="outlet_id" name="outlet_id" class="form-select form-control @error('outlet_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('outlet_id') }}" required autocomplete="outlet_id" autofocus>
                                        <option value="0" selected disabled hidden>--Select Receiver Outlet--</option>
                                        @foreach($outlets as $outlet)
                                             @if(auth()->user()->user_role == 'Admin' || auth()->user()->outlet_id != $outlet->outlet_id)
                                            <option value="{{$outlet->outlet_id}}">{{$outlet->outlate_name}} ({{$outlet->address}})</option>
                                            @endif
                                        @endforeach
                                    </select>

                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead class="">
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>

                </tr>
            </thead>
            <thead class="" id="seles_details" style="border: 2px solid #525ce5 !important;">

            </thead>
            <thead>

                <tr id="submit_button" class="d-none">
                    <td colspan="8">
                        <div class="">
                            <div class="row " style="">
                                <div class="col d-flex justify-content-end">

                                        <div>
                                            <button type="submit" class="btn btn-primary"> {{ __('Submit') }} </button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody class="">
                <tr style="height: 25px;">
                </tr>
                <tr style="background-color: #525ce5;">

                    <td >


                                <select onchange="quantityTracking({{$products}})" id="sele_product_id" name="sale_product_id" class="form-select form-control @error('sele_product_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('sele_product_id') }}" required autocomplete="sele_product_id" autofocus>

                                     <option value="0" disabled selected hidden>--Select Product--</option>

                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach

                                </select>
                                @error('sale_product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    </td>

                    <td>

                                <input id="sales_quantity" onchange="quantityTracking()" type="number" min="0" class="form-control @error('sales_quantity') is-invalid @enderror" name="sales_quantity" value="{{ old('sales_quantity') }}"  placeholder="Quantity" autocomplete="sales_quantity" autofocus>

                                @error('sales_quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    </td>
                    <td>
                        <a onclick="addShift()" class="btn btn-success"><i class="fa fa-plus"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

</div>



@endsection


@section('js')

<script>
    $(document).ready(function() {
       document.getElementById('outlet_id').value = 0;
       User_type = "{{auth()->user()->user_role}}";
      if(User_type == 'Admin'){
        getOutletProductList();
      }
    });
</script>

<script>
    $(document).ready(function() {
        $('#sele_product_id').select2();
        $('#employe_id').select2();
    });
</script>


<script>
    function getOutletProductList(){
        senderOutletId = 0;
        if(document.getElementById('sender_outlet_id'))
          senderOutletId = document.getElementById('sender_outlet_id').value;
            //alert(senderOutletId);
          $.get('{{route('get_outlet_product_list')}}', {senderOutletId:senderOutletId}, function(data){
              //alert(data);
                document.getElementById('sele_product_id').innerHTML = data;
          });
    }
</script>

<script>
    function quantityTracking(data = null){


        numberInputTracking('sales_quantity');
        quantity = document.getElementById('sales_quantity').value;
        productId = document.getElementById('sele_product_id').value;
        outletId = document.getElementById('outlet_id').value;

        senderOutletId = 0;
        if(document.getElementById('sender_outlet_id'))
          senderOutletId = document.getElementById('sender_outlet_id').value;



        if(productId > 0 && outletId != 0){

            $.get('{{route('get_product_avable_quantity_to_shift')}}',{productId:productId, outletId:outletId, sender_outlet_id:senderOutletId}, function(data){

                if(data<parseFloat(quantity)){
                    alert('The requested quantity is not available for this product');
                    if(data > 0){document.getElementById('sales_quantity').value = data;}
                    else {document.getElementById('sales_quantity').value = "";}
                }
            });
        }
    }
</script>

<script>

    function shiftList(data = null){

        if(data == 'from_outlet'){
            getOutletProductList();
        }

        outletId = document.getElementById('outlet_id').value;
        senderOutletId = 0;

        if(document.getElementById('sender_outlet_id'))
          senderOutletId = document.getElementById('sender_outlet_id').value;

        if(outletId){

            $.get('{{route('add_shift_form')}}',{outletId:outletId, sender_outlet_id:senderOutletId}, function(data){
                //console.log(data);
                document.getElementById('seles_details').innerHTML = data;
                document.getElementById('submit_button').classList.remove("d-none");

                var table = document.getElementById("seles_details");
                var rows = table.getElementsByTagName("tr");
                if(rows.length == 0){
                    document.getElementById('submit_button').classList.add("d-none");
                }
            });
            document.getElementById('sales_quantity').value = "";
            $("#sele_product_id").select2("val", "0");
        }
    }
</script>

<script>
    function deleteSelesItem(id){
        $.get('{{route('delete_add_shift_item')}}',{id:id}, function(data){
            shiftList();
        });
    }
</script>

<script>
    function addShift(){

        outletId = document.getElementById('outlet_id').value;
        productId = document.getElementById('sele_product_id').value;
        quantity = document.getElementById('sales_quantity').value;
        senderOutletId = 0;
        if(document.getElementById('sender_outlet_id'))
          senderOutletId = document.getElementById('sender_outlet_id').value;

        quantity = quantity.trim();

        if($.isNumeric(quantity) && outletId != 0 && productId != 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });


                //alert(productId);

                $.get('{{route('get_product_avable_quantity_to_shift')}}',{productId:productId,outletId:outletId, sender_outlet_id:senderOutletId}, function(data){

                    if(data>=parseFloat(quantity)){

                        $.post('{{route('add_shift_to_cart')}}', {
                            outletId:outletId,
                            productId:productId,
                            quantity:quantity,
                            sender_outlet_id:senderOutletId,
                        },
                        function(data){
                            if(data == "success"){

                                //alert(data);
                                $.get('{{route('add_shift_form')}}',{outletId:outletId, sender_outlet_id:senderOutletId}, function(data){

                                    document.getElementById('seles_details').innerHTML = data;
                                    document.getElementById('submit_button').classList.remove("d-none");
                                });
                                document.getElementById('sales_quantity').value = "";
                                $("#sele_product_id").select2("val", "0");


                            }
                        });
                    }
                });

        }
        else{alert("Enter valied input");}
    }
</script>




@endsection
