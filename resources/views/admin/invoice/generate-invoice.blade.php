<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family:Dejavu Sans!important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #009900;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">ACB FOOD</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span style="font-family:'Dejavu Sans'">Mã hoá đơn: #{{   $order->id}}</span> <br>
                    <span>Ngày: {{ date('d/m/Y') }}</span> <br>
                    <span>Mã zip : 560077</span> <br>
                    <span style="font-family:'Dejavu Sans'">Địa chỉ: Số 19, Ngõ 75 Phú Diễn, Quận Bắc Từ Liêm, TP.Hà Nội</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2" style="font-family:'Dejavu Sans'">Thông tin đơn hàng</th>
                <th width="50%" colspan="2">Thông tin khách hàng</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mã đơn hàng:</td>
                <td>{{ $order->id }}</td>

                <td>Họ và tên:</td>
                <td>{{ $order->fullname }}</td>
            </tr>
            <tr>
                <td>Mã vận đơn:</td>
                <td>{{ $order->tracking_no }}</td>

                <td>Số điện thoại:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Ngày đặt hàng:</td>
                <td>{{ $order->created_at->format('d-m-y h:i A') }}</td>

                <td rowspan="3">Địa chỉ:</td>
                <td rowspan="3">{{ $order->address }}</td>

            </tr>
            <tr >
                <td>Hình thức thanh toán:</td>
                <td >{{ $order->payment_mode }}</td>
        
             
            </tr>
            <tr>
                <td >Tình trạng đơn hàng:</td>
                <td>{{ $order->status_message }}</td>
              
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5" style="font-family:'Dejavu Sans'">
                    Sản phẩm đã đặt
                </th>
            </tr>
            <tr class="bg-blue"  >
                <th style="font-family:'Dejavu Sans'">Mã sản phẩm</th>
                <th>Tên</th>
                <th>Giá</th>
                <th style="font-family:'Dejavu Sans'">Số lượng</th>
                <th style="font-family:'Dejavu Sans'">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
            @endphp
            @foreach ($order->orderItems as $orderItem)
                <tr>
                    <td width="20%">{{ $orderItem->id }}</td>
                    <td width="20%">{{ $orderItem->product->name }}</td>
                    <td width="20%">{{ $orderItem->price }}</td>
                    <td width="20%">{{ $orderItem->quantity }}</td>
                    <td width="20%" class="fw-bold">
                        {{ $orderItem->quantity * $orderItem->price }}đ
                    </td>
                </tr>
                @php
                    $totalPrice += $orderItem->quantity * $orderItem->price;
                @endphp
            @endforeach
            <tr >
                <td style="font-family:'Dejavu Sans'" colspan="4" class="total-heading">Tổng tiền đơn hàng</td>
                <td  style="font-family:'Dejavu Sans'" colspan="1" class="total-heading">{{ $totalPrice }}đ</td>
            </tr> 
        </tbody>
    </table>

    <br>
    <p class="text-center" style="font-family:'Dejavu Sans'">
        Cảm ơn bạn đã mua hàng tại ACB Food
    </p>

</body>

</html>
