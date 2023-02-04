@extends('layouts.layout2')
@section('content')








    <div class="container-fluid">
        <div class="page-content-wrapper">



            <div class="row" id="seles_header">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Seles to Employee</h4>
                            <div class="row d-flex justify-content-center">
                                <div class="input-group d-flex justify-content-center">
                                    <div class="form-outline">
                                        <select style="margin-bottom: 2rem;" id="employe_id" name="employe_id" class="form-select @error('employe_id') is-invalid @enderror" aria-label="Default select example">
                                            <option value="0" disabled selected hidden>Select Employee</option>
                                            @foreach ($employes as $employe )
                                                <option value="{{$employe->id}}"><strong>{{$employe->id_card_number}}:</strong> {{$employe->name}}-{{$employe->contact_number}}</option>
                                            @endforeach
                                        </select>

                                        @error('employe_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="button" onclick="contienueToAddSel()" class="btn btn-primary" >
                                      <i class="fas fa-search"></i> Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="sales_container" class="d-none">

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h4 id="name" class=""></h4>
                                <p id="designation"></p>
                                <form id="selesForm" method="POST" action="{{route('add_seles')}}">
                                    @csrf
                                    <input name="EmployeI_ID" id="EmployeI_ID" type="number"
                                        hidden="">
                                    {{-- <table class="table table-striped table-hover">

                                    </table> --}}
                                    <table id="cart_table" class="table table-striped table-hover d-none">
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
                                                <td >
                                                    <div class="row">
                                                        <div class="col ">
                                                            <label for="">Credit
                                                                Limit</label>
                                                            <input id="creditPurchaseLimit" type="text"
                                                                class="form-control " value=""
                                                                readonly="">
                                                        </div>
                                                    </div>
                                                </td>
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

            </div>
        </div>
    </div>










@endsection


@section('js')

<script>
    $(document).ready(function() {
        $('#sele_product_id').select2();
        $('#employe_id').select2();
    });
</script>


<script>
    function setPrice(){
       id = $("#sele_product_id").val();

       if(id != 0 || id != null){
            $.get('{{route('get_product_details_by_id')}}', {id:id}, function(data){
                document.getElementById('sales_price').value = data.price_per_unite;
                let date = new Date().toISOString().slice(0, 10);
                document.getElementById('offer_mrp').value = "";
                if(data.offer != 0 && data.expire_date >= date)
                    document.getElementById('offer_mrp').value = data.offer_mrp;
                if(data.unit)document.getElementById('unit').value = data.unit;
            });
       }
    }
</script>


<script>
    function payment(){
        let total = document.getElementById('total').value;
        let paid = document.getElementById('paid').value;
        if(!paid){ paid = 0;}

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
    var canPurchaseOnCredit = 0;
    var employeId = 0;
    var employe;
    var qty;
    function contienueToAddSel(){

        employeId = document.getElementById('employe_id').value;
        employeId = employeId.trim();

        document.getElementById('EmployeI_ID').value = employeId;

        if(employeId !="" && employeId != 0){

            $.get('{{ route('get_purchase_limite') }}',{employeId:employeId}, function(data){

                canPurchaseOnCredit = data.canPurchaseOnCredit;
                employe =  data.employe;

                    document.getElementById('seles_header').style.display = "none";
                    document.getElementById('sales_container').classList.remove("d-none");

                    // document.getElementById('id_no').value = employe.contact_number;
                    document.getElementById('name').innerHTML = employe.name;
                    document.getElementById('designation').innerHTML = employe.designation;
                    // document.getElementById('department').value = employe.depertment;
                    // document.getElementById('salary').value = employe.salary;

                    document.getElementById('creditPurchaseLimit').value = parseFloat(canPurchaseOnCredit > 0 ? canPurchaseOnCredit : 0);
                    // canPurchaseOnCredit -= data.cartCredit;

                    $.get('{{ route('add_seles_form') }}',{employeId:employeId}, function(data){

                        qty = data['qty'];


                        document.getElementById('total').value = data.total;
                        document.getElementById('due').value = data.total;
                        document.getElementById('change').value = 0;
                        document.getElementById('paid').value = 0;
                        document.getElementById('seles_details').innerHTML = data['table'];
                        document.getElementById('cart_table').classList.remove("d-none");
                        var table = document.getElementById("seles_details");
                        var rows = table.getElementsByTagName("tr");
                        if(rows.length == 0){
                            document.getElementById('cart_table').classList.add("d-none");
                        }

                    });

            });

        }

    }
</script>

<script>
    function quantityTracking(data = null){
        numberInputTracking('sales_quantity');
        if(data != null)setPrice(data);
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
        if(offer_mrp != ""){price = offer_mrp;}
        quantity = document.getElementById('sales_quantity').value;



        price = price.trim();
        quantity = quantity.trim();
        if($.isNumeric(price) && $.isNumeric(quantity) && productId != 0) {
            total = price * quantity;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });


                $.get('{{route('get_product_avable_quantity')}}',{productId:productId}, function(data){


                    if(qty[productId] !== undefined){data = (parseFloat(data) - parseFloat(qty[productId])); }

                    if(data>=parseFloat(quantity)){

                        $.post('{{route('add_seles_to_cart')}}', {
                            employeId:employeId,
                            productId:productId,
                            unit:unit,
                            price:price,
                            quantity:quantity,
                        },
                        function(data){



                            if(data == "success"){



                                $.get('{{route('add_seles_form')}}',{employeId:employeId}, function(data){
                                    qty = data['qty'];

                                    document.getElementById('total').value = data['total'];
                                    let paid = document.getElementById('paid').value;
                                    if(paid == null || paid == "") paid = 0;
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
                                document.getElementById('offer_mrp').value = "";
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
    function deleteSelesItem(id){
        $.get('{{route('delete_add_seles_item')}}',{id:id, employeId:employeId}, function(data){


            qty = data.rows.original.qty;
            document.getElementById('seles_details').innerHTML = data.rows.original.table;


            document.getElementById('total').value = data.rows.original.total;
            let paid = document.getElementById('paid').value;
            if(paid == null || paid == "") paid = 0;
            if(parseFloat(paid) <= data.rows.original.total){
                document.getElementById('due').value = data.rows.original.total - parseFloat(paid);
                document.getElementById('change').value = 0;
            }

            if(parseFloat(paid) >= data.rows.original.total){
                document.getElementById('change').value = parseFloat(paid) - data.rows.original.total;
                document.getElementById('due').value = 0;
            }

            var table = document.getElementById("seles_details");
            var rows = table.getElementsByTagName("tr");
            if(rows.length == 0){
                document.getElementById('cart_table').classList.add("d-none");
            }


        });
    }
</script>

<script>
    function formSubmit(){
        let due = document.getElementById('due').value;
        if(due == null || due == "") due = 0;
        if(parseFloat(canPurchaseOnCredit) >= parseFloat(due)){
            document.getElementById('selesForm').submit();
        }
        else{
            Warning('','Can\'t make this sale on Due');
        }
    }
</script>
@endsection
