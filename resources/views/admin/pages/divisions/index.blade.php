@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-9 offset-md-1">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Divisions</h4>
                  <p class="card-description">
                    viewing all divisions
                  </p>
                  {{-- view update message --}}
                  @include('admin.partials.messages')
                  {{-- end --}}
                  <table class="table table-hover table-striped">
                    <thead>
                      <th>Sr</th>
                      <th>name</th>
                      <th>priority</th>
                    </thead>
                    @php $i=0; @endphp
                    @foreach($divisions as $div)
                    @php $i++; @endphp

                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$div->name}}</td>
                      <td>{{$div->priority}}</td>
               
                      <td>
                        <ul class="list-inline">
                          <a class="btn btn-success" href="{{route('admin.division.edit',$div->id)}}">Edit</a>
                          <a class="btn btn-danger" data-toggle="modal"  href="#DeleteModal{{$div->id}}">Delete</a>
                        </ul>
                        </td>
                    </tr>
              

{{-- DELETE MODAL  --}}
<div class="modal fade" id="DeleteModal{{$div->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">confirm action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Delete {{$div->name}} ?</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href="{{route('admin.division.delete',$div->id)}}">Delete</a>
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