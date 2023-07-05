@extends('layouts.app')

@section('title', 'Thực phẩm xanh ACB')
@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">Đơn hàng của bạn</h4>
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
                                    @forelse ($orders as $item )
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->tracking_no }}</td>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->payment_mode }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $item->status_message }}</td>
                                            <td><a href="{{ url('orders/'.$item->id) }}" class="btn btn-primary btn-sm">Xem</a></td>
                                        </tr>
                                    @empty
                                        <tr colspan="7">Chưa có đơn đặt hàng</tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
