@extends('layouts.admin')

@section('title', 'Thực phẩm xanh ACB')
@section('content')

    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Chi tiết đơn hàng
                        <a href="{{ url('admin/orders') }}" class="btn btn-danger btn-sm float-end mx-1">Quay lại</a>
                        <a href="{{ url('admin/invoice/' . $order->id . '/generate') }}"
                            class="btn btn-primary btn-sm float-end  mx-1">In hoá đơn</a>
                        <a href="{{ url('admin/invoice/' . $order->id) }}" target="_blank"
                            class="btn btn-warning btn-sm float-end  mx-1">Xem hoá đơn</a>
                    </h3>

                </div>

                <div class="card-body">

                    <h4 style="color:#009900">
                        <i class="fa fa-shopping-cart"></i> Chi tiết đơn hàng

                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Thông tin đơn hàng</h5>
                            <hr>
                            <h6>Mã đơn hàng: {{ $order->id }}</h6>
                            <h6>Mã vận chuyển: {{ $order->tracking_no }}</h6>
                            <h6>Ngày đặt: {{ $order->created_at->format('d-m-y:i A') }}</h6>
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
                    <div class="col-md-3">
                        <form action="{{ url('admin/orders/' . $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label class="mb-2">Cập nhật trạng thái đơn hàng</label>
                            <div class="input-group">
                                <select name="order_status" class="form-select">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="Đang xử lý"
                                        {{ Request::get('status') == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="Đang vận chuyển"
                                        {{ Request::get('status') == 'Đã vận chuyển' ? 'selected' : '' }}>Đang vận chuyển
                                    </option>
                                    <option value="Đã giao hàng"
                                        {{ Request::get('status') == 'Đã giao hàng' ? 'selected' : '' }}>Đã giao hàng
                                    </option>
                                    <option value="Đã hoàn thành" {{ Request::get('status') == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành
                                    </option>
                                    <option value="Đã huỷ" {{ Request::get('status') == 'Đã huỷ' ? 'selected' : '' }}>
                                       Đã huỷ</option>
                                </select>

                                <button type="submit" class="btn text-white" style="background-color:#009900">Cập
                                    nhật</button>
                            </div>


                        </form>
                    </div>
                    <br>
                    <h5>Mặt hàng đã đặt</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
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
                                                style="width:70px;height:70px;border-radius:0%" alt="">
                                        </td>
                                        <td width="10%">{{ $orderItem->product->name }}</td>
                                        <td width="10%">{{ $orderItem->price }}</td>
                                        <td width="10%">{{ $orderItem->quantity }}</td>
                                        <td width="10%" class="fw-bold">
                                            {{ $orderItem->quantity * $orderItem->price }}đ
                                        </td>
                                    </tr>
                                    @php
                                        $totalPrice += $orderItem->quantity * $orderItem->price;
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
@endsection
