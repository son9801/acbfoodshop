<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 my-auto d-none d-sm-none d-md-block d-lg-block">
                   <a class="nav-link" style="font-size:30px " href={{ url('/') }} > {{ $appSetting->website_name ?? 'website name' }}</a>
                </div>      
                <div class="col-md-4 my-auto">
                    <form action={{ url('search') }} method="GET" role="search">
                        <div class="input-group">
                            <input type="search" name="search" value="{{ Request::get('search') }}" placeholder="Nhập tên sản phẩm muốn tìm" class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 my-auto">
                    <ul class="nav justify-content-end">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('cart') }}">
                                <i class="fa fa-shopping-cart"></i> Giỏ hàng (<livewire:frontend.cart.cartcount/>)
                            </a>
                        </li>
                 

                        {{-- Login and register --}}
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                </li>
                            @endif
                        @else

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i>  {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-user"></i>Thông tin tài khoản</a></li>
                                <li><a class="dropdown-item" href="{{ url('change-password') }}"><i class="fa fa-user"></i>Đổi mật khẩu</a></li>
                                <li><a class="dropdown-item" href="{{ url('orders') }}"><i class="fa fa-list"></i>Đơn hàng</a>
                                </li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>{{ __('Đăng xuất') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid ">
            {{-- <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                Thực phẩm ACB
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
             --}}
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav  mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/collections')}}">DANH MỤC</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{url('/sale')}}">KHUYẾN MÃI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/trending')}}">BÁN CHẠY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/new-arrivals') }}">MẶT HÀNG MỚI</a>
                    </li>
                    
                    @forelse ($navBarCategories as $categoryItem)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/collections/'.$categoryItem->slug) }}">{{ $categoryItem -> name }}</a>
                    </li>
                    @empty
                    <div class="col-md-12">
                        <h5>Không có danh mục</h5>
                    </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </nav>
</div>
