@extends('public.layout')

@section('content')
    <div class="order-success">

        <div class="container">
{{--            <div class="success-icon d-flex justify-content-center">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="#4CAF50">--}}
{{--                    <path d="M20.292 6.708a1 1 0 0 0-1.414-1.414l-9.585 9.585-4.29-4.29a1 1 0 0 0-1.414 1.414l5 5a1 1 0 0 0 1.414 0l10-10z"/>--}}
{{--                </svg>--}}
{{--            </div>--}}
            <h1 class="order-success-title">Cảm ơn quý khách đã đặt hàng!</h1>
            <p class="order-success-message">Đơn hàng của quý khách đã được xác nhận. Chúng tôi sẽ liên hệ để giao hàng trong thời gian sớm nhất.</p>

           <div class="row">
               <div class="col-lg-6 order-info">
                   <h2>Thông tin đơn hàng</h2>
                   <p><span class="highlight">Mã đơn hàng:</span> {{ $order->id }}</p>
                   <p><span class="highlight">Ngày đặt hàng:</span> {{ $order->created_at->format('d-m-Y H:i') }}</p>
                   <p><span class="highlight">Phương thức thanh toán:</span> {{ $order->payment_method }}</p>
               </div>

               <div class="col-lg-6 customer-info">
                   <h2>Thông tin khách hàng</h2>
                   <p><span class="highlight">Họ tên:</span> {{ $order->customer_full_name }}</p>
                   <p><span class="highlight">Email:</span> {{ $order->customer_email }}</p>
                   <p><span class="highlight">Số điện thoại:</span> {{ $order->customer_phone }}</p>
                   <p><span class="highlight">Địa chỉ:</span> {{ $order->billing_address_1 }}</p>
               </div>
           </div>

            <div class="product-list">
                <h2>Danh sách sản phẩm</h2>
                <div class="table-container">
                    <table>
                        <thead>
                        <tr>
                            <th>Ảnh sản phẩm</th>
                            <th class="product-title">Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->products as $orderItem)
                            <tr>
                                <td><img src="{{ $orderItem->product->base_image->path }}" alt="{{ $orderItem->product->name }}"></td>
                                <td class="product-name">{{ $orderItem->product->name }}</td>
                                <td>{{ $orderItem->qty }}</td>
                                <td>{{ $orderItem->unit_price->format() }}</td>
                                <td>{{ $orderItem->line_total->format() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="summary">
                <h2>Tổng kết</h2>
                <p><span class="highlight">Tạm tính:</span> {{ $order->sub_total->format() }}</p>
                @if ($order->discount->amount() > 0)
                    <p><span class="highlight">Mã giảm giá:</span> -{{ $order->discount->format() }}</p>
                @endif
                <p><span class="highlight">Tổng tiền:</span> {{ $order->total->format() }}</p>
            </div>

            <div class="thank-you-footer">
                <p>Chân thành cảm ơn quý khách đã tin tưởng và sử dụng dịch vụ của chúng tôi!</p>
            </div>
        </div>
    </div>

    <style>
        .order-success {
            font-family: Arial, sans-serif;
            padding: 80px 20px 20px;
            background-color: #f5f5f5;
            min-height: 100vh; /* Chiếm toàn bộ chiều cao màn hình */
        }

        .container {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 1200px; /* Giới hạn chiều rộng tối đa để giao diện không bị quá rộng trên màn hình lớn */
            margin-top: 40px;
        }

        h1 {
            font-size: 28px;
            color: #333;
            text-transform: capitalize;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }

        .highlight {
            font-weight: bold;
            color: #f76b00;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f76b00;
            color: #fff;
            font-size: 16px;
        }

        table td {
            font-size: 14px;
            text-align: center;
        }

        table td img {
            width: 80px;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
        }

        .product-title {
            width: 40%;
            min-width: 200px;
        }

        .product-name {
            white-space: normal;
            word-break: break-word;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 3.6em;
        }

        .summary {
            text-align: right;
            margin-top: 20px;
        }

        .thank-you-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #555;
        }

        .success-icon {
            margin-bottom: 20px;
        }

        .success-icon svg {
            display: inline-block;
        }

        .order-success-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .order-success-message {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            table th, table td {
                font-size: 14px;
                padding: 8px;
            }

            .product-name {
                max-width: 100px;
            }

            table td img {
                width: 50px;
            }
        }

        /* Điều chỉnh trên các màn hình lớn */
        @media (min-width: 1200px) {
            .container {
                padding: 40px;
            }

            table th, table td {
                padding: 12px;
            }
        }
    </style>

@endsection
