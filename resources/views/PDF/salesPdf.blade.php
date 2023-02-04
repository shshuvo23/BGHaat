

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>


<style>
    .mx-5{
        margin-left: 5rem;
        margin-right: 5rem;
    }

    table {
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
    }

    table tr {
        border: 1px solid rgb(0, 0, 0);
        border-top: 1px solid rgb(0, 0, 0);
    }
    table, th, td {
        border-left: 1px solid rgb(0, 0, 0);
        border-right: 1px solid rgb(0, 0, 0);
        font-size: 10px;
        text-align: center;
        padding: 3px;
    }
    .spn{
        border: 1px solid rgb(0, 0, 0);
        margin: 0px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .spnl{
        border-left: none;
    }


</style>

</head>
<body class="bg-dark" style="display: flex; justify-content: center;">

<?php
use Illuminate\Support\Facades\DB;
if(auth()->user()->user_role != 'Admin'){
    $data['outlet'] = auth()->user()->outlet_id;
}
$total = 0;

$col = 11;


if(!((auth()->user()->user_role == 'Admin')&& ($data['outlet'] == 'all'))){$col--;}


if((($data['employe_customer'] == 'employe' && $data['employe_id'] != 'all')
    || ($data['employe_customer'] == 'customer' && $data['customer_id'] != 'all'))){
    $col -= 2;
}





$msg = 'All sales';

if($data['employe_customer'] != 'all'){

    if($data['employe_customer'] == 'employe'){
        if($data['employe_id'] == 'all'){
            $msg .=' to employees';
            $msg = "<p style='font-size: 12px; text-align: center '>$msg</p>";
        }
        else{
            $employe = DB::table('employes')->where('id', $data['employe_id'])->first();
            $msg .=' to '.$employe->name;
            $msg = "<p style='font-size: 12px; text-align: center '>$msg </p><p style='font-size: 12px; text-align: center '> Id: $employe->id_card_number</p>";
        }
    }
   if($data['employe_customer'] == 'customer'){
        if($data['customer_id'] == 'all'){
            $msg .=' to customers';
            $msg = "<p style='font-size: 12px; text-align: center '>$msg</p>";
        }
        else{
            $customer = DB::table('customers')->where('id', $data['customer_id'])->first();
            $msg .=' to '.$customer->name;
            $msg = "<p style='font-size: 12px; text-align: center '>$msg</p><p style='font-size: 12px; text-align: center '> Contact No: $customer->contact_no</p>";
        }
   }
}


if($data['outlet'] != 'all'){
    $outletName = DB::table('outlets')->where('id', $data['outlet'])->first()->name;
    $msg .= "<p style='font-size: 12px; text-align: center '> Outlet: $outletName</p>";
}
?>








<h3 style="text-align: center">BG Haat Live Shop</h3>
<p style='font-size: 12px; text-align: center '><?php echo $msg;?> </p>


<h5></h5>

<table class="table my-3" style="border: none;">
    <thead class="thead-dark bg-dark text-white">
        <tr>
            <th scope="col">#</th>
            {{-- <th scope="col">ID</th> --}}


            <th data-priority="3">Date:</th>

            <th data-priority="1">Invoice No</th>

             @if(!(($data['employe_customer'] == 'employe' && $data['employe_id'] != 'all')
             || ($data['employe_customer'] == 'customer' && $data['customer_id'] != 'all')))
                <th data-priority="4">Customer Name:</th>
                <th data-priority="4">Contact No:</th>
            @endif



            @if(auth()->user()->user_role == 'Admin' && $data['outlet'] == 'all')

                <th data-priority="3">Outlet Name:</th>

            @endif

            <th data-priority="1">Product name:</th>

            <th data-priority="2">Price Per Unite:</th>
            <th data-priority="2">Quentity:</th>
            <th data-priority="2">Total:</th>
            </tr>
    </thead>
    <tbody id="sales_list">


        <?php $i = 1; $j = 1; $sp = " ";?>
        @if($data['employe_customer'] == 'all' || $data['employe_customer'] == 'employe')
            @foreach($sales as $sal)
                @if($data['from_date'] <= $sal->date  && $sal->date <= $data['to_date'])
                    @if($data['outlet'] == 'all' || $sal->outlet_id == $data['outlet'])

                            @if($data['employe_id'] == 'all' || $sal->employe_id == $data['employe_id'])

                                @php
                                    $total += ($sal->price_per_unite * $sal->quantity);
                                @endphp

                                <tr>
                                    <th scope="row">{{$i++}}</th>

                                    <td>{{$sal->date}}</td>
                                    <td>{{$sal->sales_no}}</td>

                                    @if(!(($data['employe_customer'] == 'employe' && $data['employe_id'] != 'all')
                                    || ($data['employe_customer'] == 'customer' && $data['customer_id'] != 'all')))
                                    <td>{{$sal->employe_name}}</td>
                                    <td>{{$sal->contact_number}}</td>
                                    @endif



                                    @if(auth()->user()->user_role == 'Admin' && $data['outlet'] == 'all')
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
            @if($data['from_date'] <= $customerSal->date  && $customerSal->date <= $data['to_date'])
                @if($data['outlet'] == 'all' || $customerSal->outlet_id == $data['outlet'])

                        @if($data['customer_id'] == 'all' || $customerSal->customer_id == $data['customer_id'])

                        @php
                            $total += ($customerSal->price_per_unite * $customerSal->quantity);
                        @endphp


                            <tr>
                                <th scope="row">{{$i++;}}</th>

                                <td>{{$customerSal->date}}</td>
                                <td>{{$customerSal->sales_no}}</td>

                                @if(!(($data['employe_customer'] == 'employe' && $data['employe_id'] != 'all')
                                || ($data['employe_customer'] == 'customer' && $data['customer_id'] != 'all')))
                                <td>{{$customerSal->customer_name}}</td>
                                <td>{{$customerSal->contact_no}}</td>
                                @endif



                                @if(auth()->user()->user_role == 'Admin' && $data['outlet'] == 'all')
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

        <tr style=" margin: 0px; padding: 0px;">
            <td colspan="{{ $col-2}}" style="border: none; margin: 0px; padding: 0px;"></td>

            <td style="border: none;">Total: {{$total}}</td>

        </tr>

    </tbody>
  </table><br>
  <div style=" padding: 20px;"></div>
  <div style="position: absolute; bottom: 0px; left: 0px; right: 0px; ">
    <p style="font-size: 12px; padding: 0px; margin: 0px; padding-top: 20px;">--------------------------</p>
    <p style="font-size: 12px; padding: 0px; margin: 0px;">Authorized signature</p><br><br>
    <p style="font-size: 12px; text-align: center;">House #47,Road #07, Nikunja-1, Khilkhet, Dhaka-1229</p>
    <p style="font-size: 12px; text-align: center;">Email : support@bghaat.com, Phone : +880 1787663280</p>
  </div>

</body>
</html>



{{--  <tr style="border: none; margin: 0px; padding: 0px;">
            <td colspan="{{ $col-1}}" style="border: none; margin: 0px; padding: 0px;"></td>
            <td  style="border: none; margin: 0px; padding: 0px;">
                <div style="">

                    <table>
                        <thead>
                            @if($data['type'] == 'all')
                                <tr>
                                    <td>Cash: </td>
                                    <td>{{$cash}}</td>
                                </tr>
                                <tr>
                                    <td>Credit: </td>
                                    <td>{{$credit}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Total: </td>
                                <td>{{$cash + $credit}}</td>
                            </tr>
                        </thead>
                    </table>

                </div>
            </td>

        </tr> --}}
