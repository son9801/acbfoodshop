<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá ảnh thanh trượt</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroySlider">
                    <div class="modal-body">
                        <h6>Bạn có chắc chắn muốn xoá ảnh thanh trượt này không? </h6>
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
                    <h4>Ảnh thanh trượt
                        <a href="{{ url('admin/slider/create') }}" class="btn btn-primary btn-sm float-end text-white">Thêm ảnh
                            thanh
                            trượt
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tìm kiếm</label>
                                <input type="search" type="text" class="form-control" wire:model="searchKey"
                                    placeholder="Nhập mã hoặc tên ảnh thanh trượt muốn tìm..">
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td><img src="{{ asset("$slider->image") }}"
                                            style="width:100px;height:100px;border-radius:0%" alt="Slider"></td>
                                    <td>{{ $slider->status == '1' ? 'Hiện' : 'Ẩn' }}</td>
                                    <td>
                                        <a href="{{ url('admin/slider/' . $slider->id . '/edit') }}"
                                            class="btn btn-success">Sửa</a>
                                        <a href="#" wire:click="deleteSlider({{ $slider->id }})"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="btn btn-danger">Xoá</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    <div>
                        {{ $sliders->links() }}
                    </div>

                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
