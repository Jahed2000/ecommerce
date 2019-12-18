@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-10 offset-md-1">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Orders</h4>
                  <p class="card-description">
                    viewing all orders
                  </p>
                  {{-- view update message --}}
                  @include('admin.partials.messages')
                  {{-- end --}}

                  {{--  TABLE BELOW USES data tables - a plug-in for the jQuery Javascript library. --}}
 <table class="table table-hover table-striped" id="dataTable">
                    <thead>
                      <th>Sr</th>
                        <th>order ID</th>
                        <th>orderer name</th>
                        <th>orderer phone no</th>
                        <th>order status</th>
                        <th>action</th>
                    </thead>
                    @foreach($orders as $order)

                    <tr>
                      <td>{{ $loop->index +1 }}</td>
                      <td>#LE{{$order->id}}</td>
                      <td>{{$order->name}}</td>
                      <td>{{$order->phone_no}}</td>
                      <td>
                        <p>
                          @if($order->is_seen_by_admin)
                            <button class="btn btn-success btn-sm">seen</button>
                            @else
                            <button class="btn btn-warning btn-sm">unseen</button>
                          @endif
                        </p>

                        <p>
                          @if($order->is_paid)
                            <button class="btn btn-success btn-sm">paid</button>
                            @else
                            <button class="btn btn-danger btn-sm">unpaid</button>
                          @endif
                        </p>

                        <p>
                          @if($order->is_completed)
                            <button class="btn btn-success btn-sm">complete</button>
                            @else
                            <button class="btn btn-warning btn-sm">incomplete</button>
                          @endif
                        </p>
                      </td>
                      
               
                      <td>
                        <ul class="list-inline">
                          <a class="btn btn-success" href="{{route('admin.order.show',$order->id)}}">View</a>
                          {{-- <a class="btn btn-warning" href="{{route('admin.order.show',$order->id)}}">invoice</a> --}}
                          <a class="btn btn-info" data-toggle="modal"  href="#DeleteModal{{$order->id}}">Delete</a>
                        </ul>
                        </td>
                    </tr>
{{-- DELETE MODAL  --}}
<div class="modal fade" id="DeleteModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Delete {{$order->name}} ?</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="{{route('admin.order.delete',$order->id)}}">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- END DELETE MODAL --}}
        @endforeach
                  </table>
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