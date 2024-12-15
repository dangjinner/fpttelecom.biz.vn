@if(!empty($fptCategory))
    <div class="main_package" style="width: 100%;">
        <div class="box_package fpt_category_shortcode_slider">
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
@endif