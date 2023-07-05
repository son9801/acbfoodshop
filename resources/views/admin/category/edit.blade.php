@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sửa danh mục
                        <a href="{{ url('admin/category') }}" class="btn btn-primary text-white btn-sm float-end">Quay
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
                    <form action="{{ url('admin/category/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Tên</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" />
                            </div>

                            <div class="col-md-12  mb-3">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Ảnh</label>
                                <input type="file" name="image" class="form-control" />
                                <img src="{{ asset($category->image) }}" width="50px" height="50px" />
                            </div>
                            <div class="col-md-6  mb-3">
                                <label class="mb-3">Trạng thái</label><br />
                                <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked' : '' }} />
                                <label>Hiện</label>
                            </div>
                            {{-- 
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>

                            <div class="col-md-12  mb-3">
                                <label>Meta title</label>
                                <input type="text" name="meta_title" value="{{ $category->meta_title }}"
                                    class="form-control" />
                                @error('meta_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12  mb-3">
                                <label>Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="3">{{ $category->meta_keyword }}</textarea>
                                @error('meta_keyword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ $category->meta_description }}</textarea>
                                @error('meta_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
