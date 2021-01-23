@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="card card-body">
              <h3>Welcome to Our Admin Panel</h3>
              <br>
              <p>
              <a href="{{route('index')}}" target="_blank" class="btn btn-primary btn-lg">Visit Our Main Site</a>
              </p>
            </div>  
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>

@endsection