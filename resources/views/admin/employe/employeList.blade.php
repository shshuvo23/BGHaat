@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Employee List</h4>
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
                  <th data-priority="4">Designation</th>
                  <th data-priority="3">Salary</th>
                  <th data-priority="3">Credit Limit</th>
                  <th data-priority="4">Depertment</th>
                  <th data-priority="1">ID Card Number</th>
                  <th data-priority="5">Contact Number</th>
                  <th data-priority="1">Actions</th>
                </tr>
              </thead>

              <tbody>
                <?php $i = 1; ?>
                @foreach($employes as $employe)
                <tr>
                  <th>{{$i++;}}</th>
                  <td>{{$employe->name}}</td>
                  <td>{{$employe->designation}}</td>
                  <td>{{$employe->salary}}</td>
                  <td>{{$employe->credit_limit}}%</td>
                  <td>{{$employe->depertment}}</td>
                  <td>{{$employe->id_card_number}}</td>
                  <td>{{$employe->contact_number}}</td>
                  <td >
                      <div class="row">
                          <div class="col-6">
                              <a href="" onclick="editEmployeDitails({{$employe}})" data-toggle="modal" data-target="#exampleModal" class="btn btn-success text-white"><i class="fas fa-edit"></i></a>
                          </div>
                          <div class="col-6">
                              <a  onclick="deleteEmploye({{$employe->id}})" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </div>
                      </div>
                            <!-- <a  href="" onclick="viewEmployeDitails({{$employe}})" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary text-white"><i class="far fa-eye"></i></a> -->
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
                        <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Employe Details</h5>

                        </div>
                        <form method="post" action="{{route('update_employe')}}">
                            @csrf
                        <div class="modal-body ">

                                <div class="form-group">
                                    <input type="text" id="id" name="id" hidden>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                                <label for="recipient-name" class="col-form-label">ID No:<span>*</span></label>
                                                <input type="text" class="form-control" id="id_card_number" name="id_card_number" required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                                <label for="recipient-name" class="col-form-label">Name:<span>*</span></label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                                <label for="recipient-name" class="col-form-label">Designation:</label>
                                                <input type="text" class="form-control" id="designation" name="designation" >
                                        </div>
                                        <div class="col-12 col-sm-6">
                                                <label for="recipient-name" class="col-form-label">Department:<span>*</span></label>
                                                <input type="text" class="form-control" id="department" name="department" required>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group d-none">
                                    <div class="row">
                                        <div class="col">
                                                <label for="recipient-name" class="col-form-label">Company:</label>
                                                <input type="text" class="form-control" id="company" name="company">
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                                <label for="recipient-name" class="col-form-label">Contact Number:</label>
                                                <input type="text" class="form-control" id="contact_number" name="contact_number">
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <label for="salary-name" class="col-form-label">Salary:<span>*</span></label>
                                            <input step="0.1" type="number" onchange="numberInputTracking('salary')" class="form-control" id="salary" name="salary" required>
                                        </div>
                                        <div class="col-12 col-sm-4 mt-2">
                                            <label for="credit_limit" >{{ __('Credit Limit') }}<span>*</span></label>
                                            <div class="input-group">
                                                <input step="0.1" id="credit_limit" onchange="numberInputTracking('credit_limit')" type="number" class="form-control @error('credit_limit') is-invalid @enderror" name="credit_limit" value="{{ old('credit_limit') }}" required autocomplete="credit_limit" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            @error('credit_limit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer ">
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

      <script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready( function () {
                    $('#tech-companies-1').DataTable();


                } );
            </script>

        <script>
            function viewEmployeDitails(employe){
                document.getElementById('update_button').hidden = true;
                document.getElementById('id_card_number').readOnly = true;
                document.getElementById('name').readOnly = true;
                document.getElementById('designation').readOnly = true;
                document.getElementById('salary').readOnly = true;
                // document.getElementById('company').readOnly = true;
                document.getElementById('department').readOnly = true;
                document.getElementById('contact_number').readOnly = true;
                setInfo(employe);
            }

            function editEmployeDitails(employe){
                document.getElementById('update_button').hidden = false;
                document.getElementById('id_card_number').readOnly = false;
                document.getElementById('name').readOnly = false;
                document.getElementById('designation').readOnly = false;
                document.getElementById('salary').readOnly = false;
               // document.getElementById('company').readOnly = false;
                document.getElementById('department').readOnly = false;
                document.getElementById('contact_number').readOnly = false;
                setInfo(employe);
            }

            function setInfo(employe){
                document.getElementById('id').value = employe.id;
                document.getElementById('id_card_number').value = employe.id_card_number;
                document.getElementById('name').value = employe.name;
                document.getElementById('designation').value = employe.designation;
                document.getElementById('salary').value = employe.salary;
                document.getElementById('department').value = employe.depertment;
                document.getElementById('contact_number').value = employe.contact_number;
                document.getElementById('credit_limit').value = employe.credit_limit;

                //console.log(employe.contact_number);
            }



            function deleteEmploye(id){
                if(confirm("Are you sure you want to delete this Employee?")){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.post("{{route('delete_employe')}}",{id:id}, function( data ) {
                       // alert(data);
                        if(data == "Not Delete"){
                            alert(data);
                        }
                        else{
                            //alert('deleted');
                            window.location.href = window.location.href;
                        }
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                     });

                }
            }



            // function toBinary(data){
            //     number = parseFloat(data);
            //     assci = String.fromCharCode(number);
            //     binary = number.toString(2);
            //     return binary;
            // }

        </script>
        @endsection


