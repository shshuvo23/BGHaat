


                          @foreach($carts as $cart)

                          <tr class="" id="{{$cart->id}}">

                              <td >{{$cart->name}}
                              </td>

                              <td>{{$cart->quantity}}

                              </td>

                              <td>
                                  <button onclick="deleteSelesItem({{$cart->id}})" type="button" style="font-size: 10px;" class="btn btn-danger waves-effect waves-light d-flex" >
                                      <i class="fa fa-trash d-inline " style="size: 10px; margin-right: .20rem;margin-top: .20rem !important;"></i> Delete
                                  </button>
                              </td>
                      </tr>
              @endforeach
