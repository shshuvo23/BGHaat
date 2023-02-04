





            <?php $i = 1; ?>
                @foreach($sales as $sal)
                    @if(($data['time'] == 'all' || str_contains($sal->date, $data['date'])))
                        @if($data['outlet'] == 'all' || $sal->outlet_id == $data['outlet'])
                            @if($data['type'] == 'all' || $sal->seles_type == $data['type'])

                                <tr>
                                    <th scope="row">{{$i++;}}</th>
                                    {{-- <td>{{$sal->id_card_number}}</td> --}}
                                    <td>{{$sal->seles_type}}</td>
                                    <td>{{$sal->product_name}}</td>

                                    <td>{{$sal->unit}}</td>

                                    <td>{{$sal->price_per_unite}}</td>
                                    <td>{{$sal->quantity}}</td>

                                    <td>{{$sal->price_per_unite * $sal->quantity}}</td>
                                    <td>{{$sal->date}}</td>

                                    <td>{{$sal->outlet_name}}</td>
                                    <td>{{$sal->address}}</td>

                                    <td>{{$sal->employe_name}}</td>
                                    <td>{{$sal->id_card_number}}</td>

                                    <td></td>
                                    <td></td>
                                    <td>

                                            {{-- <a  onclick="viewSalesDetails({{$sal}})" href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#exampleModal"><i class="far fa-eye"></i></a> --}}
                                            {{-- <a href="" class="btn btn-success text-white"><i class="fas fa-edit"></i></a> --}}
                                            {{-- <a  onclick="" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endif
                @endforeach

                @foreach($customerSales as $customerSal)
                    @if(($data['time'] == 'all' || str_contains($customerSal->date, $data['time'])))
                        @if($data['outlet'] == 'all' || $customerSal->outlet_id == $data['outlet'])
                            @if($data['type'] == 'all' || $customerSal->seles_type == $data['type'])
                                <tr>
                                    <th scope="row">{{$i++;}}</th>
                                    {{-- <td>{{$sal->id_card_number}}</td> --}}
                                    <td>{{$customerSal->seles_type}}</td>
                                    <td>{{$customerSal->product_name}}</td>

                                    <td>{{$customerSal->unit}}</td>

                                    <td>{{$customerSal->price_per_unite}}</td>
                                    <td>{{$customerSal->quantity}}</td>

                                    <td>{{$customerSal->price_per_unite * $sal->quantity}}</td>
                                    <td>{{$customerSal->date}}</td>

                                    <td>{{$customerSal->outlet_name}}</td>
                                    <td>{{$customerSal->address}}</td>

                                    <td></td>
                                    <td></td>

                                    <td>{{$customerSal->customer_name}}</td>
                                    <td>{{$customerSal->contact_no}}</td>
                                    <td>

                                            {{-- <a  onclick="viewCustomerSalesDetails({{json_encode($customerSal)}})" href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#exampleModal"><i class="far fa-eye"></i></a> --}}
                                            {{-- <a href="" class="btn btn-success text-white"><i class="fas fa-edit"></i></a> --}}
                                            {{-- <a  onclick="" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endif
                @endforeach





                <!-- model for view dales detailes -->

             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-success text-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sales Details</h5>

                    </div>
                    <form method="post" action="">
                        @csrf
                    <div class="modal-body ">

                            <div class="form-group">
                                {{-- <input type="text" id="id" name="id" hidden> --}}
                                <div class="row">
                                    <div class="col">
                                            <label for="" class="col-form-label">Sales Type:</label>
                                            <input type="text" class="form-control" id="sales_type" name="sales_type" readonly>
                                    </div>
                                    <div class="col">
                                            <label for="" class="col-form-label">Product Name:</label>
                                            <input type="text" class="form-control" id="product_name" name="product_name" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                            <label for="" class="col-form-label">Price Per Unite:</label>
                                            <input type="text" class="form-control" id="price_per_unite" name="price_per_unite" readonly>
                                    </div>
                                    <div class="col">
                                            <label for="" class="col-form-label">Quentity:</label>
                                            <input type="text" class="form-control" id="quantity" name="quantity" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                            <label for="" class="col-form-label">Total:</label>
                                            <input type="text" class="form-control" id="total" name="total" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="" class="col-form-label">Date:</label>
                                        <input type="text" class="form-control" id="dateShow" name="dateShow" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                            <label for="" class="col-form-label">Outlet Name:</label>
                                            <input type="text" class="form-control" id="outlet_name" name="outlet_name" readonly>
                                    </div>
                                    <div class="col">
                                            <label for="" class="col-form-label">Address:</label>
                                            <input type="text" class="form-control" id="address" name="address" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="employe" class="form-group d-none">
                                <div class="row">
                                    <div class="col">
                                            <label for="" class="col-form-label">Employe Name:</label>
                                            <input type="text" class="form-control" id="employe_name" name="employe_name" readonly>
                                    </div>
                                    <div class="col">
                                            <label for="" class="col-form-label">ID No:</label>
                                            <input type="text" class="form-control" id="id_card_number" name="id_card_number" readonly>
                                    </div>
                                </div>
                            </div>

                            <div id="customer" class="form-group d-none" >
                                <div class="row">
                                    <div class="col">
                                            <label for="" class="col-form-label">Customer Name:</label>
                                            <input type="text" class="form-control" id="customer_name" name="customer_name" readonly>
                                    </div>
                                    <div class="col">
                                            <label for="" class="col-form-label">Contact No:</label>
                                            <input type="text" class="form-control" id="contact_no" name="contact_no" readonly>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button  type="submit" id="update_button" class="btn btn-primary">Update</button> --}}
                    </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- end modal -->





