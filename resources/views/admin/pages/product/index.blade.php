@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-9 offset-md-1">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All products</h4>
                  <p class="card-description">
                    viewing all products
                  </p>
                  {{-- view update message --}}
                  @include('admin.partials.messages')
                  {{-- end --}}
                  <table class="table table-hover table-striped" id="dataTable">
                    <thead>
                      <th>Sr</th>
                      <th>title</th>
                      <th>description</th>
                      <th>price</th>
                      <th>quantity</th>
                      <th>category</th>
                      <th>brand</th>
                      <th>img</th>
                      <th>action</th>
                    </thead>
                    @php $i=0; @endphp
                    @foreach($products as $product)
                    @php $i++; @endphp

                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$product->title}}</td>
                      <td style="max-width: 200px;">{{$product->description}}</td>
                      <td>{{$product->price}}</td>
                      <td>{{$product->quantity}}</td>
                      <td>{{$product->category->name}}</td>
                      <td>{{$product->brand->name}}</td>
              
              @php $j=1; @endphp

                      <td>@foreach($product->images as $image)
                      
                      @if($j>0)
                        <img class="card-img-top" src="{{asset('images/products/'.$image->image)}}" alt="Card image" style="width: 50px;">
                      @endif
                      @php $j--; @endphp

                       @endforeach
                       </td>
               
                      <td>
                        <ul list-inline>
                          <a class="btn btn-success" href="{{route('admin.product.edit',$product->id)}}">Edit</a>
                          <a class="btn btn-danger" data-toggle="modal"  href="#DeleteModal{{$product->id}}">Delete</a>
                        </ul>
                        </td>
                    </tr>
{{-- DELETE MODAL  --}}
<div class="modal fade" id="DeleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Delete {{$product->title}} ?</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="{{route('admin.product.delete',$product->id)}}">Delete</a>
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
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>

@endsection