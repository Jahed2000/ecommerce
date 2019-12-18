@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="card">
                <div class="card-body" style="width: 100%;">
                  <h4 class="card-title">Add District</h4>
                  <p class="card-description">
                    enter district information
                  </p>

                  @include('admin.partials.messages')
                  <form action="{{ route('admin.district.store') }}" method="post" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputName1">name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="name">
                    </div>
                    <div class="form-group">
                          <label for="exampleSelect1">Division</label>
                          <select name="division_id" class="form-control" id="exampleSelect1">
                            @foreach($divisions as $div)
                            <option value="{{ $div->id }}">{{ $div->name }}</option>
                            @endforeach
                          </select>
                        </div>
                    
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    </div>
@endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
@include('admin.partials.footer')
al -->
      </div>

@endsection