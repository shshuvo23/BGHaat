@extends('layouts.templete')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
@endsection
@section('body_title')
    <h4 class="header-title">Purchase List</h4>
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-end my-3">
            <form action="download_purchase_list_pdf" method="get">
                <button type="submit" class="btn btn-primary">Download PDF</button>
            </form>
        </div>
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-priority="1">Product Name</th>
                            <th data-priority="3">Quantity</th>
                            <th data-priority="3">Free Quantity</th>
                            <th data-priority="3">Purchase Unit Price</th>

                            <th data-priority="3">Total Price</th>
                            <th data-priority="3">Paid</th>
                            <th data-priority="3">Current Unit Price</th>
                            <th data-priority="4">Date</th>
                            <th data-priority="4">Outlet</th>
                            <th data-priority="1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $purchase->name }}</td>
                                <td>{{ $purchase->quantity }}</td>
                                <td>{{ $purchase->free_quantity }}</td>
                                <td>{{ $purchase->price }}</td>

                                <td>{{ $purchase->total }}</td>
                                <td>{{ $purchase->paid }}</td>
                                <td>{{ $purchase->current_price }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td>{{ $purchase->outlet_name }}</td>
                                <td>
                                    <!-- <a  href="" class="btn btn-primary text-white"><i class="far fa-eye"></i></a> -->
                                    <a href="" onclick="setPurchaseDeteiles({{ $purchase }})"
                                        class="btn btn-success text-white" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fas fa-edit"></i></a>
                                    <a onclick="deletePuschase({{ $purchase->id }})" class="btn btn-danger text-white"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- model for purchase info -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase Details</h5>

                </div>
                <form method="post" action="{{ route('update_puschase') }}">
                    @csrf
                    <div class="modal-body ">


                        <div class="form-group">
                            <input type="text" id="id" name="id" hidden>
                            <div class="row">
                                <div class="col">
                                    <label for="product_id" class="col-form-label">Product Name:</label>
                                    <select id="product_id" name="product_id"
                                        class="form-select form-control @error('user_outlet') is-invalid @enderror"
                                        aria-label="Default select example" required autofocus>
                                        @foreach ($products as $product)
                                            <option id="option{{ $product->id }}" value="{{ $product->id }}">
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="price_per_unite" class="col-form-label">Price per Unite:</label>
                                    <input type="number" onchange="numberInputTracking('price_per_unite')"
                                        class="form-control" id="price_per_unite" name="price_per_unite">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="quantity" class="col-form-label">Quantity:</label>
                                    <input type="number" onchange="numberInputTracking('quantity')" class="form-control"
                                        id="quantity" name="quantity">
                                </div>
                                <div class="col">
                                    <label for="total" class="col-form-label">Total:</label>
                                    <input type="number" onchange="numberInputTracking('total')" class="form-control"
                                        id="total" name="total">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col">
                                    <label for="date" class="col-form-label">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" onclick="updatePuschase()" id="update_button"
                            class="btn btn-primary">Update</button>
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
        $(document).ready(function() {
            $('#product_id').select2();

        });
    </script>

    <script>
        function setPurchaseDeteiles(purchase) {
            console.log(document.getElementById('quantity'));
            document.getElementById('id').value = purchase.id;
            document.getElementById('price_per_unite').value = purchase.price;
            document.getElementById('total').value = purchase.total;
            document.getElementById('date').value = purchase.date;
            // alert(purchase.price_per_unite);
            document.getElementById('quantity').value = purchase.quantity;
            document.getElementById('option' + purchase.product_id).selected = true;

        }
    </script>

    <script>
        function updatePuschase(puschase) {

             let id = document.getElementById('id').value;
             let date = document.getElementById('date').value;
             let price =  document.getElementById('price_per_unite').value;
             let quantity = document.getElementById('quantity').value ;
             let total = document.getElementById('total').value;
             let product_id = document.getElementById('product_id').value;


             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
             $.ajax({
                url: '{{route('update_puschase')}}',
                type: 'post',
                data: {
                    'id': id,
                    'date': date,
                    'price': price,
                    'quantity':quantity ,
                    'total': total,
                    'product_id': product_id
                },
                success: function(data) {
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id +
                        "</td><td>" + data.name + "</td><td>" + data.email +
                        "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id +
                        "' data-name='" + data.name + "' data-email='" + data.email +
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" +
                        data.id + "' data-name='" + data.name + "' data-email='" + data.email +
                        "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }
            });

        }

        function deletePuschase(id) {
            if (confirm("Are you sure you want to delete this outlet?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.post("{{ route('delete_puschase') }}", {
                        id: id
                    }, function(data) {
                        // alert(data);
                        if (data == "Not Delete") {
                            alert(data);
                        } else {
                            //alert('deleted');
                            var url = "{{ url()->current() }}";
                            //$('body').load(url);
                            // location.relode();
                            window.location.href = url;
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    });

            }
        }
    </script>

    <script src="{{ asset('js') }}/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tech-companies-1').DataTable();


        });
    </script>
@endsection
