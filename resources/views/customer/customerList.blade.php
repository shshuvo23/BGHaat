@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Customer List</h4>
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
                  <th data-priority="3">Address</th>
                  <!-- <th data-priority="1">Salary</th> -->
                  <th data-priority="1">Contact No</th>
                  <!-- <th data-priority="1">ID Card Number</th>
                  <th data-priority="1">Contact Number</th> -->
                  <th data-priority="1">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                @foreach($customers as $customer)
                <tr>
                  <th scope="row">{{$i++;}}</th>
                  <td>{{$customer->name}}</td>
                  <td>{{$customer->address}}</td>
                  <td>{{$customer->contact_no}}</td>
                  <td>
                        {{-- <a  href="" onclick="viewEmployeDitails({{$employe}})" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary text-white"><i class="far fa-eye"></i></a> --}}
                        <a href="" onclick="editCustomerDitails({{$customer}})" data-toggle="modal" data-target="#exampleModal" class="btn btn-success text-white"><i class="fas fa-edit"></i></a>
                        <a  onclick="deleteCustomer({{$customer->id}})" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            </div>
            </div>
            </div>


            <!-- model for view employe info -->

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>

                        </div>
                        <form method="post" action="{{route('update_customer')}}">
                            @csrf
                        <div class="modal-body ">

                                <div class="form-group">
                                    <input type="text" id="id" name="id" hidden>
                                    <div class="row">
                                        <div class="col">
                                                <label for="customer_name" class="col-form-label">Name:</label>
                                                <input type="text" class="form-control" id="customer_name" name="customer_name">
                                        </div>
                                        <div class="col">
                                                <label for="address" class="col-form-label">Address:</label>
                                                <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                                <label for="contact_no" class="col-form-label">Contact No:</label>
                                                <input type="text" class="form-control" id="contact_no" name="contact_no" >
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



       @endsection

       @section('js')

        <script>


            function editCustomerDitails(customer){

                document.getElementById('id').value = customer.id;
                document.getElementById('customer_name').value = customer.name;
                document.getElementById('address').value = customer.address;
                document.getElementById('contact_no').value = customer.contact_no;
            }

            function deleteCustomer(id){

                if(confirm("Are you sure you want to delete this outlet?")){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.post("{{route('delete_customer')}}",{id:id}, function( data ) {
                       //alert(data);
                        if(data == "Not Delete"){
                            alert(data);
                        }
                        else{
                            //alert('deleted');
                            var url = "{{url()->current()}}";
                            $('body').load(url);
                        }
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                     });

                }
            }

        </script>
@endsection
