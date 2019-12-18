      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image"> <img src="{{asset('images/faces/face4.jpg')}}" alt="image"/> <span class="online-status online"></span> </div>
              <div class="profile-name">
                <p class="name">Richard V.Welsh</p>
                <p class="designation">Manager</p>
                <div class="badge badge-teal mx-auto mt-3">Online</div>
              </div>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.products') }}"><img class="{{asset('menu-icon')}}" src="{{asset('images/menu_icons/01.png')}}" alt="menu icon"><span class="menu-title">Dashboard</span></a></li>
          
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/05.png')}}" alt="menu icon"> <span class="menu-title">Manage Products</span></a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.products')}}">Products</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.product.create')}}">Add Products</a></li>
              </ul>
            </div>
          </li>

           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#order-pages" aria-expanded="false" aria-controls="order-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/05.png')}}" alt="menu icon"> <span class="menu-title">Orders</span></a>
            <div class="collapse" id="order-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.orders')}}">Manage Orders</a></li>{{-- 
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.order.create')}}">Add Products</a></li> --}}
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#slider-pages" aria-expanded="false" aria-controls="slider-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/05.png')}}" alt="menu icon"> <span class="menu-title">Manage Sliders</span></a>
            <div class="collapse" id="slider-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.sliders')}}">Sliders</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#category-pages" aria-expanded="false" aria-controls="category-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/06.png')}}" alt="menu icon"> <span class="menu-title">Manage Categories</span></a>
            <div class="collapse" id="category-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.categories')}}">Categories</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.category.create')}}">Add Categories</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#brand-pages" aria-expanded="false" aria-controls="brand-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/07.png')}}" alt="menu icon"> <span class="menu-title">Manage Brands</span></a>
            <div class="collapse" id="brand-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.brands')}}">Brands</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.brand.create')}}">Add Brands</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#division-pages" aria-expanded="false" aria-controls="division-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/08.png')}}" alt="menu icon"> <span class="menu-title">Manage Divisions</span></a>
            <div class="collapse" id="division-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.divisions')}}">Divisions</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.division.create')}}">Add Divisions</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#district-pages" aria-expanded="false" aria-controls="district-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/09.png')}}" alt="menu icon"> <span class="menu-title">Manage Districts</span></a>
            <div class="collapse" id="district-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.districts')}}">Districts</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.district.create')}}">Add Districts</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}"><img class="{{asset('menu-icon')}}" src="{{asset('images/menu_icons/04.png')}}" alt="menu icon"><span class="menu-title">Logout</span></a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="{{asset('images/menu_icons/08.png')}}" alt="menu icon"> <span class="menu-title">General Pages</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html">Blank Page</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html">Login</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html">Register</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html">404</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html">500</a></li>
              </ul>
            </div>
          </li> 
          <li class="nav-item"><a class="nav-link" href="pages/ui-features/typography.html"><img class="menu-icon" src="{{asset('images/menu_icons/09.png')}}" alt="menu icon"> <span class="menu-title">Typography</span></a></li> --}}
        </ul>
      </nav>

      <!-- partial -->