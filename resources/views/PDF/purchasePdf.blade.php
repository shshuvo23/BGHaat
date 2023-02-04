<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>


<style>
    .mx-5{
        margin-left: 5rem;
        margin-right: 5rem;
    }

    table {
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
    }

    table tr {
        border: 1px solid rgb(0, 0, 0);
        border-top: 1px solid rgb(0, 0, 0);
    }
    table, th, td {
        border-left: 1px solid rgb(0, 0, 0);
        border-right: 1px solid rgb(0, 0, 0);
        font-size: 10px;
        text-align: center;
        padding: 3px;
    }


</style>

</head>
<body class="bg-dark" style="display: flex; justify-content: center;">

   {{-- textLayer --}}



<h3 style="text-align: center">BG Haat Live Shop</h3>
<h6 style="text-align: center">Purchase List</h6>
<table class="table my-3" style="border: none;">
    <thead class="thead-dark bg-dark text-white">
        <tr>
            <th >#</th>
            <th data-priority="1">Product Name</th>
            <th data-priority="3">Price per Unite</th>
            <th data-priority="3">Quantity</th>
            <th data-priority="3">Total</th>
            <th data-priority="4">Date</th>

          </tr>
    </thead>
    <tbody id="sales_list">


        <?php $i = 1; $total = 0; ?>
            @foreach($purchases as $purchase)
                   {{ $total += ($purchase->price * $purchase->quantity);}}
                {{-- {{dd($expense)}} --}}
                <tr>
                    <th >{{$i++;}}</th>
                    <td>{{$purchase->name}}</td>
                    <td>{{$purchase->price}}</td>
                    <td>{{$purchase->quantity}}</td>
                    <td>{{$purchase->price * $purchase->quantity}}</td>
                    <td>{{$purchase->date}}</td>

                  </tr>
            @endforeach

            <tr style="border: none;">
                <td colspan="6" style="border: none;">
                    <div>
                          <p style="font-size: 12px; text-align: right;">Total: {{$total}}</p>

                    </div>
                </td>

            </tr>

    </tbody>
  </table><br>

  <div style="position: absolute; bottom: 0px; left: 0px; right: 0px;">
    <p style="font-size: 12px; padding: 0px; margin: 0px;">--------------------------</p>
    <p style="font-size: 12px; padding: 0px; margin: 0px;">Authorized signature</p><br><br>
    <p style="font-size: 12px; text-align: center;">House #47,Road #07, Nikunja-1, Khilkhet, Dhaka-1229</p>
    <p style="font-size: 12px; text-align: center;">Email : support@bghaat.com, Phone : +880 1787663280</p>
  </div>
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> --}}

<script type="text/javascript">



</script>
</body>
</html>
