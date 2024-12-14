@extends('public.layout')

@section('content')
    <div class="main_banner">
        <div class="page_banner">
            <img src="{{ $fptCategory->banner->path ?? $fptCategory->parent->banner->path }}" alt="banner">
        </div>
        <div class="page_banner-mb">
            <img src="{{ $fptCategory->banner->path ?? $fptCategory->parent->banner->path }}" alt="banner">
        </div>
    </div>
    <div class="breadcrumb_sv">
        <div class="list_service">
            <ul>
                @foreach($fptCategories as $category)
                    <li class="@if($category->id === $fptCategory->id) active @endif">
                        <a href="{{ route('fpt.services.category', ['slug' => $category->slug]) }}">
                            <img src="{{ $category->logo->path }}" alt="{{ $category->name }}">
                            <span>{{ $category->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="main_package" style="margin-bottom: 100px;">
        <div class="package_title">
           {!! $fptCategory->description !!}
        </div>
        <div class="box_package silder_package">
            @foreach($fptCategory->fptServices as $fptService)
                <div class="package_item">
                    <div class="img"><img src="{{ $fptService->logo->path }}" alt="{{ $fptService->name }}"></div>
                    <div class="package_content">
                        <div class="title">
                            <h3>{{ $fptService->name }}</h3>
                        </div>
                        <div class="price">
                            <span class="icon-info">Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""></span>
                            <p>{{ $fptService->price->format() }}<span>/ {{ $fptService->billing_cycle }}</span></p>
                        </div>
                        <div class="list_item">
                            {!! $fptService->features !!}
                        </div>
                    </div>
                    <div class="package_btn">
                        <a href="{{ $fptService->registerUrl() }}" class="btn_dk">Đăng ký ngay</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection