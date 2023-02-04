@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Dashboard</h4>
@endsection


@section('content')

<style>
    .tab:hover{
        background-color: white;
    }
</style>
<div class="container-fluid" style="margin-top: 8rem;">

    <div class="page-content-wrapper">



         <div class="row">
            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('add_sales_for_employe')}}"  class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">

                        <h4 class="inner-header-title">Sales to Employee</h4>

                        <div style=" margin-top: 15px;" class="text-black d-flex justify-content-center">
                            <img src="{{asset('images/employee_sal.png')}}" alt="" style="height: 65px; width: 65px;">
                        </div>

                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->
            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('add_sales_for_customer')}}" class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">

                        <h4 class="inner-header-title">Sales to Customer</h4>

                        <div style=" margin-top: 15px;" class="d-flex justify-content-center">
                            <img src="{{asset('images/customer-doing-shopping.png')}}" alt="" style="height: 70px; width: 75px;">
                        </div>

                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('seles_list')}}" class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">

                        <h4 class="inner-header-title d-flex">Sales List
                        </h4>

                        <div style=" margin-top: 10px;" class="d-flex justify-content-center">

                            <img src="{{asset('images/sales_list.png')}}" alt="" style="height: 70px; width: 60px;">
                        </div>

                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('invoice_view')}}" class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">


                        <h4 class="inner-header-title d-flex">Invoice

                        </h4>
                        <div style=" margin-top: 10px;" class="d-flex justify-content-center">
                            <img src="{{asset('images/invoice.png')}}" alt="" style="height: 75px; width: 65px;">
                        </div>

                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->


        </div>
        <!-- end row-->



        <div class="row">
            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('product_in_stock')}}"  class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">

                        <h4 class="inner-header-title">Products</h4>

                        <div style=" margin-top: 10px;" class="text-black d-flex justify-content-center">
                            <i class="dripicons-archive " style="font-size: 55px; color: #000;"></i>

                        </div>

                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->
            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('shift_product')}}" class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">

                        <h4 class="inner-header-title">Shift Product</h4>

                        <div style=" margin-top: 25px;" class="d-flex justify-content-center">
                            <img src="{{asset('images/shift.png')}}" alt="" style="height: 60px; width: 60px;">
                        </div>

                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('shift_request_page')}}" class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">

                        <h4 class="inner-header-title d-flex">Shifting Request
                            @if($pendingRequest > 0)
                            <sup><span class="badge rounded-pill bg-danger float-end ">{{$pendingRequest}}</span></sup>
                            @endif
                        </h4>
                        <div style=" margin-top: 25px;" class="d-flex justify-content-center">
                            <img src="{{asset('images/accept.png')}}" alt="" style="height: 70px; width: 70px;">
                        </div>


                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3 ">
                <a href="{{route('pending_product')}}" class="card tab shadow-lg" style="background-color: #ECECEC; height: 150px;">
                    <div class="card-body">


                        <h4 class="inner-header-title d-flex">Pending Products
                            @if($shiftRequest > 0)
                            <sup><span class="badge rounded-pill bg-danger float-end">{{$shiftRequest}}</span></sup>
                            @endif
                        </h4>
                        <div style=" margin-top: 0px;" class="d-flex justify-content-center">

                            <img src="{{asset('images/pending.svg')}}" alt="" style="height: 100px; width: 100px;">
                        </div>

                    </div> <!-- end card-body-->
                </a> <!-- end card-->
            </div> <!-- end col -->


        </div>
        <!-- end row-->




    </div>

</div>

{{-- @php

    function spc($n){
        for($i=0; $i<$n; $i++){
            echo '&nbsp;';
        }
    }

    function strp($n){
        for($i=0; $i<$n; $i++){
            echo '*';
        }
    }

    spc(9); echo '*'.'<br>';
    $msp = 1;
    for($i = 1; $i<=9; $i++){
        spc(9 - $i); echo '*';
        if($i==5){strp($msp-3);}
         else spc($msp);
          echo '*'.'<br>'; $msp += 2;
    }



@endphp --}}





@endsection




@section('js')

<script>

</script>

@endsection




