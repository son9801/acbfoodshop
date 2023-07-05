@extends('layouts.app')

@section('title', 'Thực phẩm xanh ACB')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>Kết quả tìm kiếm</h4>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">

                    <div class="row g-0">
        
                        @forelse ($searchProducts as $productItem)
                            <div class="col-lg-3 col-md-3  col-sm-3 col-6 product-col">
                                <div class="product-card">
                                    <div class="product-card-img">
        
                                        @if ($productItem->quantity > 0)
                                            <label class="stock bg-success">Còn hàng</label>
                                        @else
                                            <label class="stock bg-danger">Hết hàng</label>
                                        @endif
                                        <br>
                                        @if ($productItem->trending == 1)
                                            <label class="stock bg-warning">Bán chạy</label>
                                        @endif
                                        @if ($productItem->productImages->count() > 0)
                                            <a
                                                href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                <img src="{{ asset($productItem->productImages[0]->image) }}" alt="">
                                            </a>
                                        @endif
        
                                    </div>
                                    <div class="product-card-body">
                                        <h5>
                                            <a class="product-name"
                                                href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                {{ $productItem->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">{{ $productItem->selling_price }}đ</span>
                                            @if ($productItem->selling_price < $productItem->original_price)
                                                <span class="original-price">{{ $productItem->original_price }}đ</span>
                                                <span
                                                    class="stock bg-danger">-{{ round(($productItem->selling_price / $productItem->original_price) * 100 )}}%</span>
                                            @endif
                                        </div>
                                        <div class="mt-2">
                                            <button wire:click="addToCart({{ $productItem->id }})" class="btn btn1">Thêm vào
                                                giỏ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="p-2">
                                    <h4>Không có sản phẩm thuộc danh mục này</h4>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-10 justify-content-center">
                    {{-- {{ $searchProducts->appends(request()->input())->links() }} --}}
                </div>
            </div>


        </div>

    </div>
@endsection
