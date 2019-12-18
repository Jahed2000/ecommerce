

    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container">
              <a class="navbar-brand" href="{{ route('index') }}">Ecommerce</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('products') }}">Products</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
                  </li>
                  {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </li> --}}
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('contact') }}" tabindex="-1" aria-disabled="false">Contact</a>
                  </li>
                  <form action="{{ route('search') }}" method="get" class="form-inline my-2 my-lg-0">
                  <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="search products" aria-label="Recipient's username" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                </form>
                </ul>

                <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                                <a class="nav-link" style="color: #EFFFFD" href="{{ route('carts') }}">
                                  <button class="btn btn-danger">
                                    <span class="mt-2">Cart</span>
                                    <span id="nav-totalItems" class="badge badge-primary">
                                      {{ App\Models\Cart::totalItems() }}
                                    </span>
                                  </button>
                                </a>
                      </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" style="color: #EFFFFD" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" style="color: #EFFFFD" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="color: #EFFFFD" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" style="width: 50px;" class="img rounded-circle">
                                    {{-- class="img rounded-circle" bootstrap class --}}
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('user.dashboard') }}">{{ __('Dahsboard') }}</a>
                                  
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                
              </div>
          </div>
        </nav>
    </div>