
                          @foreach($carts as $cart)

                            @php
                                $Price = $cart->price_per_unite;
                                if($cart->offer && $cart->expire_date>=date('Y-m-d')){
                                    $Price = $cart->offer_mrp;
                                }
                            @endphp

                            <tr class=""  id="{{$cart->id}}">

                                <td colspan="2">{{$cart->name}}</td>
                                <td>{{$cart->unit}}</td>

                                <td>
                                    @if($cart->offer && $cart->expire_date>=date('Y-m-d'))
                                    <del>{{$cart->price_per_unite}} </del>
                                    @else{{$cart->price_per_unite}}@endif

                                </td>

                                <td>
                                    @if($cart->offer && $cart->expire_date>=date('Y-m-d'))
                                    {{$cart->offer_mrp}}
                                    @else No offer @endif
                                </td>

                                <td>{{$cart->quantity}}</td>
                                <td>{{$cart->quantity * $Price}}</td>
                                <td>
                                     <button onclick="deleteSelesItem({{$cart->id}})" type="button" style="font-size: 10px;" class="btn btn-danger waves-effect waves-light d-flex" >
                                        <i class="fa fa-trash d-inline " style="size: 10px; margin-right: .20rem;margin-top: .20rem !important;"></i> Delete
                                    </button>
                                </td>


                        </tr>
                @endforeach









