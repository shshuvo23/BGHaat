@extends('layouts.templete')
@section('css')

<link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('invoice')}}/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('invoice/')}}/css/all.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('invoice/')}}/css/stylesheet.css"/>
@endsection
@section('body_title')
<h4 class="header-title">Invoice View</h4>
@endsection

@section('content')




<div class="container d-print-none">
    <table id="invoice_table" class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Id No</th>
            <th scope="col">Contact No</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        <tbody>
            <style>
                .invoice-item{
                    cursor: pointer;
                }
                .invoice-item:hover{
                    background-color: #1aec1a !important;
                }
            </style>

            @foreach ($data as $key => $invoice)
            <tr style="cursor: pointer; " class="invoice-item" onclick="getInvoice({{$invoice['invoice_id']}})" data-toggle="modal" data-target=".bd-example-modal-lg">
                <th scope="row">{{$key+1}}</th>
                <td>{{$invoice['invoice_no']}}</td>
                <td>{{$invoice['employe_name']}}</td>
                <td>{{$invoice['employe_id']}}</td>
                <td>{{$invoice['contact_no']}}</td>
                <td>{{$invoice['date']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div id="modal-dialog" class=" modal-lg" style="margin: 0px auto !important; padding: 0px !important; width: 100%; !important">
      <div class="modal-content" style="margin: 0px !important; padding: 0px !important; width: 100%; !important">
        <div class="row m-0 p-0" style="margin: 0px !important; padding: 0px !important; width: 100%; !important">
            <div id="invoice_view"  class="col m-0 p-0" style="margin: 0px !important; padding: 0px !important; width: 100%; !important">

            </div>
        </div>
      </div>
    </div>
</div>








@endsection



@section('js')


    <script>
        $( document ).ready(function() {

            window.onclick = function(event) {

                if (event.target.id == "modal") {
                    location.reload();

                    //$('#invoice_table').load();
                    // $('body').load('http://127.0.0.1:8000/login');

                    // element = document.getElementById('modal');
                    // element.classList.remove('show');
                    // element.style.display = 'none';
                    // element.style.padding = '0px';

                    // colection = document.getElementsByClassName('modal-backdrop');
                    // element = colection[0];

                    // element.removeAttribute('class');

                }
            }



        });
    </script>

    <script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#invoice_table').DataTable();
        });
    </script>
    <script>
        function getInvoice(invoiceId){
            //console.log(invoiceNo);
            //invoiceNo = document.getElementById('invoice_number').value;
            $.get('{{route('get_invoice_view')}}', {invoiceId:invoiceId}, function(data){
                //console.log(data);

                 document.getElementById('invoice_view').innerHTML = data;
                 document.getElementById('dashboard_link').classList.add('d-none');
            });
        }
    </script>
    <script>
        function ck(){


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

    }
    </script>
@endsection

