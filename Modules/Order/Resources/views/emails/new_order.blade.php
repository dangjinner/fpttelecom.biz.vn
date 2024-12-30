<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo Đơn Hàng FPT Telecom</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #f76b00; /* FPT Telecom Orange */
            font-size: 28px;
        }
        .order-info {
            margin-bottom: 20px;
            border-bottom: 2px solid #f76b00;
            padding-bottom: 20px;
        }
        .order-info p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }
        .order-info strong {
            color: #f76b00;
        }
        .product-list table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .product-list th, .product-list td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .product-list th {
            background-color: #f76b00;
            color: #fff;
        }
        .product-list td {
            background-color: #f9f9f9;
        }
        .product-list tr:nth-child(even) td {
            background-color: #f1f1f1;
        }
        .product-list img {
            width: 100px; /* Điều chỉnh kích thước ảnh */
            height: auto;
            border-radius: 8px;
        }
        .summary {
            text-align: right;
            margin-top: 20px;
        }
        .summary p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }
        .summary strong {
            color: #f76b00;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }
        .footer a {
            color: #f76b00;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Thông Báo Đơn Hàng FPT Telecom</h1>

    <div class="order-info">
        <p><strong>Tên Khách Hàng:</strong> {{ $order->customer_full_name }}</p>
        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
        <p><strong>Số Điện Thoại:</strong> {{ $order->customer_phone }}</p>
        <p><strong>Địa Chỉ:</strong> {{ $order->billing_address_1 }}</p>
        <p><strong>Phương Thức Thanh Toán:</strong> {{ $order->payment_method }}</p>
        <p><strong>Ghi Chú:</strong> {{ $order->note }}</p>
        <p><strong>Ngày Đặt Hàng:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
    </div>

    <div class="product-list">
        <h2>Danh Sách Sản Phẩm</h2>
        <table>
            <thead>
            <tr>
                <th>Ảnh Sản Phẩm</th>
                <th>Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order->products as $orderItem)
                <tr>
                    <td><img src="{{ $orderItem->product->base_image->path }}" alt="Product Image"></td>
                    <td>{{ $orderItem->product->name }}</td>
                    <td>{{ $orderItem->qty }}</td>
                    <td>{{ $orderItem->unit_price->format() }}</td>
                    <td>{{ $orderItem->line_total->format() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="summary">
        <p><strong>Tạm Tính:</strong> {{ $order->sub_total->format() }}</p>
        @if($order->discount->amount() > 0)
            <p><strong>Mã Giảm Giá:</strong> -{{ $order->discount->format() }}</p>
        @endif
        <p><strong>Tổng Tiền:</strong> {{ $order->total->format() }}</p>
    </div>

    <div class="footer">
        <p>FPT Telecom - Giải pháp công nghệ cho cuộc sống hiện đại</p>
        <p><a href="{{ url('/') }}" target="_blank">{{ request()->getHost() }}</a></p>
    </div>
</div>
</body>
</html>
