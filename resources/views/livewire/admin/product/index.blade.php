<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá sản phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyProduct">
                    <div class="modal-body">
                        <h6>Xác nhận xoá sản phẩm này? </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="Submit" data-bs-dismiss="modal" class="btn btn-primary">Đồng ý xoá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Sản phẩm
                        <a href="{{ url('admin/product/create') }}"
                            class="btn btn-primary btn-sm text-white float-end">Thêm sản
                            phẩm</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <form wire:submit.prevent="filter" class=" mb-3 form-group">
                                        <label>Danh mục</label>
                                        <select name="status" class="form-select" wire:model="categoryId">
                                            <option value="">Tất cả danh mục</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{-- {{ Request::get('category_id') ==  $category->name  ? 'selected' : '' }}> --}}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                 
                                </div>
                                {{-- <div class="col-md-2 mt-4">
                                    <button type="submit" class="btn btn-primary text-white">Lọc</button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="float-end w-50">
                                <div class="form-group">
                                    <label for="">Tìm kiếm theo tên</label>
                                    <input type="search" type="text" class="form-control" wire:model="searchTerm"
                                        placeholder="Nhập tên sản phẩm muốn tìm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Danh mục</th>
                                <th>Tên</th>
                                <th>Giá bán</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th>Bán chạy</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            Không có sản phẩm
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->status == '1' ? 'Hiện' : 'Ẩn' }}</td>
                                    <td>{{ $product->trending == '1' ? 'Có' : 'Không' }}</td>
                                    <td>
                                        <a href="{{ url('admin/product/' . $product->id . '/edit') }}"
                                            class="btn btn-success">Sửa</a>
                                        <a href="#" wire:click="deleteProduct({{ $product->id }})"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="btn btn-danger">Xoá</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Không có sản phẩm</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
