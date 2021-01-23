@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
      <div class="content-wrapper">
        <div class="card-header">
          Add Product
        </div>
      <div class="card">
        <div class="card-body">
          <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          @include('backend.partials.messages')

          <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product title">
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <textarea name="description" class="form-control" rows="8" cols="80"></textarea>
          </div>
          <div class="form-group">
          <label for="exampleInputEmail1">Price</label>
          <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product price">
          </div>
          <div class="form-group">
          <label for="exampleInputEmail1">Quantity</label>
          <input type="number" class="form-control" name="quantity" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product quantity">
          </div>
          <div class="form-group">
          <label for="exampleInputEmail1">Select Category</label>
          <select class="form-control" name="category_id">
            <option>Select a category for the product</option>
           @foreach(App\Models\Category::orderBy('name', 'asc')
                               ->where('parent_id', NULL)->get() as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
             @foreach(App\Models\Category::orderBy('name', 'asc')
                               ->where('parent_id', $category->id)->get() as $sub)
              <option value="{{$sub->id}}">-------->{{$sub->name}}</option>
              @endforeach
            @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="exampleInputEmail1">Select Brand</label>
          <select class="form-control" name="brand_id">
            <option>Select a brand for the product</option>
           @foreach(App\Models\Brand::orderBy('name', 'asc')->get() as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="product_image">Product Image</label>
          <div class="row">
            <div class="col-md-4">
              <input type="file" class="form-control" name="product_image[]" id="product_image1">
            </div>
            <div class="col-md-4">
              <input type="file" class="form-control" name="product_image[]" id="product_image2">
            </div>
            <div class="col-md-4">
              <input type="file" class="form-control" name="product_image[]" id="product_image3">
            </div>
            <div class="col-md-4">
              <input type="file" class="form-control" name="product_image[]" id="product_image4">
            </div> 
            <div class="col-md-4">
              <input type="file" class="form-control" name="product_image[]" id="product_image5">
            </div>
          </div>
          </div>
          <button type="submit" class="btn btn-primary">Add Product</button>
          </form>
        </div>
      </div>
      </div>
</div>
@endsection