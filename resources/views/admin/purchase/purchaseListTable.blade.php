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
