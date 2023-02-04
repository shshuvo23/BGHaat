@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">User List</h4>
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
                  <th data-priority="2">Outlet Name</th>
                  <th data-priority="3">Email</th>
                  {{-- <th data-priority="1">Actions</th> --}}
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>

                @foreach($users as $user)
                <tr>
                  <th >{{$i++;}}</th>
                  <td>{{$user->name}}</td>
                  <td>{{$user->outlate_name}}</td>
                  <td>{{$user->email}}</td>
                  {{-- <td>

                        <a href="" onclick="editUserDitails({{$user}})" class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit" ></i></a>

                  </td> --}}
                </tr>
                @endforeach

              </tbody>
            </table>
            </div>
            </div>
        </div>

        <!-- model for user info -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">User Details</h5>

                        </div>
                        <form method="post" action="{{route('update_user')}}">
                            @csrf
                        <div class="modal-body">

                                <div class="form-group">
                                    <input type="text" id="id" name="id" hidden>
                                    <div class="row">
                                        <div class="col">
                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="col">
                                                <label for="recipient-name" class="col-form-label">Outlet Name:</label>
                                                <select id="user_outlet" name="outlet_id" class="form-select form-control @error('user_outlet') is-invalid @enderror" aria-label="Default select example" name="user_outlet" value="{{ old('user_outlet') }}" required autocomplete="user_outlet" autofocus>
                                                    @foreach($outlets as $outlet)
                                                        <option id="option{{$outlet->id}}" value="{{$outlet->id}}">{{$outlet->name}}<span class="text-gray" style="font-size: 12px;">({{$outlet->address}})</span></option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                                <label for="recipient-name" class="col-form-label">Email:</label>
                                                <input type="text" class="form-control" id="email" name="email">
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
    <script>
        function editUserDitails(user){
            document.getElementById('id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('option'+user.outlet_id).selected = true;
        }
    </script>
 @endsection
