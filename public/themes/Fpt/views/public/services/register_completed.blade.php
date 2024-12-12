@extends('public.layout')

@push('styles')
    <style>
        .thank-you-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f68b1e, #ffebd6);
        }

        .thank-you-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            fill: #f68b1e; /* Màu cam của logo FPT */
        }

        h2 {
            color: #333;
            font-weight: bold;
        }

        p {
            color: #555;
            line-height: 1.3;
        }

        .btn-primary {
            background-color: #f68b1e;
            border: none;
        }

        .btn-primary:hover {
            background-color: #d9771a;
        }

        .title {
            font-size: 25px;
        }
    </style>
@endpush

@section('content')
    <div class="thank-you-container">
        <div class="thank-you-card">
            <div>
                <svg class="success-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.707 10.707l4.5-4.5a1 1 0 0 0-1.414-1.414L6 8.586 4.207 6.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0z"/>
                </svg>
            </div>
            <h2 class="title mb-3">Cảm ơn quý khách!</h2>
            <p style="font-size: 18px">Cảm ơn quý khách đã đăng ký dịch vụ của FPT Telecom. Chúng tôi sẽ liên hệ lại với quý khách ngay sau khi
                nhận được thông tin.</p>
            <a href="" class="btn btn-primary mt-3">Quay lại trang chủ</a>
        </div>
    </div>
@endsection