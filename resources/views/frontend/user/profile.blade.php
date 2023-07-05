@extends('layouts.app')

@section('title', 'Thực phẩm xanh ACB')
@section('content')
    <div class="py-5">
        <div class="containter">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    @if ($errors->any())
                        <ul class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="card shadow">
                        <div class="card-header" style="background-color: #009900">
                            <h4 class="mb-0 text-white">Thông tin tài khoản</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('profile') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Họ và tên</label>
                                            <input type="text" name="username" value="{{ Auth::user()->name }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{ Auth::user()->userDetail->phone ?? ''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="text" name="email" readonly value="{{ Auth::user()->email }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Địa chỉ</label>
                                            <textarea name="address" placeholder="Nhập địa chỉ" cols="10" rows="2" class="form-control">{{ Auth::user()->userDetail->address ?? ''}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="float-end btn text-white" style="background-color:#009900">Lưu thông tin </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
