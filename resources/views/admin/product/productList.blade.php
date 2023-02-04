@extends('layouts.templete')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
@endsection

@section('body_title')
    <h4 class="header-title">Product List</h4>
@endsection
@section('content')

    <div class="container">
        @if (isset($listType) && auth()->user()->user_role == 'Admin')
            <div class="mb-3">
                <form id="outlet_form" action="product_in_stock" method="get">
                    <label for="">Outlet</label>
                    <select style="font-size: 12px; max-width: 300px;" onChange="getTableData()" id="outlet"
                        name="outlet" class="form-select" aria-label="Outlet">
                        <option selected disabled hidden value="0">Select Outlet</option>

                        @foreach ($outlets as $outlet)
                            <option {{ $data['outlet'] == $outlet->id ? 'selected' : '' }} value="{{ $outlet->id }}">
                                {{ $outlet->name }}({{ $outlet->address }})</option>
                        @endforeach

                    </select>
                </form>
            </div>
        @endif
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-priority="1">Name</th>
                            <th data-priority="1">Brand</th>
                            <th data-priority="2">Unit</th>
                            <th data-priority="3">Barcode</th>
                            <th data-priority="1">Regular MRP</th>
                            <th data-priority="1">Offer MRP</th>
                            <th data-priority="2">Offer Expire Date</th>
                            <th data-priority="1">Qantity</th>
                            <th data-priority="3">Description</th>
                            @if (!isset($listType))
                                <th data-priority="2">Actions</th>
                            @endif
                            {{-- <th scope="col">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $date = date('Y-m-d'); ?>
                        @foreach ($products as $product)
                            {{-- {{dd($product)}} --}}
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->price_per_unite }}</td>
                                <td>
                                    @if ($product->offer && $product->expire_date >= $date)
                                        {{ $product->offer_mrp }}
                                    @endif
                                </td>
                                <td>

                                    @if ($product->offer && $product->expire_date >= $date)
                                        {{ $product->expire_date }}
                                    @endif
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->description }}</td>
                                @if (!isset($listType))
                                    <td>
                                        <!-- <a  href="" class="btn btn-primary text-white"><i class="far fa-eye"></i></a> -->
                                        <a onclick="setProductDeteiles({{ $product }})"
                                            class="btn btn-success text-white" data-toggle="modal"
                                            data-target="#exampleModal"><i class="fas fa-edit"></i></a>
                                        {{-- <a  onclick="" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- model for view Product info -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>

                </div>
                <form method="post" action="{{ route('update_product') }}">
                    @csrf
                    <div class="modal-body ">

                        <div class="form-group">
                            <input type="text" id="id" name="id" hidden>
                            <div class="row">
                                <div class="col">
                                    <label for="product_name">{{ __('Product Name') }}</label>

                                    <input id="product_name" type="text"
                                        class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                        value="{{ old('product_name') }}" required autocomplete="product_name" autofocus>

                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="unit">{{ __('Unit') }}</label>

                                    <select id="unit" name="unit"
                                        class="form-select form-control @error('unit') is-invalid @enderror"
                                        aria-label="Default select example" name="unit" value="{{ old('unit') }}"
                                        required autocomplete="unit" autofocus>

                                        <option value="kg">kg</option>
                                        <option value="gm">gm</option>
                                        <option value="Ltr">Ltr</option>
                                        <option value="Ml">mL</option>
                                        <option value="Piece">Piece</option>
                                    </select>

                                    {{-- <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" autofocus> --}}

                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="brand">{{ __('Brand') }}</label>

                                    <input id="brand" type="text"
                                        class="form-control @error('brand') is-invalid @enderror" name="brand"
                                        value="{{ old('brand') }}" required autocomplete="brand" autofocus>

                                    @error('brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">


                                <div class="col">
                                    <label for="barcode">{{ __('Barcode') }}</label>

                                    <input id="barcode" type="text"
                                        class="form-control @error('barcode') is-invalid @enderror" name="barcode"
                                        value="{{ old('barcode') }}" autocomplete="barcode" autofocus>

                                    @error('barcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="price_per_unite">{{ __('Regular MRP') }}</label>

                                    <input step="0.1" id="price_per_unite"
                                        onchange="numberInputTracking('price_per_unite')" type="number"
                                        class="form-control @error('price_per_unite') is-invalid @enderror"
                                        name="price_per_unite" value="{{ old('price_per_unite') }}" required
                                        autocomplete="price_per_unite" autofocus>

                                    @error('price_per_unite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="offer_mrp">{{ __('Offer MRP') }}</label>
                                    <input id="offer" name="offer" type="checkbox">

                                    <input id="offer_mrp" onchange="expireDateFild('offer_mrp')" type="number"
                                        step="0.01" class="form-control @error('offer_mrp') is-invalid @enderror"
                                        name="offer_mrp" value="" autocomplete="offer_mrp" autofocus>

                                    @error('offer_mrp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div id="expire_div" class="col d-none">
                                    <label for="expire_date">{{ __('Offer Expire Date') }}</label>

                                    <input id="expire_date" onchange="numberInputTracking('expire_date')" type="date"
                                        class="form-control @error('expire_date') is-invalid @enderror" name="expire_date"
                                        value="" autocomplete="expire_date" autofocus>

                                    @error('expire_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>






                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="product_description">{{ __('Description') }}</label>

                                    <textarea id="product_description" type="text"
                                        class="form-control @error('product_description') is-invalid @enderror" name="product_description"
                                        value="{{ old('product_description') }}" autocomplete="product_description"> </textarea>

                                    @error('product_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="update_button" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end modal -->

@endsection


@section('js')
    <script>
        function getTableData() {
            document.getElementById('outlet_form').submit();
        }
    </script>

    <script>
        function setProductDeteiles(product) {
            document.getElementById('id').value = product.id;
            document.getElementById('product_name').value = product.name;
            document.getElementById('unit').value = product.unit;
            document.getElementById('barcode').value = product.barcode;
            document.getElementById('brand').value = product.brand;
            document.getElementById('price_per_unite').value = product.price_per_unite;
            document.getElementById('product_description').value = product.description;
            document.getElementById('offer_mrp').value = product.offer_mrp;
            //alert(typeof(product.offer));
            if (parseInt(product.offer)) {
                document.getElementById('offer').checked = true;
            } else {
                document.getElementById('offer').checked = false;
            }
            //alert(product.offer_mrp);
            if (product.offer_mrp != null) {

                document.getElementById('expire_date').value = product.expire_date;
                document.getElementById('expire_div').classList.remove('d-none');
                document.getElementById('expire_date').setAttribute('required', '');
            }
        }
    </script>
    <script src="{{ asset('js') }}/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#tech-companies-1').DataTable();


        });
    </script>

    <script>
        function expireDateFild() {
            numberInputTracking('offer_mrp');
            data = document.getElementById('offer_mrp').value;
            if (data != "") {
                document.getElementById('expire_div').classList.remove('d-none');
                document.getElementById('expire_date').setAttribute('required', '');
            } else {
                document.getElementById('expire_date').value = "";
                document.getElementById('expire_div').classList.add('d-none');
                document.getElementById('expire_date').removeAttribute('required');
            }
        }
    </script>
@endsection
