@extends('public.layout')
@section('content')
    <div class="main_banner">
        <div class="page_banner">
            @php
                $bannerPath = $fptCategory->banner->path;
                if (empty($bannerPath) && !empty($fptCategory->parent)) {
                    $bannerPath = $fptCategory->parent->banner->path;
                }
            @endphp
            <img src="{{ $bannerPath }}" alt="banner">
        </div>
        <div class="page_banner-mb">
            <img src="{{ $bannerPath }}" alt="banner">
        </div>
    </div>
    <section class="fpt_service_detail">
        <div class="container">
            <div class="service_title mb-5">
                <h2>{{ $fptService->name }}</h2>
                <div class="service_description">
                    {!! $fptService->description !!}
                </div>
            </div>
            <div class="row gap-3 service_features mb-4">
                <div class="col-lg-6 service_feature">
                    <h5>{{ $fptService->name }}</h5>
                    <div class="price-text">
                        <small class="small-text">Chỉ từ</small>
                        <span class="price-num">{{ $fptService->price->format() }}</span>
                        / tháng
                    </div>
                </div>
                <div class="col-lg-6 service_feature d-flex gap-3 align-items-center justify-content-center service_speed">
                    <div class="img_speed">
                        <img src="{{ v(Theme::url('assets/img/icon/speed150.png')) }}" alt="speed">
                    </div>
                    <div class="speed_info">
                        <h5>Tốc độ</h5>
                        <div class="d-flex align-items-center justify-content-center num-speed">
                            <div class="speed">{{ $fptService->speed ?? '...' }}</div>
                            <div>
                                <span>/Mbs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 d-flex justify-content-center">
                <a href="{{ $fptService->registerUrl() }}" class="btn btn-primary btn-lg">Đăng ký ngay</a>
            </div>
            @if($fptService->products->count() > 0)
                <div class="service_title mb-5">
                    <h2 class="mb-3">Nhận thêm trong gói này</h2>
                    <div class="row justify-content-center service_items">
                        @foreach($fptService->products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 service_item">
                                <a href="{{ $product->url() }}">
                                    <img src="{{ $product->base_image->path }}" alt="{{$product->name}}"/>
                                </a>
                                <div class="mt-3">
                                    <a href="{{ $product->url() }}">{{ $product->name }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="service_title mb-5">
                <h2>Đặc quyền</h2>
                <div class="service_description">
                    {!! $fptService->features !!}
                </div>
            </div>
            <div class="mb-5 d-flex justify-content-center">
                <a href="{{ $fptService->registerUrl() }}" class="btn btn-primary btn-lg">Đăng ký ngay</a>
            </div>
        </div>
    </section>
@endsection