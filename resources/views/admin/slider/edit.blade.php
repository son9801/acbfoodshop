@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sửa ảnh thanh trượt
                        <a href="{{ url('admin/slider') }}" class="btn btn-primary text-white btn-sm float-end">Quay
                            lại</a>
                    </h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ url('admin/slider/' . $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="mb-3">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" value="{{ $slider->title }}" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" rows="4">{{ $slider->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Ảnh</label>
                                <input type="file" name="image" class="form-control" />
                                <img src="{{ asset("$slider->image") }}" width="100px"
                                    height="100px" />
                            </div>

                            <div class="mb-3">
                                <label class="mb-3">Trạng thái</label><br />
                                <input type="checkbox" name="status" {{ $slider->status == '1' ? 'checked' : '' }} />
                                <label>Hiện</label>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
