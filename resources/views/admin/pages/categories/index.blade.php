@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-9 offset-md-1">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Categories</h4>
                  <p class="card-description">
                    viewing all categories
                  </p>
                  {{-- view update message --}}
                  @include('admin.partials.messages')
                  {{-- end --}}
                  <table class="table table-hover table-striped">
                    <thead>
                      <th>Sr</th>
                      <th>ID</th>
                      <th>name</th>
                      <th>parent category</th>
                      <th>description</th>
                      <th>image</th>
                      <th>action</th>
                    </thead>
                    @php $i=0; @endphp
                    @foreach($category as $cat)
                    @php $i++; @endphp

                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$cat->id}}</td>
                      <td>{{$cat->name}}</td>
                      <td>
                        @if($cat->parent_id==NULL)
                          Primary Category
                        @else
                          {{$cat->parent->name}}
                        @endif
                      </td>
                      <td>{{$cat->description}}</td>
                      <td>
                        <img src="{{ asset('images/categories/'.$cat->image) }}">
                      </td>
                      
              
              {{-- @php $j=1; @endphp

              <td>@foreach($product->images as $image)
              
              @if($j>0)
                <img class="card-img-top" src="{{asset('images/products/'.$image->image)}}" alt="Card image">
              @endif
              @php $j--; @endphp --}}

              
               {{-- </td> --}}
               
                      <td>
                        <ul class="list-inline">
                          <li><a class="btn btn-success" href="{{route('admin.category.edit',$cat->id)}}">Edit</a></li>
                          <li><a class="btn btn-danger" data-toggle="modal"  href="#DeleteModal{{$cat->id}}">Delete</a></li>
                        </ul>
                        </td>
                    </tr>
              

{{-- DELETE MODAL  --}}
<div class="modal fade" id="DeleteModal{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Delete {{$cat->name}} ?</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="{{route('admin.category.delete',$cat->id)}}">Delete</a>
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