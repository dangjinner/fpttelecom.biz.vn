@extends('public.layout')

@section('title', trans('fpt::404.404'))

@push('styles')
    <style>
        .container {
            max-width: 600px;
            padding: 80px 20px;
        }
        .error-title {
            font-size: 100px;
            font-weight: bold;
            color: #f68b1e;
            margin: 0;
        }
        .error-subtitle {
            font-size: 24px;
            margin: 10px 0;
        }
        .error-description {
            font-size: 18px;
            margin: 20px 0;
        }
        .error-image {
            margin: 20px 0;
        }
        .error-image img {
            max-width: 100%;
            height: auto;
        }
        .error-actions {
            margin: 20px 0;
        }
        .error-actions a {
            text-decoration: none;
            background-color: #f68b1e;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .error-actions a:hover {
            background-color: #d9771a;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="error-title">404</div>
        <div class="error-subtitle">Không tìm thấy trang!</div>
        <div class="error-description">
            Xin lỗi, chúng tôi không thể tìm thấy trang mà bạn yêu cầu.<br>
            Vui lòng kiểm tra lại URL hoặc quay lại trang chủ.
        </div>
        <div class="error-actions">
            <a href="/">Quay Lại Trang Chủ</a>
        </div>
    </div>
@endsection