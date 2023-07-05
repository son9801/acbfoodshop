<div>
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">Giá </div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" /> Giảm dần
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" /> Tăng dần
                    </label>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">Danh mục</div>
                <div class="card-body">
                    @foreach ($navBarCategories as $navBarCategoriesItem)
                        <label class="d-block" style="margin-bottom: 8px">
                            <a class="category-name active" aria-selected="true"
                                href="{{ url('/collections/' . $navBarCategoriesItem->slug) }}">{{ $navBarCategoriesItem->name }}</a>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-10">

            <div class="row g-0">

                @forelse ($products as $productItem)
                    <div class="col-md-3  col-6 ">
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
    </div>
</div>
