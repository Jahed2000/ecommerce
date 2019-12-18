@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="card">
                <div class="card-body" style="width: 100%;">
                  <h4 class="card-title">Add category</h4>
                  <p class="card-description">
                    enter category information
                  </p>

                  @include('admin.partials.messages')
                  <form action="{{ route('admin.category.store') }}" method="post" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputName1">name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="name">
                    </div>
                    <div class="form-group ">
                      <label>Image upload</label>
                      <div class="row">
                          <input type="file" name="image" class="form-control file-upload-info" id="exampleInputFile" aria-describedby="fileHelp">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">description</label>
                      <textarea  name="description" class="form-control" id="exampleTextarea1" rows="3" placeholder="description"></textarea>
                    </div>
                        <div class="form-group">
                          <label for="exampleSelect1">Parent Category</label>
                          <select name="parent_id" class="form-control" id="exampleSelect1">
                            <option value="0">None</option>
                            @foreach($primary_categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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