<div class="package_item">
    <div class="img"><img src="{{ $service->logo->path }}" alt=""></div>
    <div class="package_content">
        <div class="title">
            <h3>{{ $service->name }}</h3>
        </div>
        <div class="price">
                               <span class="tooltip-container"><span class="icon-info"
                                   >Chỉ từ <img src="{{ v(Theme::url('assets/img/icon/info-circle.svg')) }}" alt=""/></span>
                                    <small class="tooltip-text">
                                      Mức giá trên đã bao gồm VAT và có thể được thay đổi theo khu
                                      vực và thời điểm. Giá chưa bao gồm phí thuê thiết bị đầu cuối,
                                      phí thu tiền tận nhà và các dịch vụ gia tăng khác.
                                    </small>
                               </span>
            <p>{{ $service->price->format() }}<span>/ {{ $service->billing_cycle }}</span></p>
        </div>
        <div class="list_item">
            {!! $service->features !!}
        </div>
    </div>
    <div class="package_btn">
        <a class="text-primary btn_service_detail" href="{{ $service->url() }}">Xem chi tiết</a>
        <a href="{{ $service->registerUrl() }}" class="btn_dk" rel="nofollow">Đăng ký ngay</a>
    </div>
</div>
