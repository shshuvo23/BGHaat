


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="images/favicon.png" rel="icon" />
<title>General Invoice - BG Haat</title>
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
<script src="https://kit.fontawesome.com/4d3ac0cc3b.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<!-- Stylesheet
======================= -->
<link rel="stylesheet" type="text/css" href="{{asset('invoice')}}/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('invoice/')}}/css/all.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('invoice/')}}/css/stylesheet.css"/>
<style>
    td{
        margin: 0px !important;
        padding: 0px !important;
    }
    body{
        margin: 0px !important;
        padding: 0px !important;
        line-height: 18px;
    }
    .mp-0{
        margin: 0px !important;
        padding: 0px !important;
    }

</style>

</head>
<body>



{{-- modal --}}

@php
    $carte = Session::get('carte');
    Session::forget('carte');
@endphp

@if(isset($carte) && count($carte)>0)
    <div class="modal fade show" id="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="padding-right: 0px; display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title" id="exampleModalCenterTitle">your required quantity is not available for those product below.</p>

        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                  <tr>
                    <th >#</th>

                    <th ><strong>Product Name</strong></th>
                    <th ><strong>Rate</strong></th>
                    <th ><strong>QTY</strong></th>
                    <th ><strong>Amount</strong></th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $j = 1;
                    @endphp
                    @foreach ($carte as $cart)
                        @php
                            $Price = ($cart->offer && $cart->expire_date >= date('Y-m-d')) ? $cart->offer_mrp : $cart->price_per_unite;
                        @endphp
                        <tr>
                                <td class="">{{$j++}}</td>

                                <td class="col-4 ">{{$cart->name}}</td>
                                <td class="col-2 text-center">৳{{$Price}}</td>
                                <td class="col-1 text-center">{{$cart->quantity}}</td>
                                <td class="col-2 text-end">৳{{$cart->quantity * $Price}}</td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeDialog()" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
        <div  id="shadow" class="modal-backdrop fade show"></div>
@endif

<!-- Container -->













<div class="row d-print-none" id="dashboard_link">
    <div class="col" style=" margin: 15px auto; max-width: 850px;">
        <a href="{{route('home')}}" class="btn btn-secondary">Go to Dashbord</a>
    </div>
</div>






























<div id="invoice">


    <div  class="container-fluid invoice-container " style="  margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">

        <!-- Header -->
        <header style="font-size: 10px;" class="mp-0 ">
            <div style="height: 10px;"></div>
          <div class="row align-items-center mp-0">
            <div class="col-sm-3 text-center text-sm-start mb-sm-0 " >
              <img id="logo" src="{{asset('templet/assets/images/logo.png')}}" style="height: 2rem; width: 5rem; margin-ledt: 0px; margin-top: 10px;" title="Koice" alt="Koice" />
            </div>
            <div class="col-sm-6 text-center">
              <h6 class=" mb-0">Invoice({{$carts[0]->invoice_no}})</h6>
              <span>(Customer Slip)</span>
            </div>
            <div class="col-sm-3 text-center text-sm-end">
                <div class=" mb-0"><strong>Date: </strong>{{isset($carts[0]->date)?$carts[0]->date : date('d-m-Y')}}</div>
            </div>
          </div>
          <hr style="margin: 0px !important;">
          </header>



          <!-- Main Content -->
          <main style="font-size: 10px;">
          <div class="row">
            <div class="col-sm-6 text-sm-end order-sm-1" > <strong >Pay To:</strong>
              <address >
              GB Haat Live Shop<br />
              {{$outlet->name}}<br />
              {{$outlet->address}}<br />
              {{-- support@bghaat.com --}}
              </address>
            </div>
            <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                @if(isset($employe))
                    <address>
                    {{$employe->name}}<br />
                        @if(isset($employe->id_card_number))
                        Id: {{$employe->id_card_number}}<br />
                        @endif
                        @if(isset($employe->contact_number))
                        Contact No: {{$employe->contact_number}}
                        @endif
                        @if(isset($employe->contact_no))
                        Contact No: {{$employe->contact_no}}
                        @endif
                    </address>
                 @endif
            </div>
          </div>

          <div class="card" style=" margin: 0px; padding: 0px;">
            <div class="card-body p-0" >
              <div class="table-responsive" style=" margin: 0px; padding: 0px;">
                <table class="table mb-0" >
                <thead class="card-header" style="font-size: 10px;">
                  <tr style="padding: 0px; margin: 0px;">
                      <td class=""><strong>SL</strong></td>
                    {{-- <td class="col-2"><strong>Salse Type</strong></td> --}}
                    <td class="col-4"><strong>Product Name</strong></td>
                    <td class="col-2 text-center"><strong>Rate</strong></td>
                    <td class="col-1 text-center"><strong>QTY</strong></td>
                    <td class="col-2 text-end"><strong>Amount</strong></td>
                  </tr>
                </thead>
                  <tbody style="font-size: 10px;">
                      <?php $total = 0; $i=1;?>


                    @foreach($carts as $cart)
                        @php

                                $total += ($cart->quantity * $cart->price_per_unite);

                        @endphp
                        <tr>
                        <td class="">{{$i++}}</td>

                        <td class="col-4 ">{{$cart->name}}</td>
                        <td class="col-2 text-center">৳{{$cart->price_per_unite}}</td>
                        <td class="col-1 text-center">{{$cart->quantity}}</td>
                        <td class="col-2 text-end">৳{{$cart->quantity * $cart->price_per_unite}}</td>
                        </tr>
                    @endforeach

                  @for ($i=0; $i<(14 - count($carts)); $i++ )
                      <tr style="height: 20px;">
                          <td ></td>
                          <td ></td>
                          <td ></td>
                          <td ></td>
                          <td ></td>

                      </tr>
                  @endfor

                  </tbody>
                  <tfoot class="card-footer" style="font-size: 10px; ">
                    <tr>

                        <td colspan="2" class="text-end border-bottom-0"><strong>Total: ৳{{$carts[0]->invoice_total}}</strong></td>
                        <td  colspan="2" class="text-end"><strong>Paid: ৳{{$carts[0]->paid}}</strong></td>
                        <td  class="text-end"><strong>Credit: ৳{{$carts[0]->invoice_total - $carts[0]->paid}}</strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          </main>
          <!-- Footer -->
          <footer class="text-center mt-4" style="font-size: 10px;">
          {{-- <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p> --}}

          </footer>
      </div>






    {{-- ************************************** --}}




    <div  class="container-fluid invoice-container " style=" margin-top: 5px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">

        <!-- Header -->
        <header style="font-size: 10px;" class="mp-0 ">
            <div style="height: 15px;"></div>
          <div class="row align-items-center mp-0">
            <div class="col-sm-3 text-center text-sm-start mb-sm-0 " >
              <img id="logo" src="{{asset('templet/assets/images/logo.png')}}" style="height: 2rem; width: 5rem; margin-ledt: 0px; margin-top: 10px;" title="Koice" alt="Koice" />
            </div>
            <div class="col-sm-6 text-center">
              <h6 class=" mb-0">Invoice({{$carts[0]->invoice_no}})</h6>
              <span>(office Slip)</span>
            </div>
            <div class="col-sm-3 text-center text-sm-end">
                <div class=" mb-0"><strong>Date: </strong>{{isset($carts[0]->date)?$carts[0]->date : date('d-m-Y')}}</div>
            </div>
          </div>
          <hr style="margin: 0px !important;">
          </header>



          <!-- Main Content -->
          <main style="font-size: 10px;">
          <div class="row">
            <div class="col-sm-6 text-sm-end order-sm-1" > <strong >Pay To:</strong>
              <address >
              GB Haat Live Shop<br />
              {{$outlet->name}}<br />
              {{$outlet->address}}<br />
              {{-- support@bghaat.com --}}
              </address>
            </div>
            <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                @if(isset($employe))
              <address>
              {{$employe->name}}<br />
                @if(isset($employe->id_card_number))
                Id: {{$employe->id_card_number}}<br />
                @endif
                @if(isset($employe->contact_number))
                  Contact No: {{$employe->contact_number}}
                @endif
                @if(isset($employe->contact_no))
                  Contact No: {{$employe->contact_no}}
                @endif
              </address>
              @endif
            </div>
          </div>

          <div class="card" style=" margin: 0px; padding: 0px;">
            <div class="card-body p-0">
              <div class="table-responsive" style=" margin: 0px; padding: 0px;">
                <table class="table mb-0">
                <thead class="card-header" style="font-size: 10px;">
                   <tr style="padding: 0px; margin: 0px;">
                      <td class=""><strong>SL</strong></td>
                    {{-- <td class="col-2"><strong>Salse Type</strong></td> --}}
                    <td class="col-4"><strong>Product Name</strong></td>
                    <td class="col-2 text-center"><strong>Rate</strong></td>
                    <td class="col-1 text-center"><strong>QTY</strong></td>
                    <td class="col-2 text-end"><strong>Amount</strong></td>
                  </tr>

                </thead>
                  <tbody style="font-size: 10px;">
                      <?php $total = 0; $i=1;?>
                      @foreach ($carts as $cart)
                        @php


                            $total += ($cart->quantity * $cart->price_per_unite);

                        @endphp
                        <tr>
                        <td class="">{{$i++}}</td>

                        <td class="col-4 ">{{$cart->name}}</td>
                        <td class="col-2 text-center">৳{{$cart->price_per_unite}}</td>
                        <td class="col-1 text-center">{{$cart->quantity}}</td>
                        <td class="col-2 text-end">৳{{$cart->quantity * $cart->price_per_unite}}</td>
                        </tr>

                    @endforeach

                    @for ($i=0; $i<(14 - count($carts)); $i++ )
                        <tr style="height: 20px;">
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>

                        </tr>
                    @endfor

                  </tbody>
                  <tfoot class="card-footer" style="font-size: 10px; ">
                    <tr>

                        <td colspan="2" class="text-end border-bottom-0"><strong>Total: ৳{{$carts[0]->invoice_total}}</strong></td>
                        <td colspan="2" class="text-end"><strong>Paid: ৳{{$carts[0]->paid}}</strong></td>
                        <td  class="text-end"><strong>Credit: ৳{{$carts[0]->invoice_total - $carts[0]->paid}}</strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          </main>
          <!-- Footer -->
          <footer  style="font-size: 10px; margin: 0px; padding: 0px;">

            <p style="margin: 0px; padding: 0px;">-------------------</p>
            <p style="margin: 0px; padding: 0px;">Customer Signature </p>
          {{-- <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p> --}}

          </footer>
    </div>
</div>






















































{{-- *************************** --}}






<div class="container-fluid" style="display: flex; justify-content: center;">
    <div class="btn-group btn-group-sm d-print-none">
        <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
        <a onclick="ck()"  class="btn btn-light border text-black-50 shadow-none" id="download"><i class="fa fa-download"></i> Download</a>
    </div>
</div>




<script>
    function closeDialog(){
        document.getElementById('dialog').classList.remove('show');
        document.getElementById('shadow').classList.remove('show');
        window.location.href = window.location.href;
    }
</script>

<script>
    window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            // console.log(invoice);
            // console.log(window);
            var opt = {
                margin: 1,
                filename: 'invoice.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(invoice).set(opt).save();
        })
}
</script>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
