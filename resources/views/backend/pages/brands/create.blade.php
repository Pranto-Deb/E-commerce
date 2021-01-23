@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
      <div class="content-wrapper">
        <div class="card-header">
          Add Brand
        </div>
      <div class="card">
        <div class="card-body">
          <form action="{{route('admin.brand.store')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          @include('backend.partials.messages')

          <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter brand name">
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <textarea name="description" class="form-control" rows="8" cols="80"></textarea>
          </div> 
          
          <div class="form-group">
          <label for="image">Brand Image</label>
            <input type="file" class="form-control" name="image" id="image">
          </div>
          <button type="submit" class="btn btn-primary">Add Brand</button>
          </form>
        </div>
      </div>
      </div>
</div>
@endsection