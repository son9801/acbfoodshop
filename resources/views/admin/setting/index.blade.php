@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin">
            <form action="{{ url('/admin/settings') }}" method="POST">
                @csrf

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website</h3>
                    </div>

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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tên website</label>
                                <input type="text" name="website_name" value="{{ $setting->website_name ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>URL website</label>
                                <input type="text" name="website_url" value="{{ $setting->website_url ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Thông tin website</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" value="{{ $setting->address ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" value="{{ $setting->phone ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ $setting->email ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Mạng xã hội</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Facebook</label>
                                <input type="text" name="facebook" value="{{ $setting->facebook ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Youtube</label>
                                <input type="text" name="youtube"  value="{{ $setting->youtube ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary text-white">Lưu</button>
                </div>
            </form>
        </div>
    </div>

@endsection
