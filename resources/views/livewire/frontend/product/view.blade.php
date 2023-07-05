<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="row">
                <div class="col-md-4 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                            {{-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> --}}
                            <div class="exzoom" id="exzoom">
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($product->productImages as $itemImg)
                                            <li><img src="{{ asset($itemImg->image) }}" /></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn">
                                        < </a>
                                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            Không có ảnh của sản phẩm này
                        @endif

                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                            @if ($product->quantity > 0)
                                <label class="label-stock bg-success">Còn hàng</label>
                            @else
                                <label class="label-stock bg-danger">Hết hàng</label>
                            @endif

                        </h4>
                        <hr>
                        <p class="product-path">
                            Trang chủ/ {{ $product->category->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">{{ $product->selling_price }}đ</span>
                            @if ($product->selling_price < $product->original_price)
                                <span class="original-price">{{ $product->original_price }}đ</span>
                                <span
                                    class="stock bg-danger">-{{ 100-(round(($product->selling_price / $product->original_price) * 100) )}}%</span>
                            @endif

                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}"
                                    class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn1" wire:click="addToCart({{ $product->id }})">
                                <i class="fa fa-shopping-cart"> </i> Thêm vào giỏ
                            </button>
                            {{-- <a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="product-policises-wrapper">
                        <h5>Duy nhất tại ABC Food</h5>
                        <ul class="product-policises">
                            <li class="media">
                                <span class="material-symbols-outlined media-icon">
                                    local_shipping
                                </span>
                                <div class="media-text">
                                    Free ship cho đơn hàng từ 299k
                                </div>
                            </li>
                            <li class="media">
                                <span class="material-symbols-outlined media-icon">
                                    update
                                </span>
                                <div class="media-text">
                                    Giao trong vòng 2h
                                </div>
                            </li>
                            <li class="media">
                                <span class="material-symbols-outlined media-icon">
                                    nutrition
                                </span>
                                <div class="media-text">
                                    Thực phẩm hữu cơ xanh và sạch
                                </div>
                            </li>
                            <li class="media"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Mô tả sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-1 py-md-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-12 mb-3">
                    <h3>Sản phẩm liên quan</h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme trending-product">
                        @forelse ($category->relatedProducts as $relatedProductItem)
                            <div class="item">
                                {{-- <div class="col-md-3"> --}}
                                <div class="product-card">
                                    <div class="product-card-img">
                                        @if ($relatedProductItem->quantity > 0)
                                            <label class="stock bg-success">Còn hàng</label>
                                        @else
                                            <label class="stock bg-danger">Hết hàng</label>
                                        @endif
                                        <br>
                                        @if ($relatedProductItem->trending == 1)
                                            <label class="stock bg-warning">Bán chạy</label>
                                        @endif
                                        @if ($relatedProductItem->productImages->count() > 0)
                                            <a
                                                href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                <img src="{{ asset($relatedProductItem->productImages[0]->image) }}"
                                                    alt="">
                                            </a>
                                        @endif

                                    </div>
                                    <div class="product-card-body">

                                        <h5>
                                            <a class="product-name"
                                                href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                {{ $relatedProductItem->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span
                                                class="selling-price">{{ $relatedProductItem->selling_price }}đ</span>
                                            <span
                                                class="original-price">{{ $relatedProductItem->original_price }}đ</span>
                                        </div>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn1" wire:click="addToCart({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"> </i> Thêm vào giỏ
                                            </button>
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
            </div>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        $(function() {

            $("#exzoom").exzoom({
                "navWidth": 50,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": true,
                "autoPlayTimeout": 10000

            });

        });
    </script>
@endpush
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
@endsection
