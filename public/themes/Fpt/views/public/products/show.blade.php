@extends('public.layout')
@push('styles')
    <link rel="stylesheet" href="{{ v(Theme::url('assets/slick-1.8.1/slick/slick-theme.css')) }}"/>
    <link rel="stylesheet" href="{{ v(Theme::url('assets/slick-1.8.1/slick/slick.css')) }}"/>
    <link type="text/css" href="{{ v(Theme::url('assets/css/main.css')) }}" rel="stylesheet"/>
    <link type="text/css" href="{{ v(Theme::url('assets/css/popup-lightbox.min.css')) }}" rel="stylesheet"/>
    <link type="text/css" href="{{ v(Theme::url('assets/css/product.css')) }}" rel="stylesheet"/>
    <style>
        .row-v2 {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }

        .row-v2 > * {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-top: var(--bs-gutter-y);
        }

        .box_product .img {
            max-height: fit-content;
            min-height: fit-content;
        }

        .product_detail .main_info .box_speci tr {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            color: #666;
            font-size: 14px;
            line-height: 18px;
            font-weight: 400;
        }

        .box_speci tr:nth-child(odd) {
            background: #e6e6e8;
        }

        .box_speci tr {
            height: auto !important;
        }

        .box_speci tr td {
            height: auto !important;
            vertical-align: center;
        }

        .box_speci tr td:nth-child(1) {
            padding: 6px 10px;
            min-width: 98px;
            width: 40% !important;
        }

        .box_speci tr td:nth-child(2) {
            padding: 6px 10px;
            width: 60% !important;
        }

        .box_speci tr td:nth-child(2) * {
            width: 100%;
        }

        .speci_content table {
            width: 100%;
        }

        .box_speci .box_popup .speci_content {
            overflow-y: auto;
        }

        .product-specifications table {
            height: auto !important;
        }

        .product_detail .product_variations .custom_content .box_btn-cart button {
            width: 100% !important;

        }

        .product_detail .product_variations .custom_content .box_btn-cart .bk-btn {
            width: 100% !important;
        }

        .product_detail .product_variations .custom_content .box_btn-cart .bk-btn .bk-btn-box {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .product_detail .product_variations .custom_content .box_btn-cart .bk-btn button span {
            text-transform: none;
            font-size: 14px;
            font-weight: 400;
            display: block;
            margin-top: 5px;
        }

        .product_detail .product_variations .custom_content .box_btn-cart .add_cart {
            width: 70px;
        }

        .product_detail .main_info .box_info-content {
            max-height: 600px;
            z-index: 0;
        }

        .speci_content.hidden_element {
            max-height: 500px;
            overflow-y: hidden;
        }

        .product_detail .main_info .box_speci {
            position: sticky;
            top: 5rem;
        }

        .custom_modal.show {
            z-index: 9999999999;
            opacity: 1 !important;
            background-color: #0000007d;
        }

        .modal-backdrop {
            z-index: 99;
        }

        .product_detail .product_variations .box_btn {
            gap: 5px;
        }

        .product_detail .product_variations .nav-tabs {
            row-gap: 5px;
        }

        .box_speci .modal.show .modal-dialog {
            min-width: 500px;
        }

        .btn-close-spec-modal {
            border: none;
            background: none;
            font-size: 18px;
        }

        .slider_nav .box_bottom {
            height: 120px;
        }

        .slider_nav .box_bottom img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .product_detail .product_img .box_img .box {
            overflow: hidden;
        }

        .product_detail .product_img .box_img .box img {

        }

        .custem_slider .slick-next {
            z-index: 99;
        }

        .box_product .title h3 a {
            -webkit-line-clamp: 2;
        }

        .product_detail .box_infor .box_item .title {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            background-color: var(--xanhnuocbien);
            font-size: 16px;
            font-weight: 700;
            color: #ffff;
            border-radius: 10px 10px 0 0;
            padding: 10px;
            margin-bottom: 0;
        }

        .product_detail .box_infor .infor_left .box_item .title {
            padding: 14px 10px;
        }

        .product_detail .box_infor .infor_right .box_item .title {
            color: #d70018;
            background-color: #fee2e2;
        }

        .product_detail .box_infor .box_item .title {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .product_detail .box_infor .box_item .title i {
            font-size: 20px;
        }

        .box_infor .infor_right ul {
            counter-reset: info_right_counter;
        }

        .box_infor .infor_right li:before {
            counter-increment: info_right_counter;
            content: counter(info_right_counter);
            background: var(--xanhnuocbien);
            color: white;
            border-radius: 50%;
            padding: 1px 5px;
            margin-right: 5px;
            font-size: 12px;
            width: 18px;
            height: 18px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-inline-flexbox;
            display: inline-flex;
        }

        .box_infor .infor_right li:before {
            background: #cf0438;
        }

        .box_infor .infor_right .title img {
            width: 50px;
        }

        .product_detail .box_infor .box_item {
            padding: 0;
        }

        .product_detail .box_infor .box_item .box_list_items {
            padding: 10px;
        }

        .custom_tab {
            position: sticky;
            top: 4rem;
        }

        .breadcrumbs {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
        }

        .product_img .product-thumbnail {
            position: relative;
        }

        .product_img .product-img-frame {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            width: 100%;
        }

        .product-slide-img {
            position: relative;
        }

        .product-slide-img-frame {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .product-slide-img-frame img {
            border: 0 !important;
        }

        #product-description table {
            border-collapse: collapse;
            text-align: center;
            vertical-align: middle;
        }

        #product-description td {
            border: 1px solid #c2c0c0;
            padding: 8px;
            vertical-align: middle;
        }

        #product-description tr {
            border: 1px solid #c2c0c0;
            padding: 8px;
            vertical-align: middle;
        }

        #product-description .card-title {
            color: #333;
            font-size: 16px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        #short-description > p {
            padding: 10px;
            counter-reset: section;
        }

        #short-description p {
            font-size: 14px;
            line-height: 31px;
        }

        .box_info-content .az-product-item .az-title-post {
            color: #444;
            font-size: 14px !important;
        }

        #brand-info-box {
            margin-bottom: 15px;
        }

        .brand-info {
            width: 100%;
            position: relative;
            background: #fff;
            padding: 15px;
            border-radius: 15px;
            -webkit-box-shadow: 0 1px 2px 0 rgba(190, 218, 240, 0.1019607843), 0 2px 6px 2px rgba(60, 64, 67, 0.1490196078);
            box-shadow: 0 1px 2px 0 rgba(190, 218, 240, 0.1019607843), 0 2px 6px 2px rgba(60, 64, 67, 0.1490196078);
            line-height: 1.5;
        }

        .product_detail {
            padding-top: 75px;
        }

        @media (max-width: 786px) {
            .product_detail .product_title h1 {
                line-height: 1;
                margin-bottom: 10px;
            }

            .product_detail .box_infor .infor_left {
                padding-right: 15px;
            }

            .product_detail .box_infor .infor_right {
                padding-left: 15px;
            }

            #myTabContent .product_title {
                margin-top: 1rem;
            }

            .product_detail .produtc_similar .custom_pdd {
                display: flex;
                row-gap: 12px
            }

            .slider_nav .box_bottom {
                height: 60px;
            }

            .product_detail .box_infor .box_item {
                max-height: none;
            }

            .breadcrumbs a:nth-child(n + 4) {
                display: none;
            }

            .breadcrumbs span:nth-child(n + 4) {
                display: none;
            }

            .product_detail .product_img {
                margin-bottom: 10px;
            }

        }

    </style>
@endpush
@section('content')
    <section class="product_detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col">
                    <div class="breadcrumbs">
                        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Trang chủ</a>
{{--                        <span class="divider">❯</span>--}}
{{--                        <a href="{{ route('product.index') }}">Sản phẩm</a>--}}
                        <span class="divider">❯</span>
                        {!! str_replace("»", '<span class="divider">❯</span>', $breadcrumb) !!}
                        <a href="{{ $product->url() }}">{{ $product->name }}</a>
                    </div>
                    <div class="product_title">
                        <h1 class="bk-product-name" id="product-name">{{ $product->name }}</h1>
                        <div class="star-rating">
                            <div class="box_star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="box_text">
                                <span>{{ $product->reviews->count() }}</span>
                                đánh giá
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12 col product_img">
                    <div class="box_img ">
                        <div class="slider_for custem_slider">
                            <div class="box product-thumbnail">
                                <img src="{{ $product->base_image->path }}" alt="{{ $product->name }}"
                                     class="bk-product-image">
                                @if($product->frame_image->path)
                                    <div class="product-img-frame">
                                        <img loading="lazy" src="{{ $product->frame_image->path }}"/>
                                    </div>
                                @endif
                            </div>
                            @foreach($product->additional_images as $image)
                                <div class="box">
                                    <img src="{{ $image->path }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="slider_nav custem_slider">
                            <div class="box_bottom product-slide-img">
                                <img src="{{ $product->base_image->path }}" alt="{{ $product->name }}">
                                @if($product->frame_image->path)
                                    <div class="product-slide-img-frame">
                                        <img loading="lazy" src="{{ $product->frame_image->path }}"/>
                                    </div>
                                @endif
                            </div>
                            @foreach($product->additional_images as $image)
                                <div class="box_bottom">
                                    <img src="{{ $image->path }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if($product->info_1 && $product->info_2)
                        <div class="row box_infor">
                            @if($product->info_1)
                                <div class="col-lg-6 col-md-6 col-6 col infor_left">
                                    <div class="box_item">
                                        <div class="title">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            <span>Thông tin sản phẩm</span>
                                        </div>
                                        <div class="box_list_items">
                                            {!! $product->info_1 !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($product->info_2)
                                <div class="col-lg-6 col-md-6 col-6 col infor_right">
                                    <div class="box_item">
                                        <div class="title">
                                            <i class="fas fa-list"></i>
                                            <span>Dịch vụ nổi bật</span>
                                            <img src="{{ v(Theme::url('assets/img/icon/hot-icon.png')) }}"
                                                 alt="super sale"/>
                                        </div>
                                        <div class="box_list_items">
                                            {!! $product->info_2 !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-5 col-md-5 col-12 col product_variations">
                    <div class="custom_tab">
                        @if(count($sameVersionProducts) > 0)
                            <div class="hinhthuc" id="hinhthuc">
                                <h4>Xem thêm các phiên bản khác tại đây:</h4>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <button class="nav-link btn_tai-nha custom_tab-item active btn-sv-product"
                                        data-product_ids="{{ json_encode(array_merge([$product->id], array_column($sameVersionProducts, 'id'))) }}"
                                        data-json="{{ Shortcode::strip(json_encode($product->toArray())) }}">
                                    <div class="box_btn">
                                        <div class="img">
                                            <img src="{{ $product->base_image->path }}"
                                                 alt="{{ $product->short_name }}">
                                        </div>
                                        <div class="text">
                                            <p class="font-weight-bold bk-product-property"
                                               style="margin-bottom: 5px;">{{ $product->short_name }}</p>
                                            @if($product->contact_for_price)
                                                <div class="price">Giá liên hệ</div>
                                            @else
                                                <div class="price">{{ $product->selling_price->format() }}</div>
                                            @endif
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </button>
                                @foreach($sameVersionProducts as $svProduct)
                                    <button class="nav-link  custom_tab-item btn-sv-product"
                                            data-product_ids="{{ json_encode(array_merge([$product->id], array_column($sameVersionProducts, 'id'))) }}"
                                            data-json="{{ Shortcode::strip(json_encode($svProduct)) }}">
                                        <div class="box_btn">
                                            <div class="img">
                                                <img src="{{ $svProduct['base_image']['path'] }}"
                                                     alt="{{ $svProduct['short_name'] }}">
                                            </div>
                                            <div class="text">
                                                <p class="font-weight-bold bk-product-property"
                                                   style="margin-bottom: 5px;">{{ $svProduct['short_name'] }}</p>
                                                @if($svProduct['contact_for_price'])
                                                    <div class="price">Giá liên hệ</div>
                                                @else
                                                    <div class="price">{{ $svProduct['selling_price']->format() }}</div>
                                                @endif
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </ul>
                        @endif

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane custom_content fade show active">
                                @if($product->banner_image->path)
                                    <div class="img" id="product-banner">
                                        <a href="{{$product->banner_link}}">
                                            <img src="{{ $product->banner_image->path }}" alt="banner">
                                        </a>
                                    </div>
                                @endif


                                @if($product->short_description)
                                    <div class="tab_content_item">
                                        <div class="title">
                                            <i class="fas fa-gift"></i>
                                            <h4>Khuyến mãi</h4>
                                        </div>
                                        <div id="short-description">
                                            {!! $product->short_description !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="price" id="product-price">
                                    @if($product->contact_for_price)
                                        <span class="bk-check-out-of-stock">Giá liên hệ</span>
                                    @elseif($product->hasSpecialPrice())
                                        <span class="price_sale">{{ $product->price->format() }}</span>
                                        <span class="bk-product-price">{{ $product->selling_price->format() }}</span>
                                    @else
                                        <span class="bk-product-price">{{ $product->selling_price->format() }}</span>
                                    @endif
                                </div>
                                <div class="box_btn-cart flex justify-content-between" style="gap: 10px">
                                    <form action="{{ route('cart.items.store') }}" method="POST" style="width: 100%">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                        <input type="hidden" name="qty" value="1" class="bk-product-qty"/>
                                        <button type="submit">
                                            <span>Mua ngay</span>
                                            <p class="text-white">Giao tận nơi, nhận tại cửa hàng</p>
                                        </button>
                                    </form>
                                    {{--                                    <div class='bk-btn'></div>--}}

                                    <a href="#" class="add_cart">
                                        <img src="{{ v(Theme::url('assets/img/icon/add-to-cart-icon.png')) }}" alt="">
                                        <span>Thêm vào giỏ</span>
                                    </a>
                                    <div class="spinner-border text-primary" style="display: none" role="status"
                                         id="loadingAddToCart">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <div class="btn_call">
                                    @php
                                        $hotlines = explode(',', setting('product_hotlines'));
                                    @endphp
                                    @foreach($hotlines as $hotline)
                                        <a href="tel:{{ $hotline }}">
                                            <span>{{ $hotline }}</span>
                                            <small>Tư vấn trực tuyến 24/7</small>
                                        </a>
                                    @endforeach

                                    {{--                                    <a class="hidden_destop devvn_tragop" href="">--}}
                                    {{--                                        <span>Mua trả góp</span>--}}
                                    {{--                                        <small>Duyệt online trong 4 giờ</small>--}}
                                    {{--                                    </a>--}}
                                    {{--                                    <a class="hidden_destop devvn_tragop-the" href="">--}}
                                    {{--                                        <span>Trả góp qua thẻ</span>--}}
                                    {{--                                        <small>Không cần xét duyệt</small>--}}
                                    {{--                                    </a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($product->info_1 && $product->info_2)
                    <div class="col-lg-12 col-md-12 col-12 hidden_destop ">
                        <div class="row box_infor">
                            @if($product->info_1)
                                <div class="col-12 col infor_left">
                                    <div class="box_item">
                                        <div class="title">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            <span>Thông tin sản phẩm</span>
                                        </div>
                                        <div class="box_list_items">
                                            {!! $product->info_1 !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($product->info_2)
                                <div class="col-12 col infor_right">
                                    <div class="box_item">
                                        <div class="title">
                                            <i class="fas fa-list"></i>
                                            <span>Dịch vụ nổi bật</span>
                                            <img src="{{ v(Theme::url('assets/img/icon/hot-icon.png')) }}"
                                                 alt="super sale"/>
                                        </div>
                                        <div class="box_list_items">
                                            {!! $product->info_2 !!}
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif

            </div>
            <div class="row-v2 produtc_similar">
                <ul class="nav nav-tabs custom_pdd" id="myTab" role="tablist">
                    <li class="nav-item tab-prods" data-tab="related">
                        <button class="nav-link active" id="sp_lienquan" data-bs-toggle="tab"
                                data-bs-target="#sp_lienquan-pane" type="button" role="tab"
                                aria-controls="sp_lienquan-pane"
                                aria-selected="true">Sản phẩm liên quan
                        </button>
                    </li>
                    <li class="nav-item tab-prods" data-tab="bundled">
                        <button class="nav-link" id="phukien-tab" data-bs-toggle="tab"
                                data-bs-target="#phukien-tab-pane" type="button" role="tab"
                                aria-controls="phukien-tab-pane"
                                aria-selected="false">Sản phẩm mua kèm
                        </button>
                    </li>
                    <li class="nav-item tab-prods" data-tab="viewed">
                        <button class="nav-link" id="viewed-tab" data-bs-toggle="tab"
                                data-bs-target="#viewed-tab-pane" type="button" role="tab"
                                aria-controls="viewed-tab-pane"
                                aria-selected="false">Sản phẩm đã xem
                        </button>
                    </li>
                    <li class="nav-item tab-prods" data-tab="brand">
                        <button class="nav-link" id="brand-tab" data-bs-toggle="tab"
                                data-bs-target="#brand-tab-pane" type="button" role="tab"
                                aria-controls="brand-tab-pane"
                                aria-selected="false">Thông tin hãng sản xuất
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="sp_lienquan-pane" role="tabpanel"
                         aria-labelledby="sp_lienquan" tabindex="0">
                        <div id="relatedProducts">
                            <div class="product_title">
                                <h3>Sản phẩm liên quan</h3>
                            </div>
                            <div class="row product_slider custem_slider">
                                @foreach($relatedProducts as $rProduct)
                                    <div class="" style="width: 100%; ">
                                        @include('public.products.partials.item', ['product' => $rProduct])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="phukien-tab-pane" role="tabpanel" aria-labelledby="phukien-tab"
                         tabindex="0">
                        <div id="bundledProducts">
                            <div class="product_title">
                                <h3>Sản phẩm mua kèm</h3>
                            </div>
                            <div class="product_slider custem_slider">
                                @foreach($product->crossSellProducts as $crossProduct)
                                    <div style="width: 100%; ">
                                        @include('public.products.partials.item', ['product' => $crossProduct])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="viewed-tab-pane" role="tabpanel" aria-labelledby="viewed-tab"
                         tabindex="0">
                        <div id="viewedProducts">
                            <div class="product_title">
                                <h3>Sản phẩm đã xem</h3>
                            </div>
                            <div class="product_slider custem_slider">
                                @foreach($productsRecentlyViewed as $rvProduct)
                                    <div style="width: 100%; ">
                                        @include('public.products.partials.item', ['product' => $rvProduct])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="brand-tab-pane" role="tabpanel" aria-labelledby="brand-tab"
                         tabindex="0">
                        <div id="brand-info-box">
                            <div class="product_title">
                                <h3>Thông tin hãng sản xuất</h3>
                            </div>
                            <div class="brand-info">
                                {!! $product->brand->description !!}
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row main_info">
                <div class="col-lg-8 col-md-12 col-12">
                    <div id="product-desc-main" class="box_info-content">
                        <div class="box_content-item" id="product-description">
                            <h2 class="card-title">Mô tả sản phẩm</h2>
                            <div id="sv-product-desc-{{$product->id}}" class="modify_content">
                                @if(!empty($product->description))
                                    {!! \Modules\AutoLink\Helpers\RenderAutoLink::handle($product->description, true) !!}
                                @endif
                            </div>
                            @foreach($sameVersionProducts as $svProduct)
                                <div id="sv-product-desc-{{$svProduct['id']}}" style="display: none">
                                    {!! $svProduct['description'] !!}
                                </div>
                            @endforeach
                        </div>
                        <div class="temner_readmore_des">
                            <button class="btn_readmore-info" title="Xem thêm">Đọc thêm <i
                                        class="fas fa-angle-down"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 product_speci">
                    <div class="box_speci ">
                        <h2 class="card-title">Thông số kỹ thuật</h2>
                        <div class="speci_content hidden_element product-specifications">
                            {!! $product->specifications !!}
                        </div>
                        <button class=" show_mobile hidden_destop btn_see-speci">
                            Xem thêm cấu hình chi tiết <i class="fas fa-angle-down"></i>
                        </button>
                        <button type="button" class="btn hidden_mobile btn-primary btn_see-speci" data-bs-toggle="modal"
                                data-bs-target="#specificationsModal">
                            Xem thêm cấu hình chi tiết <i class="fas fa-angle-down"></i>
                        </button>
                        <!-- Modal -->

                    </div>
                </div>
            </div>
{{--            <div class="row-v2" style="margin-top: 30px">--}}
{{--                @include('v2.sections.review.root-review', [--}}
{{--                               'type' => \Modules\Rating\Entities\Rating::TYPE_PRODUCT_ID,--}}
{{--                               'url' => '#',--}}
{{--                               'post_id' => $product->id--}}
{{--                           ])--}}
{{--            </div>--}}
{{--            <div class="row-v2" style="margin-top: 30px">--}}
{{--                @include('v2.sections.comment.root-comment', [--}}
{{--                               'type' => \Modules\Rating\Entities\Rating::TYPE_PRODUCT_ID,--}}
{{--                               'url' => '#',--}}
{{--                               'post_id' => $product->id--}}
{{--                           ])--}}
            </div>
        </div>
    </section>
    <div class="box_speci">
        <div class="modal custom_modal fade" id="specificationsModal" tabindex="-1"
             aria-labelledby="specificationsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close btn-close-spec-modal" data-bs-dismiss="modal"
                                aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body box_popup">
                        <h2 class="card-title">Thông số kỹ thuật</h2>
                        <div class="speci_content product-specifications">
                            {!! $product->specifications !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='bk-modal'></div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ v(Theme::url('assets/slick-1.8.1/slick/slick.min.js')) }}"></script>
    <script type="text/javascript" src="{{ v(Theme::url('assets/js/jquery.popup.lightbox.min.js')) }}"></script>
    <script type="text/javascript" src="{{ v(Theme::url('assets/js/product.js')) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let productId = {{ $product->id }}

        $(document).ready(function () {

            $('.tab-prods').click(function () {
                const tab = $(this).data('tab')
                $('.product_slider').slick('refresh')
            })

            $('.add_cart').click(function (e) {
                e.preventDefault()
                $(this).hide()
                $('#loadingAddToCart').show()
                $.ajax({
                    url: "{{ route('cart.items.store.ajax') }}",
                    type: 'POST',
                    data: {
                        _token: "{{csrf_token()}}",
                        product_id: productId,
                        qty: 1,
                    },
                    success: function (res) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Thêm sản phẩm vào giỏ hàng thành công!',
                            icon: 'success',
                            showCancelButton: true,
                            cancelButtonText: 'Tiếp tục mua',
                            showConfirmButton: true,
                            confirmButtonText: 'Đến trang giỏ hàng',
                            preConfirm: function () {
                                window.location.replace("{{ route('cart.index') }}")
                            }
                        });

                        $('.add_cart').show()
                        $('#loadingAddToCart').hide()
                    },
                    error: function (err) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Thêm sản phẩm vào giỏ hàng thất bại, vui lòng thử lại sau!',
                            icon: 'error'
                        });

                        $('.add_cart').show()
                        $('#loadingAddToCart').hide()
                    }
                })
            })

            $('.speci_content.hidden_element tr:nth-child(n + 9)').hide()

            $('.btn-sv-product').click(function () {
                const product = $(this).data('json')
                const productIds = $(this).data('product_ids')

                $('.box_img .slider_for .slick-list .slick-slide:first-child img:nth-child(1)').attr('src', product.base_image.path)
                $('.box_img .slider_nav .slick-list .slick-slide:first-child img:nth-child(1)').attr('src', product.base_image.path)
                if (product.frame_image.path) {
                    $('.box_img .product-img-frame img').attr('src', product.frame_image.path)
                    $('.box_img .product-slide-img-frame img').attr('src', product.frame_image.path)
                }
                for (const [key, value] of Object.entries(product.additional_images)) {
                    const newKey = Number.parseInt(key) + 1
                    $(`.box_img .slider_for .slick-list .slick-slide:nth-child(${newKey}) img`).attr('src', value.path)
                    $(`.box_img .slider_nav .slick-list .slick-slide:nth-child(${newKey}) img`).attr('src', value.path)
                }

                $('#product-name').text(product.name)

                $('#short-description').html(product.short_description);

                let priceHtml = '';
                if (product.contact_for_price) {
                    priceHtml = "<span class='bk-check-out-of-stock'>Giá liên hệ<span>"
                } else if (product.has_special_price) {
                    priceHtml = `
                        <span class="price_sale">${product.price.formatted}</span>
                        <span class="bk-product-price">${product.selling_price.formatted}</span>
                    `
                } else {
                    priceHtml = `
                        <span class="bk-product-price">${product.selling_price.formatted}</span>
                    `
                }
                $('#product-price').html(priceHtml)

                $(`#sv-product-desc-${product.id}`).show()

                const hideProductIds = productIds.filter((id) => id != product.id);
                for (const prodId of hideProductIds) {
                    $(`#sv-product-desc-${prodId}`).hide()
                }

                $('.product-specifications').html(product.specifications)

                if (product.banner_image.path)
                    $('#product-banner img').attr('src', product.banner_image.path)

                $('input[name=product_id]').val(product.id)
                productId = product.id

            })
        })
    </script>
{{--    @include('v2.sections.review.review-script', [--}}
{{--     'type' => \Modules\Rating\Entities\Rating::TYPE_PRODUCT_ID,--}}
{{--     'url' => '#',--}}
{{--     'post_id' => $product->id--}}
{{--    ])--}}
{{--    @include('v2.sections.comment.comment-script', [--}}
{{--    'type' => \Modules\Rating\Entities\Rating::TYPE_PRODUCT_ID,--}}
{{--    'url' => '#',--}}
{{--    'post_id' => $product->id--}}
{{--   ])--}}
@endpush