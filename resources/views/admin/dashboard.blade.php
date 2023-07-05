@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <h2 class='alert alert-success'>{{ session('message') }}</h2>
            @endif


            <div class="row">
                <h4>Đơn hàng</h4>
                <div class="col-md-3">
                    <div class="card card-body border-left-warning mb-3">
                        <label>Tổng đơn đặt hàng</label>
                        <h1>{{ $totalOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border-left-success mb-3">
                        <label>Tổng đơn đặt hàng trong ngày </label>
                        <h1>{{ $todayOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border-left-primary mb-3" >
                        <label>Tổng đơn đặt hàng trong tháng</label>
                        <h1>{{ $thisMonthOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border-left-info mb-3">
                        <label>Tổng đơn đặt hàng trong năm</label>
                        <h1>{{ $thisYearOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                    </div>
                </div>
                
                <hr>
                <h4>Người dùng</h4>
                    <div class="col-md-3">
                        <div class="card card-body border-left-warning mb-3">
                            <label>Tổng người dùng </label>
                            <h1>{{ $totalAllUsers }}</h1>
                            <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body border-left-success mb-3">
                            <label>Tổng người dùng khách hàng </label>
                            <h1>{{ $totalUser }}</h1>
                            <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body border-left-primary mb-3">
                            <label>Tổng người dùng admin </label>
                            <h1>{{ $totalAdmin }}</h1>
                            <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                        </div>
                    </div>
                
                <hr>
                <h4>Hàng hoá</h4>
                <div class="col-md-3">
                    <div class="card card-body border-left-warning mb-3">
                        <label>Tổng danh mục </label>
                        <h1>{{ $totalCategories  }}</h1>
                        <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border-left-success mb-3">
                        <label>Tổng sản phẩm </label>
                        <h1>{{ $totalProducts }}</h1>
                        <a href="{{ url('admin/orders') }}" style="color:black">Xem</a>
                    </div>
                </div>
         
            </div>
        @endsection
