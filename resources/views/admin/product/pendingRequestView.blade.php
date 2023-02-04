


@foreach ($requests as  $shifts)
<h5>
    @if(auth()->user()->user_role == 'Admin')
    {{'From '.$shifts[0]->from_outlet_name.' '}}
    @endif
    {{'To '.$shifts[0]->outlet_name}}</h5>
@php
    $i = 0;
@endphp
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Product Name</th>
        <th scope="col">Quantity</th>
      </tr>
    </thead>
    <tbody>
    @foreach($shifts as $shift)
    <tr>
        <th scope="row">{{$i++}}</th>
        <td>{{$shift->product_name}}</td>
        <td>{{$shift->quantity}}</td>
      </tr>
    @endforeach
</tbody>
</table>

<div class="d-flex justify-content-end">
<button class="m-2 btn btn-danger" onclick="cancelSendedShiftingRequest('{{$shifts[0]->shift_no}}')">Cancel</button>
{{-- <button class="m-2 btn btn-primary" onclick="acceptShifting('{{$shifts[0]->shift_no}}')">Accept</button> --}}
</div>

@endforeach
