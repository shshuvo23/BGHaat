@extends('layouts.templete')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
@endsection
@section('body_title')
<h4 class="header-title">Due List</h4>
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
                            <th data-priority="3">Due</th>
                            <th data-priority="1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>

                            @foreach($customerAccounts as $account)
                            <tr>
                            <th >{{$i++;}}</th>
                            <td>{{$account->name}}</td>
                            <td>{{$account->contact_no}}</td>
                            <td>{{$account->due}}</td>
                            <td>

                                <a href="{{route('collect_payment',['customer',$account->customer_id])}}"    class="btn btn-success text-white" >Payment</a>

                            </td>
                            </tr>
                            @endforeach

                            @foreach($employeAccounts as $account)
                            <tr>
                            <th >{{$i++;}}</th>
                            <td>{{$account->name}}</td>
                            <td>{{$account->contact_number}}</td>
                            <td>{{$account->due}}</td>
                            <td>
                                <a href="{{route('collect_payment',['employe',$account->employe_id])}}"    class="btn btn-success text-white" >Payment</a>
                            </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
            </div>
        </div>


@endsection

@section('js')
    {{-- <script>
        function editUserDitails(user){
            document.getElementById('id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('option'+user.outlet_id).selected = true;
        }
    </script> --}}
    <script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#tech-companies-1').DataTable();
        });
    </script>
 @endsection
