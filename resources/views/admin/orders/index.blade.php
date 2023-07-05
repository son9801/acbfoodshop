@extends('layouts.admin')

@section('title', 'Thực phẩm xanh ACB')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Đơn hàng </h3>

                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Từ ngày</label>
                                <input type="date" name="date1" value="{{ Request::get('date1') ?? date('Y-m-d') }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label>Đến ngày</label>
                                <input type="date" name="date2" value="{{ Request::get('date2') ?? date('Y-m-d') }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-3 ">
                                <label>Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="Đang xử lý"
                                        {{ Request::get('status') == 'Đang xử lý' ? 'selected' : '' }}>
                                        Đang xử lý</option>
                                    <option value="Đang vận chuyển"
                                        {{ Request::get('status') == 'Đang vận chuyển' ? 'selected' : '' }}>Đang vận
                                        chuyển
                                    </option>
                                    <option value="Đã giao hàng"
                                        {{ Request::get('status') == 'Đã giao hàng' ? 'selected' : '' }}>Đã giao hàng
                                    </option>
                                    <option value="Đã hoàn thành"
                                        {{ Request::get('status') == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành
                                    </option>
                                    <option value="Đã huỷ" {{ Request::get('status') == 'Đã huỷ' ? 'selected' : '' }}>
                                        Đã huỷ
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button type="submit" class="btn btn-primary text-white">Lọc</button>
                            </div>
                        </div>
                    </form>
                    <form action="" method="GET">
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label>Tìm kiếm</label>
                                <input type="text" name="order_id" value="{{ Request::get('order_id') }}"
                                  placeholder="Nhập mã đơn hàng muốn tìm..."  class="form-control">
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button type="submit" class="btn btn-primary text-white">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Mã đơn hàng</th>
                                <th>Mã vận đơn</th>
                                <th>Họ và tên</th>
                                <th>Hình thức thanh toán</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $item->status_message }}</td>
                                        <td><a href="{{ url('admin/orders/' . $item->id) }}"
                                                class="btn btn-primary btn-sm text-white">Xem</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr colspan="7">Chưa có đơn đặt hàng</tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
