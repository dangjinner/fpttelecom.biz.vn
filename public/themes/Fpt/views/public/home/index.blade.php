@extends('public.layout')

@section('content')
    <div class="main_banner">
        <div class="banner_slider">
            <ul class="slider_item">
                @foreach($banner->slides as $slide)
                    <li>
                        <a href="{{ $slide->call_to_action_url }}" @if($slide->open_in_new_window) target="_blank" @endif class="destop"><img src="{{ $slide->file->path }}"
                                                        alt="{{ $slide->caption_1 }}"></a>
                        <a href="{{ $slide->call_to_action_url }}" @if($slide->open_in_new_window) target="_blank" @endif class="mobile"><img src="{{ $slide->file->path }}" alt="{{ $slide->caption_1 }}"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="main_benefit">
        <div class="container">
            <div class="row benefit_bt">
                @foreach($features as $feature)
                    <div class="col-lg-3 col-md-6 col-12 box_benefit">
                        <div class="benefit_list">
                            <a href="{{ $feature['url'] }}">
                                <div class="img"><img src="{{ $feature['logo']->path }}" alt="{{ $feature['name'] }}"></div>
                                <div class="text">
                                    <span>{{ $feature['name'] }}</span>
                                    <p>{{ $feature['desc'] }}</p>
                                </div>
                                <div class="arrow">
                                    <img src="{{ v(Theme::url('assets/img/arrow-right-black.svg')) }}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if($service1)
        <div class="main_package">
            <div class="package_title">
                <h2>{{ $service1['category']->name }}</h2>
                <p>{!! $service1['category']->description !!} </p>
            </div>
            <div class="box_package silder_package">
                @foreach($service1['services'] as $service)
                    <div class="package_item">
                        <div class="img"><img src="{{ $service->logo->path }}" alt=""></div>
                        <div class="package_content">
                            <div class="title">
                                <h3>{{ $service->name }}</h3>
                            </div>
                            <div class="price">
                                <span class="icon-info">Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""></span>
                                <p>{{ $service->price->format() }}<span>/ {{ $service->billing_cycle }}</span></p>
                            </div>
                            <div class="list_item">
                              {!! $service->features !!}
                            </div>
                        </div>
                        <div class="package_btn">
                            <a href="{{ route('fpt.register.service', ['service' => $service->slug]) }}" class="btn_dk">Đăng ký ngay</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="main_internet">
        <div class="container">
            <div class="box_internet">
                <div class="slider_internet">
                    @foreach($internetPackagesSlider->slides as $slide)
                        <div class="internet_item">
                            <a href="{{ $slide->call_to_action_url }}">
                                <img src="{{ $slide->file->path }}" alt="{{ $slide->caption_1 }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="block-quangcao">
        <div class="box_quangcao">
            <div class="row">
                @if(isset($promotionSlider->slides[0]))
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="quangcao_right">
                            <a href="{{ $promotionSlider->slides[0]->call_to_action_url }}">
                                <img src="{{ $promotionSlider->slides[0]->file->path }}" alt="{{ $promotionSlider->slides[0]->caption_1 }}">
                            </a>
                        </div>
                    </div>
                @endif
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="quangcao_left">
                        @foreach($promotionSlider->slides as $pIndex => $pSlide)
                            @if($pIndex > 0)
                                <a href="{{ $pSlide->call_to_action_url }}"><img src="{{ $pSlide->file->path }}" alt="{{ $pSlide->caption_1 }}"></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_news">
        <div class="main_box-news">
            <div class="box_title">
                <h2>Tin tức</h2>
                <p>Thông cáo báo chí</p>
            </div>
            <div class="box_news">
                <div class="list_news">
                    @foreach($posts as $post)
                        <div class="news_item col-news">
                            <a href="{{ $post->url() }}">
                                <div class="img">
                                    <img src="{{ $post->logo->path }}" alt="{{ $post->name }}">
                                </div>
                                <div class="new_title">
                                    <h4>{{ $post->name }}</h4>
                                    <span>Xem thêm</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="new_btn">
                    <a href="#"> Xem tất cả <img src="{{ v(Theme::url('assets/img/icon/arrow-more.svg')) }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
@endsection
