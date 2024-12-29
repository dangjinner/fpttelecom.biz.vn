@extends('public.layout')
@push('styles')
    <link rel="stylesheet" href="{{ v(Theme::url('assets/slick-1.8.1/slick/slick-theme.css')) }}"/>
    <link rel="stylesheet" href="{{ v(Theme::url('assets/slick-1.8.1/slick/slick.css')) }}"/>
    <link type="text/css" href="{{ v(Theme::url('assets/css/main.css')) }}" rel="stylesheet"/>
    <link type="text/css" href="{{ v(Theme::url('assets/css/category.css')) }}" rel="stylesheet"/>
    <style>
        .main_category {
            padding-top: 70px;
        }

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

        .main_category .category_banner img {
            border-radius: 0;
        }

        .main_category .producer .producer_box {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 1rem;
        }

        .main_category .producer .producer_item {
            margin: 0;
        }

        .main_category .producer .producer_item a {
            height: 50px;
        }

        .main_category .producer .producer_item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .main_category .tieuchi .custom_drop .producer_item {
            height: 50px;
        }

        .main_category .tieuchi .custom_drop .producer_item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .main_category .tieuchi .custom_tinhnang li a {
            text-transform: none;
        }

        .main_category .breadcrumbs {
            gap: 5px;
        }

        .category_content .box_news {
            position: sticky;
            top: 4rem;
        }

        .category_content .box_news .news_item .img {
            height: 56px;
        }

        .category_content .box_news .news_item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .category_content .box_news .news_item .text h2 {
            text-transform: uppercase;
            font-weight: 400;
        }

        .main_category .category_product .btn_read {
            width: fit-content;
        }

        .main_category .category_product .btn_read a {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin: 0;
            padding: 7px 35px;
        }

        .box_product .title h3 a {
            -webkit-line-clamp: 2;
        }

        .main_category .breadcrumbs {
            flex-wrap: wrap;
        }

        .main_category .filter-active img {
            border-color: var(--xanhnuocbien) !important;
            border-width: medium !important;
        }

        .main_category .filter-active {
            border-color: var(--xanhnuocbien) !important;
            border-width: medium !important;
        }

        .category_content .box_text p {
            padding-bottom: 0;
        }

        .main_category .need .box_need a {
            gap: 12px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 500px) {
            .main_category .category_product .box_collum .box_product .img img {
                margin: 0;
            }
        }

    </style>
@endpush
@section('content')
    <section class="main_category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col">
                    <div class="breadcrumbs">
                        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Trang chủ</a>
                        {{--                        <span class="divider">❯</span>--}}
                        {{--                        <a href="{{ route('product.index') }}">Sản phẩm</a>--}}
                        <span class="divider">❯</span>
                        {!! str_replace("»", '<span class="divider">❯</span>', $breadcrumb) !!}
                        <a href="{{ route('fpt.services.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                    </div>
                </div>
            </div>
            <div class="row ">
                @if ($category->slider)
                    <div class="col-lg-6 col-md-6 col-12 col slider_left">
                        <div class="category_banner custem_slider">
                            <ul>
                                @foreach ($category->slider->slides as $slide)
                                    <li>
                                        <a href="{{ $slide->call_to_action_url }}">
                                            <img src="{{ $slide->file->path }}" alt="{{ $slide->file->name }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if ($category->slider2)
                    <div class="col-lg-6 col-md-6 col-12 col slider-right">
                        <div class="category_banner custem_slider">
                            <ul>
                                @foreach ($category->slider2->slides as $slide)
                                    <li>
                                        <a href="{{ $slide->call_to_action_url }}">
                                            <img src="{{ $slide->file->path }}" alt="{{ $slide->file->name }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                @elseif($category->slider)
                    <div class="col-lg-6 col-md-6 col-12 col slider_left">
                        <div class="category_banner custem_slider">
                            <ul>
                                @foreach ($category->slider->slides as $slide)
                                    <li>
                                        <a href="{{ $slide->call_to_action_url }}">
                                            <img src="{{ $slide->file->path }}" alt="{{ $slide->file->name }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row-v2 producer">
                <div class="title" style="margin-bottom: 10px">
                    <h4>Hãng sản xuất</h4>
                </div>
                <div class="producer_box">
                    @foreach($brands as $brand)
                        @if($brand->logo->path)
                            <div class="producer_item">
                                <a href="#"
                                   class="filter-item {{ request('brand') == $brand->slug ? 'filter-active' : '' }}"
                                   data-filter_key="brand" data-filter_value="{{ $brand->slug }}">
                                    <img src="{{ $brand->logo->path }}" alt="{{ $brand->name }}"/>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            @if(count($category->children) > 0)
                <div class="row-v2 need">
                    <div class="title">
                        <h4>Chọn theo nhu cầu</h4>
                    </div>
                    <div class="box_need">
                        @foreach($category->children as $cateItem)
                            <div class="need_item">
                                <a href="#"
                                   class="filter-item {{ request('category') == $cateItem->slug ? 'filter-active' : '' }}"
                                   data-filter_key="category" data-filter_value="{{ $cateItem->slug }}">
                                    <span class="text_title">{{ $cateItem->name }}</span>
                                    <img src="{{ $cateItem->logo->path }}" alt="{{ $cateItem->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="row-v2 filter_tieuchi">
                <div class="title">
                    <h4>Chọn theo tiêu chí</h4>
                </div>
                <div class="tieuchi">
                    <div class="btn-group">
                        <button class=" custom_btn btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Hãng sản xuất @if(request('brand'))
                                <span class="text-danger font-weight-bold"> (1)</span>
                            @endif
                        </button>
                        <ul class="dropdown-menu box_btn " aria-labelledby="dropdownMenuButton">
                            <div class="custom_drop">
                                @foreach($brands as $brand)
                                    @if($brand->logo->path)
                                        <li><a href="#"
                                               class="filter-item {{ request('brand') == $brand->slug ? 'filter-active' : '' }}"
                                               data-filter_key="brand" data-filter_value="{{ $brand->slug }}">
                                                <div class="producer_item">
                                                    <img src="{{ $brand->logo->path }}" alt="{{ $brand->name }}">
                                                </div>
                                            </a></li>
                                    @endif
                                @endforeach
                            </div>
                        </ul>
                    </div>

                    <div class="btn-group">
                        <button class=" custom_btn btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Chọn theo nhu cầu @if(request('category'))
                                <span class="text-danger font-weight-bold"> (1)</span>
                            @endif
                        </button>
                        <ul class="dropdown-menu box_btn" aria-labelledby="dropdownMenuButton">
                            <div class="custom_drop custom_nhucau">
                                @foreach($category->children as $cateItem)
                                    <li>
                                        <div class="need_item">
                                            <a href=""
                                               class="filter-item {{ request('category') == $cateItem->slug ? 'filter-active' : '' }}"
                                               data-filter_key="category" data-filter_value="{{ $cateItem->slug }}">
                                                <span class="text_title">{{ $cateItem->name }}</span>
                                                <img src="{{ $cateItem->logo->path }}" alt="{{ $cateItem->name }}">
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </div>
                        </ul>
                    </div>

                    @foreach($attributes as $attribute)
                        <div class="btn-group">
                            <button class=" custom_btn btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $attribute->name }} @if(request($attribute->slug))
                                    <span class="text-danger font-weight-bold"> (1)</span>
                                @endif
                            </button>
                            <ul class="dropdown-menu box_btn " aria-labelledby="dropdownMenuButton">
                                <div class="custom_drop custom_tinhnang">
                                    @foreach($attribute->values as $valueItem)
                                        <li>
                                            <a href="#"
                                               class="filter-item @if(request($attribute->slug) == $valueItem->id) filter-active @endif"
                                               data-filter_key="{{ $attribute->slug }}"
                                               data-filter_value="{{ $valueItem->id }}">
                                                {{ $valueItem->value }}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                    @endforeach

                    <div class="btn-group">
                        <button class=" custom_btn btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Giá @if(request('fromPrice') || request('toPrice') || request('contactPrice'))
                                <span class="text-danger font-weight-bold"> (1)</span>
                            @endif
                        </button>
                        <ul class="dropdown-menu box_btn " aria-labelledby="dropdownMenuButton">
                            <div class="custom_drop custom_tinhnang gia">
                                <li><a href="#"
                                       class="filter-price @if(request('toPrice') == 500000) filter-active @endif"
                                       data-to="500000">Dưới 500K</a></li>
                                <li><a href="#"
                                       class="filter-price @if(request('fromPrice') == 500000 && request('toPrice') == 1000000) filter-active @endif"
                                       data-from="500000" data-to="1000000">500 - 1
                                        triệu</a></li>
                                <li><a href="#"
                                       class="filter-price @if(request('fromPrice') == 1000000 && request('toPrice') == 3000000) filter-active @endif"
                                       data-from="1000000" data-to="3000000">1 - 3
                                        triệu</a></li>
                                <li><a href="#"
                                       class="filter-price @if(request('fromPrice') == 3000000 && request('toPrice') == 5000000) filter-active @endif"
                                       data-from="3000000" data-to="5000000">3 - 5
                                        triệu</a></li>
                                <li><a href="#"
                                       class="filter-price @if(request('fromPrice') == 5000000 && request('toPrice') == 10000000) filter-active @endif"
                                       data-from="5000000" data-to="10000000">5 - 10
                                        triệu</a></li>
                                <li><a href="#"
                                       class="filter-price @if(request('fromPrice') == 10000000) filter-active @endif"
                                       data-from="10000000">Trên 10 triệu</a></li>
                                <li><a href="#"
                                       class="filter-contact-price @if(request('contactPrice') == 1) filter-active @endif"
                                       data-filter_key="contactPrice"
                                       data-filter_value="1">Giá liên hệ</a></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row-v2 main_sort">
                <div class="form_check">
                    <div class="title">
                        <h4>Sắp xếp theo</h4>
                    </div>
                    <div class="box_form">
                        <button class="filter-item @if(request('orderBy') == 'price-desc') filter-active @endif"
                                data-filter_key="orderBy" data-filter_value="price-desc"><i
                                    class="fas fa-sort-amount-down-alt"></i> Giá Cao - Thấp
                        </button>
                        <button class="filter-item @if(request('orderBy') == 'price') filter-active @endif"
                                data-filter_key="orderBy" data-filter_value="price"><i
                                    class="fas fa-sort-amount-up-alt"></i> Giá Thấp - Cao
                        </button>
                        <button class="filter-item @if(request('orderBy') == 'big-sale') filter-active @endif"
                                data-filter_key="orderBy" data-filter_value="big-sale"><i class="fas fa-percent"></i>
                            Khuyến Mãi Hot
                        </button>
                        <button class="filter-item @if(request('orderBy') == 'newest') filter-active @endif"
                                data-filter_key="orderBy" data-filter_value="newest"><i class="fa fa-calendar"></i>Mới
                            nhất
                        </button>
                        <button class="filter-item @if(request('orderBy') == 'hot-sale') filter-active @endif"
                                data-filter_key="orderBy" data-filter_value="hot-sale"><i
                                    class="fa fa-shopping-cart"></i> Bán chạy
                        </button>
                    </div>
                </div>
            </div>
            <div class="row-v2 category_product" id="productList">
                @forelse($products as $product)
                    <div class="box_collum">
                        @include('public.products.partials.item')
                    </div>
                @empty
                    <div class="alert alert-warning" style="padding: 2rem">
                        <p class="text-center text-danger font-italic">
                            Hiện tại chưa có sản phẩm phù hợp với yêu cầu của quý khách, vui lòng liên hệ với chúng tôi
                            qua Zalo hoặc Hotline để được hỗ trợ!
                        </p>
                    </div>
                @endforelse
            </div>

            @if(count($products) > 0 && $productsArr['current_page'] < $productsArr['last_page'])
                <div class="row-v2 category_product">
                    <div class="col-lg-12 col-12 ">
                        <div class="d-flex justify-content-center align-items-center" style="margin: 1rem">
                            <div class="btn_read" id="loadMoreProduct">
                                <a href=""><span>Tải thêm sản phẩm </span><i class="fas fa-angle-down"></i></a>
                            </div>
                            <div class="spinner-border text-primary" style="display: none" role="status"
                                 id="loadingProducts">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    <section class="category_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 col">
                    <div class="box_text">
                        {!! \Modules\AutoLink\Helpers\RenderAutoLink::handle($category->intro) !!}
                        @if(!$category->intro)
                            <p class="text-center ">
                                Hiện tại chưa có thông tin mô tả cho danh mục này!
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 col news">
                    <div class="box_news">
                        <div class="card-title"><i class="far fa-newspaper"></i> Tin sản phẩm</div>
                        @foreach($posts as $post)
                            <div class="news_item">
                                <a href="{{ route('fpt.services.category', ['slug' => $post->slug]) }}">
                                    <div class="img">
                                        <img src="{{ $post->logo->path}}" alt="{{ $post->name }}">
                                    </div>
                                    <div class="text"><h2>{{ $post->name }}</h2>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ v(Theme::url('assets/slick-1.8.1/slick/slick.min.js')) }}"></script>
    <script type="text/javascript" src="{{ v(Theme::url('assets/js/category.js')) }}"></script>
    <script>
        let currentPage = 1;
        $(document).ready(function () {
            $('#loadMoreProduct').click(function (e) {
                e.preventDefault()
                let url = "{{ route('fpt.products.ajaxCategory', ['slug' => $category->slug]) }}"
                const params = new URLSearchParams(window.location.search)
                params.set('page', ++currentPage)
                url = url + '?' + params;

                $('#loadingProducts').show()
                $(this).hide()
                $.ajax({
                    url,
                    type: 'GET',
                    success: function (res) {
                        const products = res.data

                        if (products.length === 0) {
                            $('#loadingProducts').hide()
                            return;
                        }

                        const productsHtml = []
                        products.map(product => {
                            productsHtml.push(
                                `
                             <div class="box_collum">
                                     <div class="box_product">
                                    <div class="img">
                                        <a href="${product.url}"><img loading="lazy" src="${product.base_image?.path}" alt="${product.name}"></a>
                                        <div class=" temp sphot ">
                                            <span>-${product.price_percent_convert}%</span>
                                        </div>
                                        ${
                                    product.frame_image.path ? ` <div class="product-img-frame">
                                            <a href="${product.url}">
                                                <img loading="lazy" src="${product.frame_image.path}" />
                                            </a>
                                        </div>` : ''
                                }
                                    </div>
                                    <div class="title">
                                        <h3>
                                            <a href="${product.url}">${product.name}</a>
                                        </h3>
                                    </div>
                                    <div class="price-wrapper">
                                        <div class="price">
                                        ${
                                    product.contact_for_price ?
                                        ` <p style="color: red">Giá liên hệ</p>` :
                                        product.has_special_price ?
                                            `
                                                <p>${product.selling_price.formatted}</p>
                                                <span class="sale">${product.price.formatted}</span>
                                                ` : `<p>${product.selling_price.formatted}</p>`
                                }
                                                            </div>
                                                            <div class="star-rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <div class="flash-sale-process">
                                                                <div class="text">Đã bán ${product.viewed}</div>
                                            <div class="icon_hot">
                                                <img loading="lazy"
                                                     src="{{ v(Theme::url("assets/img/icon/flash-sale.png")) }}" alt="sold">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="product-attribute">
                                        <i class="fas fa-gift"></i>
                                        <p>
                                            ${product.gift_note ?? 'Nhận quà tặng và ưu đãi hấp dẫn khi mua trực tuyến'}
                                        </p>
                                    </div>
                                </div>
                             </div>
                            `
                            )
                        })

                        $('#productList').append(productsHtml)

                        if (res.current_page < res.last_page) {
                            $('#loadMoreProduct').show()
                        }

                        $('#loadingProducts').hide()
                    }
                })
            })

            function getParams() {
                return new URLSearchParams(window.location.search)
            }

            function handleReload(params = null) {
                let url = window.location.pathname
                if (params)
                    url = url + '?' + params;
                window.location.replace(url)
            }

            //Handle filter

            $('.filter-item').click(function (e) {
                e.preventDefault()
                const key = $(this).data('filter_key')
                const value = $(this).data('filter_value')
                const params = getParams()
                params.set(key, value)
                handleReload(params)
            })

            $('.filter-price').click(function (e) {
                e.preventDefault()
                const from = $(this).data('from')
                const to = $(this).data('to')
                const params = getParams()

                if (params.has('fromPrice')) params.delete('fromPrice')
                if (params.has('toPrice')) params.delete('toPrice')
                if (params.has('contactPrice')) params.delete('contactPrice')

                if (from)
                    params.set('fromPrice', from)
                if (to)
                    params.set('toPrice', to)
                handleReload(params)
            })

            $('.filter-contact-price').click(function (e) {
                e.preventDefault()
                const params = getParams()
                const value = $(this).data('filter_value')
                if (params.has('fromPrice')) params.delete('fromPrice')
                if (params.has('toPrice')) params.delete('toPrice')
                params.set('contactPrice', value)
                handleReload(params)
            })
        })
    </script>
@endpush