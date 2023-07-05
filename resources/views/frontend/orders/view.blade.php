@extends('layouts.app')

@section('title', 'Thực phẩm xanh ACB')
@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 style="color:#009900">
                            <i class="fa fa-shopping-cart" ></i> Chi tiết đơn hàng
                            <a href="{{  url('orders') }}" class="btn btn-danger btn-sm float-end">Quay lại</a>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Thông tin   đơn hàng</h5>
                                <hr>
                                <h6>Mã đơn hàng: {{ $order->id }}</h6>
                                <h6>Mã vận chuyển: {{ $order->tracking_no }}</h6>
                                <h6>Ngày đặt: {{ $order->created_at->format('d-m-y h:i A') }}</h6>
                                <h6>Hình thức thanh toán: {{ $order->payment_mode }}</h6>
                                <h6 class="border p-2 text-success">
                                    Tình trạng: <span class="text-uppercase">{{ $order->status_message }}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>Thông tin khách hàng</h6>
                                    <hr>
                                    <h6>Họ và tên: {{ $order->fullname }}</h6>
                                    <h6>Số điện thoại: {{ $order->phone }}</h6>
                                    <h6>Địa chỉ: {{ $order->address }}</h6>
                            </div>
                        </div>

                        <br>
                        <h5>Mặt hàng đã đặt</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã mặt hàng</th>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td width="10%">{{ $orderItem->id }}</td>
                                            <td width="10%">
                                                <img src="{{ asset($orderItem->product->productImages[0]->image) }}"
                                                    style="width: 50px; height: 50px" alt="">
                                            </td>
                                            <td width="10%">{{ $orderItem->product->name }}</td>
                                            <td width="10%">{{ $orderItem->price }}</td>
                                            <td width="10%">{{ $orderItem->quantity }}</td>
                                            <td width="10%" class="fw-bold">
                                                {{ $orderItem->quantity * $orderItem->price }}đ
                                            </td>
                                        </tr>
                                        @php
                                            $totalPrice += $orderItem->quantity * $orderItem->price
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Tổng tiền đơn hàng</td>
                                        <td colspan="1" class="fw-bold">{{ $totalPrice }}đ</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
