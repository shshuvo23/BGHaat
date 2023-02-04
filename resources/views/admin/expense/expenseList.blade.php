@extends('layouts.templete')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
@endsection
@section('body_title')
<h4 class="header-title">Expense List</h4>
@endsection
@section('content')

            <div class="container">
                <div class="d-flex justify-content-end my-3">
                    <form action="download_expense_list_pdf" method="get">
                        <button type="submit" class="btn btn-primary">Download PDF</button>
                    </form>
                </div>
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                <tr>
                  <th >#</th>
                  <th data-priority="1">Title</th>
                  <th data-priority="3">Desciption</th>
                  <th data-priority="1">Amount</th>
                  <th data-priority="2">Date</th>
                  <th data-priority="2">Outlet</th>
                  <th data-priority="2">Actions</th>
                  {{-- <th data-priority="2">User Name</th> --}}
                  {{-- <th data-priority="1">Actions</th> --}}

                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                @foreach($expenses as $expense)

                {{-- {{dd($expense)}} --}}
                <tr>
                  <th scope="row">{{$i++;}}</th>
                  <td>{{$expense->title}}</td>
                  <td>{{$expense->description}}</td>
                  <td>{{$expense->amount}}</td>
                  <td>{{$expense->date}}</td>
                  <td>{{$expense->outlet_name}}</td>
                  <td>

                        <a onclick="setExpenseDetailes({{$expense}})" data-toggle="modal" data-target="#exampleModal" class="btn btn-success text-white"><i class="fas fa-edit"></i></a>
                        {{-- <a  onclick="" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            </div>
        </div>






                                   <!-- model for purchase info -->

                                   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Expense Details</h5>

                                        </div>
                                        <form method="post" action="{{route('update_expense')}}">
                                            @csrf
                                        <div class="modal-body ">


                                                <div class="form-group">
                                                    <input type="text" id="id" name="id" hidden>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="expense_title" >{{ __('Title') }}</label>

                                                            <input id="expense_title" type="text" class="form-control @error('expense_title') is-invalid @enderror" name="expense_title" value="{{ old('expense_title') }}" required autocomplete="expense_title" autofocus>
                                                        </div>
                                                        <div class="col">
                                                            <label for="expense_description" >{{ __('Description') }}</label>

                                                            <textarea id="expense_description" class="form-control @error('expense_description') is-invalid @enderror" name="expense_description" value="{{ old('expense_description') }}"  autocomplete="expense_description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="expense_amount" >{{ __('Amount') }}</label>

                                                            <input step="0.1" id="expense_amount" onchange="numberInputTracking('expense_amount')" type="number" value="{{ old('expense_amount') }}"class="form-control @error('expense_amount') is-invalid @enderror" name="expense_amount" required autocomplete="expense_amount">
                                                        </div>
                                                        <div class="col">
                                                            <label for="user_id" >{{ __('User') }}</label>
                                                            <select id="user_id" name="user_id" class="form-select form-control @error('user_id') is-invalid @enderror" aria-label="Default select example" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>

                                                                @foreach($users as $user)
                                                                    <option value="{{$user->user_id}}">
                                                                        <span class="">{{$user->user_name}}</span>
                                                                        <span class="">({{$user->outlate_name}})</span>
                                                                        <!-- <span class="">{{$user->address}}</span> -->
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="expense_date">{{ __('Date') }}</label>

                                                            <input id="expense_date" type="date" class="form-control @error('expense_date') is-invalid @enderror" name="expense_date" value="{{ old('date') }}" required autocomplete="expense_date">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button  type="submit" id="update_button" class="btn btn-primary">Update</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- end modal -->






    </div>
@endsection

@section('js')

<script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#tech-companies-1').DataTable();
    } );
</script>

<script>
    function setExpenseDetailes(expense){
        // console.log(expense);
        document.getElementById('id').value = expense.id;
        document.getElementById('expense_title').value = expense.title;
        document.getElementById('expense_description').value = expense.description;
        document.getElementById('expense_amount').value = expense.amount;
        document.getElementById('user_id').value = expense.user_id;
        document.getElementById('expense_date').value = expense.date;
    }
</script>

@endsection
