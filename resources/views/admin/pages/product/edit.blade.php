@extends('admin.layouts.master')

@section('content')

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="card">
                <div class="card-body" style="width: 100%;background: #ccc;">
                  <h4 class="card-title">Add products</h4>
                  <p class="card-description">
                    enter product informatio
                  </p>
                  <form action="{{ route('admin.product.update') }}" method="post" class="forms-sample" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="form-group">
                      <label for="exampleInputName1">title</label>
                      <input type="text" name="title" class="form-control" id="exampleInputName1" placeholder="title" value="{{$product->title}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">price</label>
                      <input type="number" name="price" class="form-control" id="exampleInputName1" placeholder="price" value="{{$product->price}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">quantity</label>
                      <input type="number" name="quantity" class="form-control" id="exampleInputName1" placeholder="quantity" value="{{$product->quantity}}">
                    </div>
                    {{-- <div class="form-group">
                      <label for="exampleInputEmail3">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div> --}}
                    {{-- <div class="form-group">
                      <label>Image upload</label>
                      <input type="file" name="product_image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="file" name="product_image" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                        </span>
                      </div>
                    </div> --}}
                    <div class="form-group ">
                      <label>Image upload</label>
                      <div class="row">
                        <div class="col-md-4">
                          <input type="file" name="product_image[]" class="form-control file-upload-info" id="exampleInputFile" aria-describedby="fileHelp">
                        </div>
                        <div class="col-md-4">
                          <input type="file" name="product_image[]" class="form-control file-upload-info" id="exampleInputFile" aria-describedby="fileHelp">
                        </div>
                        <div class="col-md-4">
                          <input type="file" name="product_image[]" class="form-control file-upload-info" id="exampleInputFile" aria-describedby="fileHelp">
                        </div>
                      </div>
                    </div>
                    {{-- <div class="form-group">
                      <label for="exampleInputCity1">City</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div> --}}
                    <div class="form-group">
                      <label for="exampleTextarea1">description</label>
                      <textarea  name="description" class="form-control" id="exampleTextarea1" rows="3" placeholder="description">{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                          <label for="exampleSelect1">Category</label>
                          <select name="category_id" class="form-control" id="exampleSelect1">
                            @foreach(App\Models\Category::orderBy('id','asc')->where('parent_id',NULL)->get() as $parent)
                            <option value="{{ $parent->id }}">{{ strtoupper($parent->name) }}</option> {{-- strtoupper to capitalize string --}}
                            @foreach(App\Models\Category::orderBy('id','asc')->where('parent_id',$parent->id)->get() as $child)
                            <option value="{{ $child->id }}" {{ $child->id==$product->category->id ? 'selected' : '' }} >--{{" ".$child->name }}</option>
                            @endforeach
                            @endforeach 
                          </select>
                    </div>
                    <div class="form-group">
                          <label for="exampleSelect1">Brand</label>
                          <select name="brand_id" class="form-control" id="exampleSelect1">
                            @foreach($brand as $bra)
                            <option value="{{ $bra->id }}" {{ $bra->id==$product->brand->id ? 'selected' : '' }}>{{ $bra->name }}</option>
                            @endforeach
                          </select>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Update</button>
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
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>

@endsection