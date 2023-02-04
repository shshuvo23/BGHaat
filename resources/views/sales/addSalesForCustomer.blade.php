@extends('layouts.templete')
@section('body_title')
<h4 class="header-title">Add sales to Customer</h4>
@endsection



@section('content')

<section id="add_sales">


    <div class="row">
        <div id="sales_container" class="col">
            <div class="card">
                <div class="card-body">


                    <form id="selesForm" method="POST" action="{{ route('add_customer_seles') }}">
                        @csrf

                        <table class="table">
                            <tbody>
                                <tr id="old_customer" class="">
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select required  id="customer_id" name="customer_id" class="form-select form-control @error('customer_id') is-invalid @enderror" aria-label="Default select example"  autofocus>
                                                    <option value="" selected  >--Select customer--</option>

                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}}({{$customer->contact_no}})</option>
                                                    @endforeach

                                                </select>
                                                @error('customer_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <span class="text-danger" >
                                                    <strong id="customer_error" class="d-none"></strong>
                                                </span>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="new_customer" value="1" id="checkBox" onchange="oldAndNewCustomer()" type="checkbox"> New Customer
                                    </td>
                                </tr>
                                <tr class="d-none" id="new_customer">
                                    <td>
                                        <div class="row">


                                            <div class="col ">
                                                <label for="">Name</label>
                                                <input id="name" name="name" type="text" class="form-control " value="">
                                                <span class="text-danger" >
                                                    <strong id="name_error" class="d-none"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                    <div class="row">
                                        <div class="col ">
                                            <label for="contact_no">Contact No</label>
                                            <input id="contact_no" name="contact_no" type="text" class="form-control " value="">
                                            <span class="text-danger" >
                                                <strong id="contact_error" class="d-none"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>




                        {{-- <table class="table ">
                            <thead class="">
                                <tr>
                                    <th scope="col" >Seles Type</th>
                                    <th scope="col" colspan="2">Product Name</th>
                                    <th scope="col" colspan="2" class="text-center">Unit</th>
                                    <th scope="col">Regular MRP</th>
                                    <th scope="col">Offer MRP</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>



                                </tr>
                            </thead>
                            <thead  id="seles_details" style="border: 2px solid #525ce5 !important;">

                            </thead>

                            <thead>
                                <tr id="submit_button" class="d-none">
                                    <td colspan="10">
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

                            <tbody class="p-5 " >
                                <tr style="height: 25px;">
                                </tr>
                                <tr style="background-color: #525ce5;">

                                    <td colspan="3">
                                        <div class="row">

                                            <div class="col">

                                                <select onchange="quantityTracking({{$products}})" id="sele_product_id" name="sale_product_id" class="form-select form-control @error('sele_product_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('sele_product_id') }}"  autocomplete="sele_product_id" autofocus>
                                                    <option value="0" disabled selected hidden>Select Product</option>

                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('sale_product_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class="row">

                                            <div class="col">
                                                <input  type="text" id="unit" class="form-control @error('unit') is-invalid @enderror" name="unit"  required  placeholder="Unit" autofocus readonly>

                                                @error('unit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">

                                            <div class="col">
                                                <input  type="number" id="sales_price" onchange="numberInputTracking('sales_price')" class="form-control @error('sales_price') is-invalid @enderror" name="sales_price" value="{{ old('sales_price') }}" required placeholder="Regular MRP" autocomplete="sales_price" autofocus readonly>

                                                @error('sales_price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">

                                            <div class="col">
                                                <input  type="number" id="offer_mrp" onchange="numberInputTracking('offer_mrp')" class="form-control @error('offer_mrp') is-invalid @enderror" name="offer_mrp" value="{{ old('offer_mrp') }}" required placeholder="Offer MRP" autocomplete="offer_mrp" autofocus readonly>

                                                @error('offer_mrp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <input id="sales_quantity" onchange="quantityTracking()" type="number" class="form-control @error('sales_quantity') is-invalid @enderror" name="sales_quantity" value="{{ old('sales_quantity') }}" placeholder="Quantity" autocomplete="sales_quantity" autofocus>

                                                @error('sales_quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a onclick="addSeles()" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                    </td>

                                </tr>
                            </tbody>
                        </table> --}}


                        <table id="cart_table" class="table table-striped table-hover">
                            <thead class="">
                                <tr >
                                    <th scope="col" colspan="2">Product
                                        Name</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Regular MRP</th>
                                    <th scope="col">Offer MRP</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="seles_details">

                            </tbody>
                            <tfoot>
                                <tr>

                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Total</label>
                                                <input id="total" name="total"
                                                    type="number" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Paid</label>
                                                <input onkeyup="payment()" onchange="payment()"
                                                    name="paid" id="paid" type="number"
                                                    class="form-control " value="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Due</label>
                                                <input id="due" type="number" name="due"
                                                    class="form-control " value=""
                                                    readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Change</label>
                                                <input id="change" type="number" name="change"
                                                    class="form-control " value=""
                                                    readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for=""></label>

                                                <a class="btn btn-primary mt-2" onclick="formSubmit()">Submit</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Add Products</h4> --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <select class="form-control" name="" onchange="quantityTracking({{$products}})" id="sele_product_id">
                                    <option value="0" selected disabled hidden>--Select Product--</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input type="text" id="unit" class="form-control "
                                    name="unit" required="" placeholder="Unit"
                                    autofocus="" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input type="number" id="sales_price"
                                    onchange="numberInputTracking('sales_price')"
                                    class="form-control " name="sales_price" value=""
                                    required="" placeholder="Regular MRP"
                                    autocomplete="sales_price" autofocus="" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input
                                    type="number"id="offer_mrp"onchange="numberInputTracking('offer_mrp')"class="form-control "name="offer_mrp"value=""required=""placeholder="Offer MRP"autocomplete="offer_mrp"autofocus=""readonly="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input id="sales_quantity" onchange="quantityTracking()"
                                    type="number" class="form-control " name="sales_quantity"
                                    value="" placeholder="Quantity"
                                    autocomplete="sales_quantity" autofocus="">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-3">
                                <a onclick="addSeles()" class="btn btn-success"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection




@section('js')





<script>

    $(document).ready(function() {
        document.getElementById('checkBox').checked = 0;

    });

    function oldAndNewCustomer(){
        checkbox = document.getElementById('checkBox').checked;
        oldCustomer = document.getElementById('old_customer');
        newCustomer = document.getElementById('new_customer');
        let name = document.getElementById('name');
        contactNo = document.getElementById('contact_no');
        customerId = document.getElementById('customer_id');

        if(checkbox){
            oldCustomer.classList.add('d-none');
            newCustomer.classList.remove('d-none');
            name.required = true;
            contactNo.required = true;
            customerId.required = false;

        }else{
            oldCustomer.classList.remove('d-none');
            newCustomer.classList.add('d-none');
            name.required = false;
            contactNo.required = false;
            customerId.required = false;
        }
    }

</script>

<script>
    var qty = [];
    $(document).ready(function(){
        $('#sele_product_id').select2();
        $('#customer_contact_no').select2();
        $('#customer_id').select2();


        $.get('{{'get_customer_purchase_history'}}', function(data){


            let customerId = document.getElementById('customer_id');

            document.getElementById('total').value = data.total;
            document.getElementById('due').value = data.total;
            document.getElementById('change').value = 0;

            document.getElementById('seles_details').innerHTML = data['table'];

            document.getElementById('cart_table').classList.remove("d-none");
            var table = document.getElementById("seles_details");
            var rows = table.getElementsByTagName("tr");
            if(rows.length == 0){
                document.getElementById('cart_table').classList.add("d-none");
            }
           qty = data['qty'];
        });
    });
</script>


<script>
    function payment(){
        let total = document.getElementById('total').value;
        let paid = document.getElementById('paid').value;
        if(paid == null || paid == ""){ paid = 0;}

        if(parseFloat(paid)<0) {
            paid = 0;
            document.getElementById('paid').value = 0;
        }
        if(parseFloat(paid) <= parseFloat(total)){
            document.getElementById('due').value = parseFloat(total) - parseFloat(paid);
            document.getElementById('change').value = 0;
        }

        if(parseFloat(paid) >= parseFloat(total)){
            document.getElementById('change').value = parseFloat(paid) - parseFloat(total);
            document.getElementById('due').value = 0;
        }
    }
</script>



<script>
    function setPrice(){
        id = $("#sele_product_id").val();


        if(id != 0 && id != null){
            $.get('{{route('get_product_details_by_id')}}', {id:id}, function(data){
                document.getElementById('sales_price').value = data.price_per_unite;
                let date = new Date().toISOString().slice(0, 10);
                //alert(null == "");
                document.getElementById('offer_mrp').value = "";
                if(data.offer != 0 && data.expire_date >= date)
                    document.getElementById('offer_mrp').value = data.offer_mrp;

                if(data.unit)document.getElementById('unit').value = data.unit;
            });
       }
    }
</script>

<script>
    function deleteSelesItem(id){

        $.get('{{route('delete_customer_add_seles_item')}}',{id:id}, function(data){
            document.getElementById('seles_details').innerHTML = data.rows.original.table
            qty = data.rows.original.qty;
            var table = document.getElementById("seles_details");
            var rows = table.getElementsByTagName("tr");
            if(rows.length == 0){
                document.getElementById('cart_table').classList.add("d-none");
            }

            document.getElementById('total').value = data.rows.original.total;
            let paid = document.getElementById('paid').value;
            if(paid == null || paid == ""){ paid = 0;}

            if(parseFloat(paid) <= data.rows.original.total){
                document.getElementById('due').value = data.rows.original.total - parseFloat(paid);
                document.getElementById('change').value = 0;
            }

            if(parseFloat(paid) >= data.rows.original.total){
                document.getElementById('change').value = parseFloat(paid) - data.rows.original.total;
                document.getElementById('due').value = 0;
            }

        });


    }
</script>



<script>
    function quantityTracking(data = null){

        numberInputTracking('sales_quantity');
        if(data != null)setPrice();
        quantity = document.getElementById('sales_quantity').value;
        productId = document.getElementById('sele_product_id').value;

        if(productId > 0){
            $.get('{{route('get_product_avable_quantity')}}',{productId:productId}, function(data){



                if((qty[productId] !== undefined)){data = (parseFloat(data) - parseFloat(qty[productId])); }

                if( data< parseFloat(quantity)){
                    alert('The requested quantity is not available for this product');
                    if(data > 0){document.getElementById('sales_quantity').value = data;}
                    else {document.getElementById('sales_quantity').value = "";}
                }
            });
        }

    }
</script>


<script>

    function addSeles(){
        productId = document.getElementById('sele_product_id').value;
        unit = document.getElementById('unit').value;

        price = document.getElementById('sales_price').value;
        offer_mrp = document.getElementById('offer_mrp').value;
        //alert(offer_mrp == "");
        if(offer_mrp != ""){price = offer_mrp;}

        quantity = document.getElementById('sales_quantity').value;
        price = price.trim();
        quantity = quantity.trim();
        if($.isNumeric(price) && $.isNumeric(quantity)) {
            total = price * quantity;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });



                $.get('{{route('get_product_avable_quantity')}}',{productId:productId}, function(data){


                    if(qty[productId] !== undefined){data = (parseFloat(data) - parseFloat(qty[productId])); }

                    if(data>=parseFloat(quantity)){

                        $.post('{{ route('add_customer_seles_to_cart') }}', {
                            // selesType:selesType,
                            productId:productId,
                            unit:unit,
                            price:price,
                            quantity:quantity,
                        },
                        function(data){
                            if(data == "success"){
                                $.get('{{route('add_customer_seles_form')}}', function(data){

                                    qty = data['qty'];


                                    document.getElementById('total').value = data['total'];
                                    let paid = document.getElementById('paid').value;
                                    if(paid == null || paid == ""){ paid = 0;}
                                    if(parseFloat(paid) <= data['total']){
                                        document.getElementById('due').value = data['total'] - parseFloat(paid);
                                        document.getElementById('change').value = 0;
                                    }

                                    if(parseFloat(paid) >= data['total']){
                                        document.getElementById('change').value = parseFloat(paid) - data['total'];
                                        document.getElementById('due').value = 0;
                                    }


                                    document.getElementById('seles_details').innerHTML = data['table'];
                                    document.getElementById('cart_table').classList.remove("d-none");
                                });

                                document.getElementById('unit').value = "";
                                document.getElementById('sales_price').value = "";
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



<script>
    function formSubmit(){

        let due = document.getElementById('due').value;
        document.getElementById('contact_error').innerHTML = "";
        document.getElementById('name_error').innerHTML = "";
        document.getElementById('customer_error').innerHTML = "";

        let TF = true;
        if(parseFloat(due)>0){

            checkbox = document.getElementById('checkBox').checked;
            oldCustomer = document.getElementById('old_customer');
            newCustomer = document.getElementById('new_customer');
            let name = document.getElementById('name');
            contactNo = document.getElementById('contact_no');
            customerId = document.getElementById('customer_id');

            if(checkbox){
                if(contactNo.value == null || contactNo.value == ""){
                    TF = false;
                    document.getElementById('contact_error').classList.remove('d-none');
                    document.getElementById('contact_error').innerHTML = "This field is required";
                }
                if(name.value == null || name.value == ""){
                    TF = false;
                    document.getElementById('name_error').classList.remove('d-none');
                    document.getElementById('name_error').innerHTML = "This field is required";
                }

            }else{
                if(customerId.value == "" || customerId.value == null){
                    TF = false;
                    document.getElementById('customer_error').classList.remove('d-none');
                    document.getElementById('customer_error').innerHTML = "This field is required";
                }
            }
        }
        if(TF){document.getElementById('selesForm').submit();}
    }
</script>

@endsection



