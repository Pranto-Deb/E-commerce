@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
      <div class="content-wrapper">
        <div class="card-header">
          Add Category
        </div>
      <div class="card">
        <div class="card-body">
          <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          @include('backend.partials.messages')

          <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter category name">
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <textarea name="description" class="form-control" rows="8" cols="80"></textarea>
          </div> 
          <div class="form-group">
          <label for="exampleInputPassword1">Parent Category</label>
          <select class="form-control" name="parent_id">
            <option value="">Please select a Primary Category</option>
            @foreach($main_categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="image">Category Image</label>
            <input type="file" class="form-control" name="image" id="image">
          </div>
          <button type="submit" class="btn btn-primary">Add Category</button>
          </form>
        </div>
      </div>
      </div>
</div>
@endsection