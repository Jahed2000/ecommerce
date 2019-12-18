@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-10 offset-md-1">
              <div class="card">
                <div class="card-header">
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
                            <th>Product</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub Total</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @php
                              $subtotal_price = 0;
                            @endphp

                            @foreach($order->carts as $cart)
                            <tr>
                            <td> {{ $loop->index+1 }} </td>
                            <td>
                              <a href="{{route('products.show',$cart->product->slug)}}">{{ $cart->product->title }} 
                            </td>

                            <td>
                              {{-- if product has atleast one image --}}
                              @if( $cart->product->images->count() > 0 ) 
                              {{--returns the first among multiple images --}}
                                <img src="{{ asset('images/products/'.$cart->product->images->first()->image) }}" alt="no image" width="60px">
                              @endif
                            </td>

                            <td>
                              <form class="form-inline" action="{{route('carts.update',$cart->id)}}" method="post">
                                @csrf
                                <input class="form-control" type="number" name="product_quantity" value="{{$cart->product_quantity}}">
                                <button class="btn btn-info ml-2" type="submit">update</button>
                              </form>
                            </td>
                            <td>
                              {{ $cart->product->price }} Taka
                            </td>
                            
                            @php
                              $subtotal_price += $cart->product->price*$cart->product_quantity;
                            @endphp

                            <td>
                              {{ $cart->product->price*$cart->product_quantity }} Taka
                            </td>
                            <td>
                              <form class="form-inline" action="{{route('carts.delete',$cart->id)}}" method="get">
                                <button class="btn btn-danger" type="submit">delete</button>
                              </form>
                            </td>
                          </tr>

                          

                          @endforeach

                          <tr>
                            <td colspan="4"></td>
                            <td><strong>Subtotal Amount:</strong></td>
                            <td colspan="2">
                              <strong>{{ $subtotal_price }} taka</strong>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                      @else
                      <p>no items </p>
                      @endif

                      <hr>
                      <form class="forms-sample" method="post" action="{{route('admin.order.charge',$order->id)}}" style="display: inline-block!important;">
                      @csrf
                        <div class="form-group">
                        <label for="shipping_charge">shipping charge</label>
                        <input type="number" name="shipping_charge" class="form-control" id="shipping_charge" value="{{$order->shipping_charge}}" placeholder="shipping charge">
                        </div>
                        <div class="form-group">
                          <label for="custom_discount">custom discount</label>
                          <input type="number" name="custom_discount" class="form-control" id="custom_discount" value="{{$order->custom_discount}}" placeholder="custom discount">
                        </div>
                
                        <button type="submit" class="btn btn-info mr-2">Submit</button>
                      </form>
                      <hr>
                  </div>

                      <div class="mt-5">
                        <h3><span class="badge badge-primary" style="font-size: 18px;width: 30%;">Total amount:{{$subtotal_price+$order->shipping_charge-$order->custom_discount}}</span></h3>
                      </div>

                  <div class="mt-5">
                    <form class="form-inline" method="post" action="{{route('admin.order.paid',$order->id)}}" style="display: inline-block!important;">
                      @csrf
                      @if($order->is_paid==0)
                      <input type="submit" value="Order Not Paid" class="btn btn-warning">
                      @else
                      <input type="submit" value="Order Paid" class="btn btn-success">
                      @endif
                    </form>

                    <form class="form-inline" method="post" action="{{route('admin.order.completed',$order->id)}}" style="display: inline-block!important;">
                      @csrf
                      @if($order->is_completed==0)
                      <input type="submit" value="Order Not Completed" class="btn btn-warning">
                      @else
                      <input type="submit" value="Order Completed" class="btn btn-success">
                      @endif
                    </form>
                    <a href="{{route('admin.order.invoice',$order->id)}}" class="btn btn-info" target="_blank">generate invoice</a>
                  </div>



                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
@include('admin.partials.footer')
        <!-- partial -->
      </div>

@endsection