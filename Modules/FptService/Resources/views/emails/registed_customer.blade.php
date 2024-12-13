<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Đăng Ký Dịch Vụ - FPT Telecom</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header h1 {
            color: #333;
        }
        .email-content {
            line-height: 1.6;
            color: #555;
        }
        .email-content strong {
            color: #333;
        }
        .email-footer {
            text-align: center;
            margin-top: 30px;
        }
        .email-button {
            display: inline-block;
            background-color: #f68b1e;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .email-button:hover {
            background-color: #d9771a;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Thông Tin Đăng Ký Dịch Vụ FPT Telecom</h1>
    </div>
    <div class="email-content">
        <p>Xin chào FPT Telecom,</p>
        <p>Một khách hàng đã đăng ký dịch vụ với thông tin chi tiết như sau:</p>
        <p><strong>Họ và Tên:</strong> {{ $fptServiceCustomer->name }}</p>
        <p><strong>Địa Chỉ:</strong> {{ $fptServiceCustomer->address }}</p>
        <p><strong>Dịch Vụ Đăng Ký:</strong> {{ $fptServiceCustomer->service }}</p>
        <p><strong>Số Điện Thoại:</strong> {{ $fptServiceCustomer->phone_number }}</p>
        <p><strong>Ghi Chú:</strong> {{ $fptServiceCustomer->note ?? 'Không có' }}</p>
        <p><strong>Thời Gian Đăng Ký:</strong> {{ $fptServiceCustomer->created_at->format('H:i:s d/m/Y') }}</p>
    </div>
    <div class="email-footer">
        <p>Vui lòng kiểm tra và liên hệ lại với khách hàng để xác nhận thông tin.</p>
        <a href="{{ route('admin.fpt_service_customers.index') }}" class="email-button">Quản Lý Đăng Ký</a>
    </div>
</div>
</body>
</html>
