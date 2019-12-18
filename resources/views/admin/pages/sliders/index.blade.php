@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-9 offset-md-1">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sliders</h4>
                  <p class="card-description">
                    manage sliders
                  </p>
                  {{-- view update message --}}
                  @include('admin.partials.messages')
                  {{-- end --}}
                  <a class="btn btn-info mb-3 mt-2" data-toggle="modal"  href="#AddModal">Add Slider</a>

                  <table class="table table-hover table-striped">
                    <thead>
                      <th>Sr</th>
                      <th>title</th>
                      <th>image</th>
                      <th>priority</th>
                      <th>action</th>
                    </thead>
                    @php $i=0; @endphp
                    @foreach($sliders as $slider)
                    @php $i++; @endphp

                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$slider->title}}</td>
                      <td>
                        <img src="{{ asset('images/sliders/'.$slider->image) }}" width="100">
                      </td>
                      <td>{{$slider->priority}}</td>
               
                      <td>
                        <ul class="list-inline">
                          <a class="btn btn-success" data-toggle="modal"  href="#editModal{{$slider->id}}">Edit</a>
                          <a class="btn btn-danger" data-toggle="modal"  href="#DeleteModal{{$slider->id}}">Delete</a>
                        </ul>
                        </td>
                    </tr>
              

{{-- DELETE MODAL  --}}
<div class="modal fade" id="DeleteModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Delete {{$slider->name}} ?</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="{{route('admin.slider.delete',$slider->id)}}">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- END DELETE MODAL --}}

{{-- EDIT slider MODAL  --}}
<div class="modal fade" id="editModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>edit slider</p>
        <form class="forms-sample" method="post" action="{{ route('admin.slider.update',$slider->id) }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="title">slider title</label>
              <input type="text" name="title" value="{{$slider->title}}" class="form-control" id="exampleInputName1" placeholder="slider title" required>
            </div>
            <div class="form-group">
              <label for="image">slider image 
              <a href="{{ asset('images/sliders/'.$slider->image) }}" target="_blank" class="btn btn-warning">previous image</a>
              </label>
              <input type="file" name="image" class="form-control" id="exampleInputName1" placeholder="slider image">
            </div>
            <div class="form-group">
              <label for="button_text">button text</label>
              <input type="text" name="button_text" value="{{$slider->button_text}}" class="form-control" id="exampleInputName1" placeholder="button text">
            </div>
            <div class="form-group">
              <label for="button_link">button link</label>
              <input type="url" name="button_link" value="{{$slider->button_link}}" class="form-control" id="exampleInputName1" placeholder="button link">
            </div>
            <div class="form-group">
              <label for="priority">priority</label>
              <input type="number" name="priority" value="{{$slider->priority}}" class="form-control" id="exampleInputName1" placeholder="priority">
            </div>
          <input class="btn btn-success" type="submit" value="update">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- END EDIT slider MODAL --}}
        @endforeach

{{-- ADD slider MODAL  --}}
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Add new slider</p>
        <form class="forms-sample" method="post" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="title">slider title <small>(required)</small></label>
              <input type="text" name="title" class="form-control" id="exampleInputName1" placeholder="slider title" required>
            </div>
            <div class="form-group">
              <label for="image">slider image <small>(required)</small></label>
              <input type="file" name="image" class="form-control" id="exampleInputName1" placeholder="slider image" required>
            </div>
            <div class="form-group">
              <label for="button_text">button text <small>(optional)</small></label>
              <input type="text" name="button_text" class="form-control" id="exampleInputName1" placeholder="button text">
            </div>
            <div class="form-group">
              <label for="button_link">button link <small>(optional)</small></label>
              <input type="url" name="button_link" class="form-control" id="exampleInputName1" placeholder="button link">
            </div>
            <div class="form-group">
              <label for="priority">priority <small>(required)</small></label>
              <input type="number" name="priority" class="form-control" id="exampleInputName1" placeholder="priority">
            </div>
          <input class="btn btn-success" type="submit" value="Add new">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- END ADD slider MODAL --}}


                   
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