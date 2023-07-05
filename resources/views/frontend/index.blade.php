@extends('layouts.app')

@section('title', 'Thực phẩm xanh ACB')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

                <div class="carousel-inner">
                    @foreach ($sliders as $key => $sliderItem)
                        <div class="carousel-item  {{ $key == 0 ? 'active' : '' }}">
                            @if ($sliderItem->image)
                                <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="...">
                            @endif
                            {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $sliderItem->title }}</h5>
                        <p>{{ $sliderItem->description }}
                    </div> --}}
                            <div class="carousel-caption d-none d-md-block">
                                <div class="custom-carousel-content">
                                    <h2>
                                        {{ $sliderItem->title }}
                                    </h2>
                                    <p>
                                        {{ $sliderItem->description }}
                                    </p>
                                    <div>
                                        <a href="#" class="btn btn-slider">
                                            Mua ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>


    <div class="py-3 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Chào mừng bạn đến mua hàng tại ACB Food</h4>
                    <div class="underline mx-auto"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-justify: inter-word;text-align: justify;font-size:20px">
                    <p>ACB Food là một cửa hàng thực phẩm chuyên cung cấp các loại thực phẩm tươi, xanh và sạch. Chúng tôi
                        cam kết mang đến cho khách hàng những sản phẩm chất lượng nhất từ các nhà sản xuất đáng tin cậy. Tại
                        ACB Food, chúng tôi đặc biệt chú trọng đến việc chọn lựa các sản phẩm được sản xuất một cách tự
                        nhiên, không sử dụng hóa chất độc hại hay thuốc trừ sâu, giúp bảo vệ sức khỏe của khách hàng. Hãy
                        đến với ACB Food để tận hưởng hương vị tươi ngon và an toàn cho sức khỏe!</p>
                </div>
            </div>

        </div>
    </div>

    <div class="py-2 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>SẢN PHẨM MỚI VỀ</h4>
                    <div class="underline"></div>
                </div>
                @if ($newArrivalsProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme trending-product">
                            @foreach ($newArrivalsProducts as $newArrivalsProductsItem)
                                <div class="item">
                                    {{-- <div class="col-md-3"> --}}
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($newArrivalsProductsItem->quantity > 0)
                                                <label class="stock bg-success">Còn hàng</label>
                                            @else
                                                <label class="stock bg-danger">Hết hàng</label>
                                            @endif
                                            <br>
                                            @if ($newArrivalsProductsItem->trending == 1)
                                                <label class="stock bg-warning">Bán chạy</label>
                                            @endif
                                            @if ($newArrivalsProductsItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $newArrivalsProductsItem->category->slug . '/' . $newArrivalsProductsItem->slug) }}">
                                                    <img src="{{ asset($newArrivalsProductsItem->productImages[0]->image) }}"
                                                        alt="">
                                                </a>
                                            @endif

                                        </div>
                                        <div class="product-card-body">

                                            <h5>
                                                <a class="product-name"
                                                    href="{{ url('/collections/' . $newArrivalsProductsItem->category->slug . '/' . $newArrivalsProductsItem->slug) }}">
                                                    {{ $newArrivalsProductsItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span
                                                    class="selling-price">{{ $newArrivalsProductsItem->selling_price }}đ</span>
                                                @if ($newArrivalsProductsItem->selling_price < $newArrivalsProductsItem->original_price)
                                                    <span
                                                        class="original-price">{{ $newArrivalsProductsItem->original_price }}đ</span>
                                                    <span
                                                        class="stock bg-danger">-{{100-(round(($newArrivalsProductsItem->selling_price / $newArrivalsProductsItem->original_price) * 100)) }}%</span>
                                                @endif
                                            </div>
                                            <div class="mt-2">
                                                <button class="btn btn1 addToCart "
                                                    data-product-id={{ $newArrivalsProductsItem->id }}>Thêm vào
                                                    giỏ</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>Không có sản phẩm thuộc danh mục này</h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-md-4 text-center">
                    <a type="button" class="btn text-white" style="background-color:#009900;border-radius:10px"
                        href="new-arrivals">Xem thêm > </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>SẢN PHẨM BÁN CHẠY</h4>
                    <div class="underline"></div>
                </div>
                @if ($trendingProducts)

                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme trending-product">
                            @forelse ($trendingProducts as $newArrivalsProducts)
                                <div class="item">
                                    {{-- <div class="col-md-3"> --}}
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($newArrivalsProducts->quantity > 0)
                                                <label class="stock bg-success">Còn hàng</label>
                                            @else
                                                <label class="stock bg-danger">Hết hàng</label>
                                            @endif
                                            <br>
                                            @if ($newArrivalsProducts->trending == 1)
                                                <label class="stock bg-warning">Bán chạy</label>
                                            @endif
                                            @if ($newArrivalsProducts->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $newArrivalsProducts->category->slug . '/' . $newArrivalsProducts->slug) }}">
                                                    <img src="{{ asset($newArrivalsProducts->productImages[0]->image) }}"
                                                        alt="">
                                                </a>
                                            @endif

                                        </div>
                                        <div class="product-card-body">

                                            <h5>
                                                <a class="product-name"
                                                    href="{{ url('/collections/' . $newArrivalsProducts->category->slug . '/' . $newArrivalsProducts->slug) }}">
                                                    {{ $newArrivalsProducts->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span
                                                    class="selling-price">{{ $newArrivalsProducts->selling_price }}đ</span>
                                                <span
                                                    class="original-price">{{ $newArrivalsProducts->original_price }}đ</span>
                                            </div>
                                            <div class="mt-2">
                                                <a href="" class="btn btn1">Thêm vào giỏ</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- </div> --}}
                            @empty
                                <div class="col-md-12 p-2">
                                    <h4>Không có sản phẩm thuộc danh mục này</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>Không có sản phẩm</h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-md-4 text-center">
                    <a type="button" class="btn text-white" style="background-color:#009900;border-radius:10px"
                        href="trending">Xem thêm > </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2 bg-light mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>SẢN PHẨM KHUYẾN MÃI</h4>
                    <div class="underline"></div>
                </div>
                @if ($saleProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme trending-product">
                            @foreach ($saleProducts as $newArrivalsProducts)
                                <div class="item">
                                    {{-- <div class="col-md-3"> --}}
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($newArrivalsProducts->quantity > 0)
                                                <label class="stock bg-success">Còn hàng</label>
                                            @else
                                                <label class="stock bg-danger">Hết hàng</label>
                                            @endif
                                            <br>
                                            @if ($newArrivalsProducts->trending == 1)
                                                <label class="stock bg-warning">Bán chạy</label>
                                            @endif
                                            @if ($newArrivalsProducts->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $newArrivalsProducts->category->slug . '/' . $newArrivalsProducts->slug) }}">
                                                    <img src="{{ asset($newArrivalsProducts->productImages[0]->image) }}"
                                                        alt="">
                                                </a>
                                            @endif

                                        </div>
                                        <div class="product-card-body">

                                            <h5>
                                                <a class="product-name"
                                                    href="{{ url('/collections/' . $newArrivalsProducts->category->slug . '/' . $newArrivalsProducts->slug) }}">
                                                    {{ $newArrivalsProducts->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span
                                                    class="selling-price">{{ $newArrivalsProducts->selling_price }}đ</span>
                                                @if ($newArrivalsProducts->selling_price < $newArrivalsProducts->original_price)
                                                    <span
                                                        class="original-price">{{ $newArrivalsProducts->original_price }}đ</span>
                                                    <span
                                                        class="stock bg-danger">-{{ 100 - round(($newArrivalsProducts->selling_price / $newArrivalsProducts->original_price) * 100) }}%</span>
                                                @endif
                                            </div>
                                            <div class="mt-2">
                                                <a href="" class="btn btn1">Thêm vào giỏ</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>Không có sản phẩm thuộc danh mục này</h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-md-4 text-center">
                    <a type="button" class="btn text-white" style="background-color:#009900;border-radius:10px"
                        href="sale">Xem thêm > </a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $('.trending-product').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.addToCart').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'addToCart',
                    data: {
                        'productId': productId
                    },

                    success: function(response) {
                        if (response.status == 200) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Đã xảy ra lỗi: ' + error);
                    }
                });
            });
        });
    </script>
@endsection
