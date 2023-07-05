@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Thêm ảnh thanh trượt
                        <a href="{{ url('admin/slider') }}" class="btn btn-primary text-white btn-sm float-end">Quay
                            lại</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/slider ') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Tên</label>
                                <input type="text" name="title" class="form-control" />
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                

                            <div class="col-md-12  mb-3">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" rows="4s"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Ảnh</label>
                                <input type="file" name="image" class="form-control" />
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Trạng thái</label><br />
                                <input type="checkbox" name="status" />
                                <label>Hiện</label>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
