@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Outlet List</h4>
@endsection
@section('content')

                <div class="container">
            



                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-priority="1">Name</th>
                                    <th data-priority="2">Address</th>
                                    <th data-priority="1">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($outlets as $outlet)
                                    <tr>
                                    <th>{{$i++;}}</th>
                                    <td>{{$outlet->name}}</td>
                                    <td>{{$outlet->address}}</td>
                                    <td>
                                            <!-- <a  href="" class="btn btn-primary text-white"><i class="far fa-eye"></i></a> -->
                                            <a href="" onclick="editOutletDitails({{$outlet}})" class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit" ></i></a>
                                            {{-- <a  onclick="deleteOutlet({{$outlet->id}})" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                    </td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>


                    <!-- model for outlete info -->

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Outlet Details</h5>

                        </div>
                        <form method="post" action="{{route('update_outlet')}}">
                            @csrf
                        <div class="modal-body ">

                                <div class="form-group">
                                    <input type="text" id="id" name="id" hidden>
                                    <div class="row">
                                        <div class="col">
                                                <label for="recipient-name" class="col-form-label">Outlet:</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="col">
                                                <label for="recipient-name" class="col-form-label">Address:</label>
                                                <input type="text" class="form-control" id="address" name="address">
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
       <script src="{{asset('templet')}}/assets/js/pages/table-responsive.init.js"></script>
        <script>
            function editOutletDitails(outlet){
                document.getElementById('id').value = outlet.id;
                document.getElementById('name').value = outlet.name;
                document.getElementById('address').value = outlet.address;
            }
        </script>

        <script>
            function deleteOutlet(id){

                if(confirm("Are you sure you want to delete this outlet?")){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.post("{{route('delete_outlet')}}",{id:id}, function( data ) {
                       // alert(data);
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