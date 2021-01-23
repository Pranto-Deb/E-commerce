        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="{{asset('images/faces/face8.jpg')}}" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Allen Moreno</p>
                  <p class="designation">Premium user</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.index')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Product Info</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.product.create')}}">Add Product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.products')}}">Manage Product</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#order_pages" aria-expanded="false" aria-controls="order_pages">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Order Info</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="order_pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.orders')}}">Manage Orders</a>
                  </li>
                </ul>
              </div>
            </li>            
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth2">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Category Info</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.category.create')}}">Add Category</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.categories')}}">Manage Category</a>
                  </li>
                </ul>
              </div>
            </li>            
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth3" aria-expanded="false" aria-controls="auth3">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Brand Info</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth3">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.brand.create')}}">Add Brand</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.brands')}}">Manage Brand</a>
                  </li>
                </ul>
              </div>
            </li> 
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth4" aria-expanded="false" aria-controls="auth4">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Division Info</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth4">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.division.create')}}">Add Division</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.divisions')}}">Manage Division</a>
                  </li>
                </ul>
              </div>
            </li> 
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth5" aria-expanded="false" aria-controls="auth5">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">District Info</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth5">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.district.create')}}">Add District</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.districts')}}">Manage District</a>
                  </li>
                </ul>
              </div>
            </li> 
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth6" aria-expanded="false" aria-controls="auth6">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Slider Info</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth6">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.sliders')}}">Manage Slider</a>
                  </li>
                </ul>
              </div>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">
                <form class="form-inline" action="{{ route('admin.logout') }}" method="post">
                  {{ csrf_field() }}
                  <input type="submit" value="Logout" class="btn btn-danger">
                </form>
              </a>
            </li> 
        </ul>
  </nav>