
<?php $i = 0; ?>
<table class="table table-striped">
    <thead>
      <tr>
        {{-- <th scope="col"><input type="checkbox"><label for="" class="ml-2">Check all</label></th> --}}
        <th scope="col" style="width: 120px;">
            <input id="checkUncheck" onclick="checkUncheck()" type="checkbox">
            <label for="" style="margin-left: 2px; margin: 0px;" class="">Check all</label>
        </th>
        <th scope="col">Product Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">From Outlet</th>

      </tr>
    </thead>
    <tbody>
@foreach ($requests as  $shifts)

    @foreach($shifts as $shift)
    <tr>
        {{-- <td scope="row"><input type="checkbox"></td> --}}
        <th scope="row"><input class="checkBox" value="{{$shift->id}}" type="checkbox"></th>
        <td>{{$shift->product_name}}</td>
        <td>{{$shift->quantity}}</td>
        <td>{{$shifts[0]->outlet_name}}</td>

      </tr>
    @endforeach


@endforeach

</tbody>
</table>

<div class="d-flex justify-content-end">
<button class="m-2 btn btn-danger" onclick="cancelShifting('{{$shifts[0]->shift_no}}')">Cancel</button>
<button class="m-2 btn btn-primary" onclick="acceptShifting('{{$shifts[0]->shift_no}}')">Accept</button>
</div>

