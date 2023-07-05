@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- thông báo thành công --}}
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            {{-- thông báo lỗi --}}
            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Sửa thông tin người dùng
                        <a href="{{ url('admin/users') }}" class="btn btn-primary btn-sm float-end text-white">Trở lại</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/users/' . $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Tên người dùng</label>
                                <input type="text" name="name" value="{{ $user->name }}"class="form-control" />
                            </div>

                            <div class="col-md-6  mb-3">
                                <label>Email</label>
                                <input type="text" name="email" readonly value="{{ $user->email }}"
                                    class="form-control" />
                            </div>
                            {{-- @if ($user->role_as == '1')
                                <div class="col-md-6  mb-3">
                                    <label>Mật khẩu</label>
                                    <input type="text" name="password" class="form-control" />
                                </div>
                            @endif --}}
                            {{-- <div class="col-md-6  mb-3">
                                <label>Email</label>
                                <input type="text" name="email" readonly value="{{ $user_details->phone }}"
                                    class="form-control" />
                            </div> --}}
                            <div class="col-md-6  mb-3">
                                <label>Chọn vai trò</label><br />
                                <select name="role_as" class="form-control">
                                    <option value="">Chọn vai trò</option>
                                    <option value="0" {{ $user->role_as == '0' ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ $user->role_as == '1' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
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
