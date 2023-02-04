@extends('layouts.templete')
@section('content')

@section('body_title')
<h4 class="header-title">Customer Information</h4>
@endsection



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table bg-white " style="">
                            <tbody>
                                <tr class="" id="">
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Contact
                                                    No</label>
                                                <input id="id_no" type="text" class="form-control"
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Name</label>
                                                <input id="name" type="text" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Designation</label>
                                                <input id="designation" type="text" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Department</label>
                                                <input id="department" type="text" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Salary</label>
                                                <input id="salary" type="text" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="" id="">
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Credit
                                                    Limit</label>
                                                <input id="creditPurchaseLimit" type="text" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Total</label>
                                                <input id="total" name="total" type="number"
                                                    class="form-control " value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Paid</label>
                                                <input onkeyup="payment()" onchange="payment()" name="paid"
                                                    id="paid" type="number" class="form-control "
                                                    value="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Due</label>
                                                <input id="due" type="number" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col ">
                                                <label for="">Change</label>
                                                <input id="change" type="number" class="form-control "
                                                    value="" readonly="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Cart List</h4>
                    <form method="POST" action="http://127.0.0.1:8000/add_seles">
                        <input type="hidden" name="_token" value="GBzE463eisI3gCUatQN8mfADclGSkngAuvwCBd1P">
                        <input name="EmployeI_ID" id="EmployeI_ID" type="number" hidden="">
                        <table class="table table-striped table-hover">

                        </table>
                        <table class="table table-striped table-hover">
                            <thead class="">
                                <tr>
                                    <th scope="col" colspan="3">Product
                                        Name</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Regular MRP</th>
                                    <th scope="col">Offer MRP</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="seles_details">
                                <tr class="" id="12">
                                    <td colspan="3">Hermione Maynard</td>
                                    <td>Ml</td>
                                    <td> 2 </td>
                                    <td> No offer </td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>
                                        <button onclick="deleteSelesItem(12)" type="button" style="font-size: 10px;"
                                            class="btn btn-danger waves-effect waves-light d-flex">
                                            <i class="fa fa-trash d-inline "
                                                style="size: 10px; margin-right: .20rem;margin-top: .20rem !important;"></i>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr class="" id="13">
                                    <td colspan="3">Hermione Maynard</td>
                                    <td>Ml</td>
                                    <td> 2 </td>
                                    <td> No offer </td>
                                    <td>2</td>
                                    <td>4</td>
                                    <td>
                                        <button onclick="deleteSelesItem(13)" type="button" style="font-size: 10px;"
                                            class="btn btn-danger waves-effect waves-light d-flex">
                                            <i class="fa fa-trash d-inline "
                                                style="size: 10px; margin-right: .20rem;margin-top: .20rem !important;"></i>
                                            Delete
                                        </button>
                                    </td>


                                </tr>
                                <tr class="" id="14">
                                    <td colspan="3">Hermione Maynard</td>
                                    <td>Ml</td>
                                    <td>
                                        2
                                    </td>

                                    <td>
                                        No offer </td>

                                    <td>2</td>
                                    <td>4</td>
                                    <td>
                                        <button onclick="deleteSelesItem(14)" type="button" style="font-size: 10px;"
                                            class="btn btn-danger waves-effect waves-light d-flex">
                                            <i class="fa fa-trash d-inline "
                                                style="size: 10px; margin-right: .20rem;margin-top: .20rem !important;"></i>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr id="submit_button" class="">
                                    <td align="right" colspan="9">
                                        <button type="submit" style="margin-right: 50px;" class="btn btn-primary">
                                            Submit </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Products</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <select class="form-control" name="" id="">
                                    <option value="">--Choose Once--</option>
                                    <option value="">Product 1</option>
                                    <option value="">Product 2</option>
                                    <option value="">Product 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input type="text" id="unit" class="form-control " name="unit"
                                    required="" placeholder="Unit" autofocus="" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input type="number" id="sales_price"
                                    onchange="numberInputTracking('sales_price')" class="form-control "
                                    name="sales_price" value="" required="" placeholder="Regular MRP"
                                    autocomplete="sales_price" autofocus="" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input
                                    type="number"id="offer_mrp"onchange="numberInputTracking('offer_mrp')"class="form-control "name="offer_mrp"value=""required=""placeholder="Offer MRP"autocomplete="offer_mrp"autofocus=""readonly="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <input id="sales_quantity" onchange="quantityTracking()" type="number"
                                    class="form-control " name="sales_quantity" value=""
                                    placeholder="Quantity" autocomplete="sales_quantity" autofocus="">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-3">
                                <a onclick="addSeles()" class="btn btn-success"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
