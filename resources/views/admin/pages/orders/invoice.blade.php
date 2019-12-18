
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-10 offset-md-1">
              <div class="card">
                <div class="card-header">
                  <div class="mt-5">
                    <img src="{{asset('images/ecommerce.jpg')}}" alt=""> 
                  </div>
                  <div class="">
                    <p>Laravel Ecommerce ltd.</p>
                    <p>Pahartali,chattogram</p>
                    <p>Phone: 01840080226</p>
                    <p>Email: jahed.dreamer@gmail.com</p>
                  </div>
                  <h4 class="card-title">view order #LE{{$order->id}}</h4>
                </div>
                <div class="card-body">
                    <h3>order information</h3>
                  
                  {{-- view update message --}}
                  @include('admin.partials.messages')
                  {{-- end --}}
                  <div class="row mt-3">
                    <div class="col-md-6  border-right">
                      <p><strong>Orderer Name: </strong>{{$order->name}}</p>
                      <p><strong>Orderer Phone No: </strong>{{$order->phone_no}}</p>
                      <p><strong>Orderer Email: </strong>{{$order->email}}</p>
                      <p><strong>Orderer Shipping Address: </strong>{{$order->shipping_address}}</p>
                    </div>
                    <div class="col-md-6">
                      <p><strong>Payment Method: </strong>{{$order->payment->name}}</p>
                      <p><strong>Transaction ID: </strong>{{$order->transaction_id}}</p>
                    </div>
                  </div>
                  <hr>

                  <h3>order items</h3>
                  <div class="row">
                    @if($order->carts->count() > 0)
                      <table class="table table-responsive table-bordered table-stripe">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Product</th>
                            <th></th>
                            <th>quantity</th>
                            <th></th>
                            <th></th>
                            <th>Unit Price</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Sub Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @php
                              $subtotal_price = 0;
                            @endphp

                            @foreach($order->carts as $cart)
                            <tr>
                            <td> {{ $loop->index+1 }} </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>
                              {{ $cart->product->title }} 
                            </td>
                            <td> </td>

                            <td>
                              {{$cart->product_quantity}}
                            </td>
                            <td> </td>
                            <td> </td>
                            <td>
                              {{ $cart->product->price }} Taka
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            @php
                              $subtotal_price += $cart->product->price*$cart->product_quantity;
                            @endphp

                            <td>
                              {{ $cart->product->price*$cart->product_quantity }} Taka
                            </td>
                            <td></td>
                          </tr>

                          

                          @endforeach
                          
                          {{-- <tr>
                            <td colspan="4"></td>
                            <td><strong>Subtotal Amount:</strong></td>
                            <td colspan="2">
                              <strong>{{ $subtotal_price }} taka</strong>
                            </td>
                          </tr> --}}

                        </tbody>
                      </table>
                      @else
                      <p>no items </p>
                      @endif

                      <hr>
                      <div>
                        <h4>subtotal amount: {{$subtotal_price}} taka</p>
                        <p>shipping charge: {{$order->shipping_charge}} taka</p>
                        <p>discount: {{$order->custom_discount}} taka</p>
                      </div>
                      <hr>
                  </div>

                      <div class="mt-5">
                        <h3><span class="badge badge-primary" style="font-size: 18px;width: 30%;">Total amount:{{$subtotal_price+$order->shipping_charge-$order->custom_discount}} taka only</span></h3>
                      </div>

                  



                </div>
              </div>
            </div>
          </div>
        </div>