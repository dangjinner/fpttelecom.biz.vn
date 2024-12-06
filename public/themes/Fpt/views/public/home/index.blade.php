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
    <div class="main_package">
        <div class="package_title">
            <h2>Gói đề xuất</h2>
            <p>Bao gồm gói giá khuyến mãi - Đáp ứng mọi nhu cầu cuộc sống cá nhân, gia đình</p>
        </div>
        <div class="box_package silder_package">
            <div class="package_item">
                <div class="img"><img src="{{ v(Theme::url('assets/img/table-price/combointernetcameran.jpg')) }}" alt=""></div>
                <div class="package_content">
                    <div class="title">
                        <h3>Combo Camera</h3>
                    </div>
                    <div class="price">
                        <span class="icon-info">Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""></span>
                        <p>192.000đ <span>/ tháng</span></p>
                    </div>
                    <div class="list_item">
                        <ul>
                            <li>Trang bị Modem Wi-Fi 6</li>
                            <li>Trang bị Camera IQ3S kèm gói lưu trữ Cloud 3 ngày</li>
                            <li>Tặng 1 thiết bị Access Point</li>
                            <li>Tiết kiệm tới 950.000đ so với mua lẻ</li>
                        </ul>
                    </div>
                </div>
                <div class="package_btn">
                    <a href="#" class="btn_dk">Đăng ký ngay</a>
                </div>
            </div>
            <div class="package_item">
                <div class="img"><img src="{{ v(Theme::url('assets/img/table-price/combointernetcameran.jpg')) }}" alt=""></div>
                <div class="package_content">
                    <div class="title">
                        <h3>Internet GIGA</h3>
                    </div>
                    <div class="price">
                        <span class="icon-info">Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""></span>
                        <p>185.000đ <span>/ tháng</span></p>
                    </div>
                    <div class="list_item">
                        <ul>
                            <li>Trang bị Modem Wi-Fi 6</li>
                            <li>Tốc độ Download/Upload 150 Mbps</li>
                            <li>Phù hợp cá nhân, hộ gia đình</li>
                        </ul>
                    </div>
                </div>
                <div class="package_btn">
                    <a href="#" class="btn_dk">Đăng ký ngay</a>
                </div>
            </div>
            <div class="package_item">
                <div class="img"><img src="{{ v(Theme::url('assets/img/table-price/combointernetcameran.jpg')) }}" alt=""></div>
                <div class="package_content">
                    <div class="title">
                        <h3>Combo Camera</h3>
                    </div>
                    <div class="price">
                        <span class="icon-info">Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""></span>
                        <p>192.000đ <span>/ tháng</span></p>
                    </div>
                    <div class="list_item">
                        <ul>
                            <li>Trang bị Modem Wi-Fi 6</li>
                            <li>Trang bị Camera IQ3S kèm gói lưu trữ Cloud 3 ngày</li>
                            <li>Tặng 1 thiết bị Access Point</li>
                            <li>Tiết kiệm tới 950.000đ so với mua lẻ</li>
                        </ul>
                    </div>
                </div>
                <div class="package_btn">
                    <a href="#" class="btn_dk">Đăng ký ngay</a>
                </div>
            </div>
            <div class="package_item">
                <div class="img"><img src="{{ v(Theme::url('assets/img/table-price/combointernetcameran.jpg')) }}" alt=""></div>
                <div class="package_content">
                    <div class="title">
                        <h3>Combo Camera</h3>
                    </div>
                    <div class="price">
                        <span class="icon-info">Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""></span>
                        <p>192.000đ <span>/ tháng</span></p>
                    </div>
                    <div class="list_item">
                        <ul>
                            <li>Trang bị Modem Wi-Fi 6</li>
                            <li>Trang bị Camera IQ3S kèm gói lưu trữ Cloud 3 ngày</li>
                            <li>Tặng 1 thiết bị Access Point</li>
                            <li>Tiết kiệm tới 950.000đ so với mua lẻ</li>
                        </ul>
                    </div>
                </div>
                <div class="package_btn">
                    <a href="#" class="btn_dk">Đăng ký ngay</a>
                </div>
            </div>
            <div class="package_item">
                <div class="img"><img src="{{ v(Theme::url('assets/img/table-price/combointernetcameran.jpg')) }}" alt=""></div>
                <div class="package_content">
                    <div class="title">
                        <h3>Combo Camera</h3>
                    </div>
                    <div class="price">
                        <span class="icon-info">Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""></span>
                        <p>192.000đ <span>/ tháng</span></p>
                    </div>
                    <div class="list_item">
                        <ul>
                            <li>Trang bị Modem Wi-Fi 6</li>
                            <li>Trang bị Camera IQ3S kèm gói lưu trữ Cloud 3 ngày</li>
                            <li>Tặng 1 thiết bị Access Point</li>
                            <li>Tiết kiệm tới 950.000đ so với mua lẻ</li>
                        </ul>
                    </div>
                </div>
                <div class="package_btn">
                    <a href="#" class="btn_dk">Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main_internet">
        <div class="container">
            <div class="box_internet">
                <div class="slider_internet">
                    <div class="internet_item">
                        <a href="#">
                            <img src="{{ v(Theme::url('assets/img/internet/product-link1.png')) }}" alt="">
                        </a>
                    </div>
                    <div class="internet_item">
                        <a href="#">
                            <img src="{{ v(Theme::url('assets/img/internet/product-link1.png')) }}" alt="">
                        </a>
                    </div>
                    <div class="internet_item">
                        <a href="#">
                            <img src="{{ v(Theme::url('assets/img/internet/product-link1.png')) }}" alt="">
                        </a>
                    </div>
                    <div class="internet_item">
                        <a href="#">
                            <img src="{{ v(Theme::url('assets/img/internet/product-link1.png')) }}" alt="">
                        </a>
                    </div>
                    <div class="internet_item">
                        <a href="#">
                            <img src="{{ v(Theme::url('assets/img/internet/product-link1.png')) }}" alt="">
                        </a>
                    </div>
                    <div class="internet_item">
                        <a href="#">
                            <img src="{{ v(Theme::url('assets/img/internet/product-link1.png')) }}" alt="">
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="block-quangcao">
        <div class="box_quangcao">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="quangcao_right">
                        <a href="#">
                            <img src="{{ v(Theme::url('assets/img/banner/fpt-wifi-6-ket-noi-sieu-vuot-troi.jpg')) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="quangcao_left">
                        <a href="#"><img src="{{ v(Theme::url('assets/img/banner/tiktok-fpt-live-qua-bay-ve-nha.jpg')) }}" alt=""></a>
                        <a href="#"><img src="{{ v(Theme::url('assets/img/banner/2_708x228_2.jpg')) }}" alt=""></a>
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
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                    <div class="news_item col-news">
                        <a href="#">
                            <div class="img">
                                <img src="{{ v(Theme::url('assets/img/news/news-1.png')) }}" alt="">
                            </div>
                            <div class="new_title">
                                <h4>Tham gia “Giới thiệu bạn bè” cùng FPT lan tỏa kết nối, nhận thưởng hấp dẫn</h4>
                                <span>Xem thêm</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="new_btn">
                    <a href="#"> Xem tất cả <img src="{{ v(Theme::url('assets/img/icon/arrow-more.svg')) }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
@endsection
