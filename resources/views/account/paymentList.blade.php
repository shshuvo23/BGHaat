@extends('layouts.templete')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
@endsection
@section('body_title')
<h4 class="header-title">Payment List</h4>
@endsection

@section('content')

<div class="container">
    <div class="table-rep-plugin">
        <div class="table-responsive mb-0" data-pattern="priority-columns">
            <table id="tech-companies-1" class="table table-striped">
                <thead>
                    <tr>
                    <th >#</th>
                    <th data-priority="1">Name</th>
                    <th data-priority="2">Contact Number</th>
                    <th data-priority="3">Amount</th>
                    <th data-priority="3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    @foreach($employePayment as $payment)
                    <tr>
                        <th >{{$i++;}}</th>
                        <td>{{$payment->name}}</td>
                        <td>{{$payment->contact_number}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>{{$payment->created_at->format('d M Y')}}</td>
                    </tr>
                    @endforeach

                    @foreach($customerPayment as $payment)
                    <tr>
                        <th >{{$i++;}}</th>
                        <td>{{$payment->name}}</td>
                        <td>{{$payment->contact_no}}</td>
                        <td>{{$payment->created_at->format('d M Y')}}</td>
                    </tr>
                    @endforeach



                </tbody>
            </table>
    </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#tech-companies-1').DataTable();
    });
</script>
@endsection
