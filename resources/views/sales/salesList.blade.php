@extends('layouts.templete')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
<style>
    .select2_hight{
        height: 2rem !important;
       width: 100% !important;
       min-width: 10rem !important;
    }
</style>
@endsection
@section('body_title')
<h4 class="header-title">Sales List</h4>
@endsection
@section('content')

            <div class="container">
                <form id="Search_data_form" action="{{route('get_sales_list_table')}}" method="get">
                    @csrf

                    <div class="row my-5">

                        <div class="col-12 col-xl-6" style="font-size: 12px; font-weight: bold;">
                            <div class="row">

                                <div class="col-12 col-sm-5 " id="date_section">
                                    <label  for="">From</label>
                                    <input style="font-size: 12px;" id="from_date" name="from_date"  value="{{$data['from_date']}}" onChange="getTableData('from_date')" class="form-select " type="date">
                                </div>
                                <div class="col-12 col-sm-5 " id="date_section">
                                    <label  for="">To</label>
                                    <input style="font-size: 12px;" id="to_date" name="to_date"  value="{{$data['to_date']}}" onChange="getTableData('to_date')" class="form-select " type="date">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-6" style="font-size: 12px; font-weight: bold;">
                            <div class="row">
                                @if(auth()->user()->user_role == "Admin")
                                <div class="col-12 col-sm-4">
                                    <label for="">Outlet</label>
                                        <select style="font-size: 12px;" onChange="getTableData('outlet')" id="outlet" name="outlet" class="form-select" aria-label="Outlet">
                                        <option {{$data['outlet'] == 'all'?'selected':''}} value="all">All</option>

                                        @foreach($outlets as $outlet)
                                            <option {{$data['outlet'] == $outlet->id?'selected':''}} value="{{$outlet->id}}">{{$outlet->name}}({{$outlet->address}})</option>
                                        @endforeach

                                    </select>
                                </div>
                                @endif

                                <div class="col-12 col-sm-4">
                                    <label for="employe_customer">Employee/Customer</label>
                                    <select style="font-size: 12px;" onChange="getTableData('EC')" id="employe_customer" name="employe_customer" class="form-select" aria-label="EC">
                                        <option {{$data['employe_customer'] == 'all'?'selected':''}} value="all">All</option>
                                        <option {{$data['employe_customer'] == 'employe'?'selected':''}} value="employe">Employee</option>
                                        <option {{$data['employe_customer'] == 'customer'?'selected':''}} value="customer">Customer</option>
                                    </select>

                                </div>

                                <div class="col-12 col-sm-4 d-none" id="employe_section">
                                    <label for="employe_id">Employee</label><br>
                                    <select style="font-size: 12px;" onChange="getTableData('employe')" id="employe_id" name="employe_id" class="form-select" aria-label="employe_id">
                                        <option {{$data['employe_id'] == 'all'?'selected':''}} value="all">All</option>

                                        @foreach($employes as $employe)
                                            <option {{$data['employe_id'] == $employe->id?'selected':''}} value="{{$employe->id}}">{{$employe->id_card_number}}:{{$employe->name}}-{{$employe->contact_number}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-12 col-sm-4 d-none" id="customer_section">
                                    <label for="customer_id">Customer</label><br>
                                    <select style="font-size: 12px;" onChange="getTableData('customer')" id="customer_id" name="customer_id" class="form-select" aria-label="customer_id">
                                        <option {{$data['customer_id'] == 'all'?'selected':''}} value="all">All</option>
                                        @foreach ($customers as $customer)
                                            <option {{$data['customer_id'] == $customer->id?'selected':''}} value="{{$customer->id}}">{{$customer->name}}({{$customer->contact_no}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>




                        <div class="d-flex justify-content-end"><button onclick="downloadPDF()" class="btn btn-primary my-2">Download PDF</button></div>
                    </div>
                </form>





                <div >
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped">
                                <thead>

                                    <tr>
                                        <th scope="col">#</th>
                                        {{-- <th scope="col">ID</th> --}}


                                        <th data-priority="3">Date:</th>

                                        <th data-priority="3">Invoice No:</th>
                                         @if(!(($data['employe_customer'] == 'employe' && $data['employe_id'] != 'all')
                                         || ($data['employe_customer'] == 'customer' && $data['customer_id'] != 'all')))
                                            <th data-priority="4">Customer Name:</th>
                                            <th data-priority="4">ID No:</th>
                                        @endif


                                        @if((($data['employe_customer'] == 'employe' && $data['employe_id'] == 'all')
                                            || ($data['employe_customer'] == 'customer' && $data['customer_id'] == 'all')
                                            || ($data['employe_customer'] == "all")) &&  auth()->user()->user_role == 'Admin' && $data['outlet'] == 'all')

                                            <th data-priority="3">Outlet Name:</th>

                                        @endif

                                        <th data-priority="1">Product name:</th>

                                        <th data-priority="2">Price Per Unite:</th>
                                        <th data-priority="2">Quentity:</th>
                                        <th data-priority="2">Total:</th>
                                        </tr>
                                </thead>
                                <tbody id="sales_list">
                                    <?php $i = 1; ?>
                                    @if($data['employe_customer'] == 'all' || $data['employe_customer'] == 'employe')

                                    @foreach($sales as $sal)

                                            @if($data['outlet'] == 'all' || $sal->outlet_id == $data['outlet'])
                                                @if($data['employe_id'] == 'all' || $sal->employe_id == $data['employe_id'])
                                                    @if($data['from_date'] <= $sal->date  && $sal->date <= $data['to_date'])
                                                    <tr>
                                                        <th scope="row">{{$i++}}</th>
                                                        {{-- <th scope="row">{{$sal->id}}</th> --}}

                                                        <td>{{$sal->date}}</td>

                                                        <td>{{$sal->sales_no}}</td>

                                                        @if(!(($data['employe_customer'] == 'employe' && $data['employe_id'] != 'all')
                                                        || ($data['employe_customer'] == 'customer' && $data['customer_id'] != 'all')))
                                                        <td>{{$sal->employe_name}}</td>
                                                        <td>{{$sal->contact_number}}</td>
                                                        @endif

                                                        @if((($data['employe_customer'] == 'employe' && $data['employe_id'] == 'all')
                                                        || ($data['employe_customer'] == 'customer' && $data['customer_id'] == 'all')
                                                        || ($data['employe_customer'] == "all")) &&  auth()->user()->user_role == 'Admin' && $data['outlet'] == 'all')
                                                        <td>{{$sal->outlet_name}}</td>
                                                        @endif



                                                        <td>{{$sal->product_name}}</td>



                                                        <td>{{$sal->price_per_unite}}</td>
                                                        <td>{{$sal->quantity}}</td>

                                                        <td>{{$sal->price_per_unite * $sal->quantity}}</td>
                                                    </tr>

                                                    @endif
                                                @endif
                                            @endif

                                    @endforeach
                                    @endif


                                    @if($data['employe_customer'] == 'all' || $data['employe_customer'] == 'customer')
                                    @foreach($customerSales as $customerSal)

                                            @if($data['outlet'] == 'all' || $customerSal->outlet_id == $data['outlet'])
                                                @if($data['from_date'] <= $customerSal->date  && $customerSal->date <= $data['to_date'])
                                                    @if($data['customer_id'] == 'all' || $customerSal->customer_id == $data['customer_id'])
                                                        <tr>
                                                            <th scope="row">{{$i++;}}</th>

                                                            <td>{{$customerSal->date}}</td>

                                                            <td>{{$customerSal->sales_no}}</td>

                                                            @if(!(($data['employe_customer'] == 'employe' && $data['employe_id'] != 'all')
                                                            || ($data['employe_customer'] == 'customer' && $data['customer_id'] != 'all')))
                                                            <td>{{$customerSal->customer_name}}</td>
                                                            <td>{{$customerSal->contact_no}}</td>
                                                            @endif

                                                            @if((($data['employe_customer'] == 'employe' && $data['employe_id'] == 'all')
                                                                || ($data['employe_customer'] == 'customer' && $data['customer_id'] == 'all')
                                                                || ($data['employe_customer'] == "all")) &&  auth()->user()->user_role == 'Admin' && $data['outlet'] == 'all')
                                                            <td>{{$customerSal->outlet_name}}</td>
                                                            @endif


                                                            <td>{{$customerSal->product_name}}</td>


                                                            <td>{{$customerSal->price_per_unite}}</td>
                                                            <td>{{$customerSal->quantity}}</td>

                                                            <td>{{$customerSal->price_per_unite * $customerSal->quantity}}</td>
                                                        </tr>



                                                    @endif

                                                @endif
                                            @endif

                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                 <!-- model for view dales detailes -->

                 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-success text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sales Details</h5>

                        </div>
                        <form method="post" action="">
                            @csrf
                        <div class="modal-body ">

                                <div class="form-group">
                                    {{-- <input type="text" id="id" name="id" hidden> --}}
                                    <div class="row">
                                        <div class="col">
                                                <label for="" class="col-form-label">Product Name:</label>
                                                <input type="text" class="form-control" id="product_name" name="product_name" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                                <label for="" class="col-form-label">Price Per Unite:</label>
                                                <input type="text" class="form-control" id="price_per_unite" name="price_per_unite" readonly>
                                        </div>
                                        <div class="col">
                                                <label for="" class="col-form-label">Quentity:</label>
                                                <input type="text" class="form-control" id="quantity" name="quantity" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                                <label for="" class="col-form-label">Total:</label>
                                                <input type="text" class="form-control" id="total" name="total" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="" class="col-form-label">Date:</label>
                                            <input type="text" class="form-control" id="dateShow" name="dateShow" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                                <label for="" class="col-form-label">Outlet Name:</label>
                                                <input type="text" class="form-control" id="outlet_name" name="outlet_name" readonly>
                                        </div>
                                        <div class="col">
                                                <label for="" class="col-form-label">Address:</label>
                                                <input type="text" class="form-control" id="address" name="address" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div id="employe" class="form-group d-none">
                                    <div class="row">
                                        <div class="col">
                                                <label for="" class="col-form-label">Employe Name:</label>
                                                <input type="text" class="form-control" id="employe_name" name="employe_name" readonly>
                                        </div>
                                        <div class="col">
                                                <label for="" class="col-form-label">ID No:</label>
                                                <input type="text" class="form-control" id="id_card_number" name="id_card_number" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div id="customer" class="form-group d-none" >
                                    <div class="row">
                                        <div class="col">
                                                <label for="" class="col-form-label d-block">Customer Name:</label>
                                                <input type="text" class="form-control" id="customer_name" name="customer_name" readonly>
                                        </div>
                                        <div class="col">
                                                <label for="" class="col-form-label">Contact No:</label>
                                                <input type="text" class="form-control" id="contact_no" name="contact_no" readonly>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{-- <button  type="submit" id="update_button" class="btn btn-primary">Update</button> --}}
                        </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- end modal -->



             </div>





@endsection

@section('js')

             <script>
                 $(document).ready(function() {
                    $('#employe_id').select2();
                    $('#customer_id').select2();

                    if(document.getElementById('employe_customer').value == 'employe'){
                        if(document.getElementById('employe_section').classList.contains('d-none'))
                        document.getElementById('employe_section').classList.remove('d-none');

                       document.getElementById('customer_section').classList.add('d-none');
                    }
                    if(document.getElementById('employe_customer').value == 'customer'){
                        document.getElementById('employe_section').classList.add('d-none');
                        if(document.getElementById('customer_section').classList.contains('d-none'))
                        document.getElementById('customer_section').classList.remove('d-none');
                    }

                   // document.getElementById('select2_id').classList.add('select2_hight');

                    const collection = document.getElementsByClassName("select2_id");
                    for (let i = 0; i < collection.length; i++) {
                        collection[i].classList.add('select2_hight');
                    }

                });
             </script>

        <script>
            function downloadPDF(){
                //alert(document.getElementById('sales_list').innerHTML);

                document.getElementById("Search_data_form").action = "{{route('salesPdf')}}";
                document.getElementById("Search_data_form").setAttribute("method", "GET");
                document.getElementById('Search_data_form').submit();


            }
        </script>



        <script>

            function getTableData(str){




                fromDate = document.getElementById('from_date').value;
                toDate = document.getElementById('to_date').value;

                employe_customer = document.getElementById('employe_customer').value;

                employeId = document.getElementById('employe_id').value;
                cuestomerId = document.getElementById('customer_id').value;


                if(employe_customer == 'all'){
                    document.getElementById('employe_section').classList.add('d-none');
                    document.getElementById('customer_section').classList.add('d-none');

                    $('#employe_section').removeAttr('selected').find('option:first').attr('selected', 'selected');
                    $('#customer_section').removeAttr('selected').find('option:first').attr('selected', 'selected');
                    document.getElementById('employe_section').value = 'all';
                    document.getElementById('customer_section').value = 'all';
                }
                else{
                    if(employe_customer == 'employe'){
                        if(document.getElementById('employe_section').classList.contains('d-none'))
                        document.getElementById('employe_section').classList.remove('d-none');
                        $('#customer_section').removeAttr('selected').find('option:first').attr('selected', 'selected');
                        document.getElementById('customer_section').classList.add('d-none');
                    }
                    if(employe_customer == 'customer'){
                        if(document.getElementById('customer_section').classList.contains('d-none'))
                        document.getElementById('customer_section').classList.remove('d-none');

                        document.getElementById('employe_section').classList.add('d-none');
                        $('#employe_section').removeAttr('selected').find('option:first').attr('selected', 'selected');
                    }
                }




                if(document.getElementById('outlet')){
                    outlet = document.getElementById('outlet').value;
                }
                else{outlet = null;}

                    //alert(outlet);
                    // $.get('{{route('get_sales_list_table')}}',{type:type,time:time,date:date,outlet:outlet}, function(data){

                    //     document.getElementById('sales_list').innerHTML = data;
                    // });

                    //
                    document.getElementById("Search_data_form").action = "{{route('get_sales_list_table')}}";
                    document.getElementById("Search_data_form").setAttribute("method", "GET");
                    document.getElementById('Search_data_form').submit();

            }
        </script>
        <script>
            function viewSalesDetails(sal){

                document.getElementById('sales_type').value = sal.seles_type;
                document.getElementById('product_name').value = sal.product_name;
                document.getElementById('price_per_unite').value = sal.price_per_unite;
                document.getElementById('quantity').value = sal.quantity;
                document.getElementById('total').value = (sal.price_per_unite * sal.quantity);
                document.getElementById('dateShow').value = sal.date;
                document.getElementById('outlet_name').value = sal.outlet_name;
                document.getElementById('address').value = sal.address;
                document.getElementById('employe').classList.remove("d-none");
                document.getElementById('customer').classList.add("d-none");
                document.getElementById('employe_name').value = sal.employe_name;
                document.getElementById('id_card_number').value = sal.id_card_number;
            }
            function viewCustomerSalesDetails(sal){
                //alert(sal);
                document.getElementById('sales_type').value = sal.seles_type;
                document.getElementById('product_name').value = sal.product_name;
                document.getElementById('price_per_unite').value = sal.price_per_unite;
                document.getElementById('quantity').value = sal.quantity;
                document.getElementById('total').value = (sal.price_per_unite * sal.quantity);
                document.getElementById('date').value = sal.date;
                document.getElementById('outlet_name').value = sal.outlet_name;
                document.getElementById('address').value = sal.address;
                document.getElementById('customer').classList.remove("d-none");
                document.getElementById('employe').classList.add("d-none");
                document.getElementById('customer_name').value = sal.customer_name;
                document.getElementById('contact_no').value = sal.contact_no;
            }
        </script>




            <script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready( function () {
                    $('#test').DataTable();
                    $('#tech-companies-1').DataTable();


                } );
            </script>

            <script>
                function onchange_dataTable_search(){
                    if(document.getElementById("display_all").classList.contains('btn-primary')){
                        document.getElementById("display_all").click();
                    }
                    document.getElementById("display_all").click();
                }

            </script>

        @endsection


