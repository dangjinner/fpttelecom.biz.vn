@extends('public.layout')

@push('styles')
    <style>
        .cart_total {
            font-weight: 700;
        }

        .order_content {
            padding: 40px 30px;
        }

        .order_content .card-body {
            padding: 10px 0;
        }

        .order_content h4 {
            color: #1e2f5b;
            margin: 0;
            font-size: 25px;
            font-style: normal;
            font-weight: 500;
            line-height: 35px;
        }

        .product-name {
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Hiển thị tối đa 2 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal; /* Nội dung sẽ xuống dòng khi cần */
            font-size: 1rem; /* Cỡ chữ */
            line-height: 1.2; /* Khoảng cách dòng */
            max-height: 2.4rem; /* Đảm bảo chiều cao khớp với 2 dòng */
        }

        .details-item {
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
        }

        .order_content h5 {
            font-size: 18px;
            font-weight: 600;
        }

        .btn-payment {
            color: #fff;
            text-align: center;
            cursor: pointer;
            background-color: #1e2f5b;
            border: 1px solid #1e2f5b;
            border-radius: 5px;
            min-height: 45px;
            padding: 10px 24px;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 140%;
            transition: all .3s;
            display: block;
            position: relative;
            top: 0;
            max-width: 100%;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="sec_step">
        <div class="container">
            <div class="box_steps">
                <ul class="list_steps">
                    <li class="step_item current">
            <span class="ico"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                   fill="none">
                <path
                        d="M9 16.5C13.125 16.5 16.5 13.125 16.5 9C16.5 4.875 13.125 1.5 9 1.5C4.875 1.5 1.5 4.875 1.5 9C1.5 13.125 4.875 16.5 9 16.5Z"
                        stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 6V9.75" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8.99609 12H9.00283" stroke="white" stroke-width="1.2" stroke-linecap="round"
                      stroke-linejoin="round"/>
              </svg></span>
                        <span class="text">
              Thông tin thanh toán
            </span>
                    </li>
                    <li class="step_item">
            <span class="ico">
              <svg xmlns:xlink="http://www.w3.org/1999/xlink" width="26" height="26" viewBox="0 0 1024 1024"
                   fill="#000000" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M824.8 1003.2H203.2c-12.8 0-25.6-2.4-37.6-7.2-11.2-4.8-21.6-12-30.4-20.8-8.8-8.8-16-19.2-20.8-30.4-4.8-12-7.2-24-7.2-37.6V260c0-12.8 2.4-25.6 7.2-37.6 4.8-11.2 12-21.6 20.8-30.4 8.8-8.8 19.2-16 30.4-20.8 12-4.8 24-7.2 37.6-7.2h94.4v48H203.2c-26.4 0-48 21.6-48 48v647.2c0 26.4 21.6 48 48 48h621.6c26.4 0 48-21.6 48-48V260c0-26.4-21.6-48-48-48H730.4v-48H824c12.8 0 25.6 2.4 37.6 7.2 11.2 4.8 21.6 12 30.4 20.8 8.8 8.8 16 19.2 20.8 30.4 4.8 12 7.2 24 7.2 37.6v647.2c0 12.8-2.4 25.6-7.2 37.6-4.8 11.2-12 21.6-20.8 30.4-8.8 8.8-19.2 16-30.4 20.8-11.2 4.8-24 7.2-36.8 7.2z"
                        fill=""/>
                <path
                        d="M752.8 308H274.4V152.8c0-32.8 26.4-60 60-60h61.6c22.4-44 67.2-72.8 117.6-72.8 50.4 0 95.2 28.8 117.6 72.8h61.6c32.8 0 60 26.4 60 60v155.2m-430.4-48h382.4V152.8c0-6.4-5.6-12-12-12H598.4l-5.6-16c-12-33.6-43.2-56-79.2-56s-67.2 22.4-79.2 56l-5.6 16H334.4c-6.4 0-12 5.6-12 12v107.2zM432.8 792c-6.4 0-12-2.4-16.8-7.2L252.8 621.6c-4.8-4.8-7.2-10.4-7.2-16.8s2.4-12 7.2-16.8c4.8-4.8 10.4-7.2 16.8-7.2s12 2.4 16.8 7.2L418.4 720c4 4 8.8 5.6 13.6 5.6s10.4-1.6 13.6-5.6l295.2-295.2c4.8-4.8 10.4-7.2 16.8-7.2s12 2.4 16.8 7.2c9.6 9.6 9.6 24 0 33.6L449.6 784.8c-4.8 4-11.2 7.2-16.8 7.2z"
                        fill=""/>
              </svg>
            </span>
                        <span class="text">
              Hoàn tất
            </span>
                    </li>
                </ul>
            </div>
            <form action="{{ route('cart.postCheckout') }}" method="POST" class="row">
                @csrf
                <div class="col-lg-7 col-md-7 col-12">
                    <div class="step_register">
                        <div class="box_register">
                            <div class="title">
                                <h3>Thông tin thanh toán</h3>
                            </div>
                        </div>
                        <div class="form_register">
                            <input type="hidden" name="service_slug" value="{{ request('service') }}"/>
                            <div class="form_title">
                                <h4>Thông tin cá nhân</h4>
                            </div>
                            <div class="box_form">
                                <div class="form_item">
                                    <label for="name" class="form-label">Họ tên *</label>
                                    <input type="text" name="name" placeholder="Nhập họ tên" maxlength="100"
                                           id="name"
                                           value="{{ old('name') }}"
                                           class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form_item">
                                    <label for="phone_number" class="form-label">Số điện thoại *</label>
                                    <input type="tel" name="phone_number" inputmode="numeric"
                                           placeholder="Nhập số điện thoại"
                                           id="phone_number"
                                           maxlength="10"
                                           value="{{ old('phone_number') }}"
                                           class="form-control @error('phone_number') is-invalid @enderror">
                                    @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="box_form">
                                <div class="form_item full_form">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="text" name="email" id="email"
                                           placeholder="Nhập email của bạn"
                                           value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="box_form">
                                <div class="form_item">
                                    <label for="provinces-select" class="form-label">Tỉnh/Thành phố *</label>
                                    <select name="province_id" id="provinces-select"
                                            class="@error('province_id') is-invalid @enderror">
                                        @forelse($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @empty
                                            <option>Lựa chọn</option>
                                        @endforelse
                                    </select>
                                    @error('province_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form_item">
                                    <label for="district-select" class="form-label">Quận/Huyện *</label>
                                    <select name="district_id" id="district-select"
                                            class="@error('district_id') is-invalid @enderror">
                                    </select>
                                    @error('district_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form_item">
                                    <label for="ward-select" class="form-label">Phường/Xã *</label>
                                    <select name="ward_id" id="ward-select"
                                            class="@error('ward_id') is-invalid @enderror">
                                    </select>
                                    @error('ward_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form_item">

                                </div>
                            </div>
                            <div class="radio-list">
                                <div class="box">
                                    <div class="nha_rieng open">
                                        <div class="box_form">
                                            <div class="form_item">
                                                <label for="home_address" class="form-label">Địa chỉ *</label>
                                                <input type="text" placeholder="Nhập số nhà, tên đường"
                                                       id="home_address"
                                                       name="address"
                                                       value="{{ old('address') }}"
                                                       maxlength="100"
                                                       class="form-control @error('home_address') is-invalid @enderror">
                                                @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box_form">
                                    <div class="form_item ghi_chu">
                                        <label for="note" class="form-label">Ghi chú</label>
                                        <input type="text" name="note" id="note"
                                               placeholder="NVD: Gọi cho tôi trước 30 phút"
                                               value="{{ old('note') }}"
                                               maxlength="100"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="submit">
                                <a href="" class="back"> Quay lại </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 col-md-5 col-5 box_order-info">
                    <div class="card order_content">
                        <h4 class="mb-0">Thông tin đơn hàng</h4>
                        <div class="card-body">
                            <ul class="list-group mb-4">
                                @foreach($cart->items() as $cartItem)
                                    <li class="list-group-item d-flex align-items-center p-3"
                                        style="background-color: #f9f9f9; border: 1px solid #e0e0e0;">
                                        <img src="{{ $cartItem->product->base_image->path }}" alt="Product Image"
                                             class="rounded shadow-sm"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                        <div class="ms-3 flex-grow-1">
                                            <span class="product-name">{{ $cartItem->product->name }}</span>
                                            <span class="text-muted"
                                                  style="font-size: 0.9rem;">Số lượng: x{{ $cartItem->qty }}</span>
                                        </div>
                                        <span class="text-dark"
                                              style="font-size: 1rem;">{{ $cartItem->total()->format() }}</span>
                                    </li>
                                @endforeach

                            </ul>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Tạm tính:</span>
                                <span>{{ $cart->subTotal()->format() }}</span>
                            </div>
                            <div class="cart_coupon">
                                @if($cart->hasCoupon())
                                    <div class="d-flex justify-content-between mb-3 ">
                                        <span class="coupon_code">Mã giảm giá:</span>
                                        <span class="coupon_value">{{ $cart->coupon()->value()->format() }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between mb-3 cart_total">
                                <span>Tổng cộng:</span>
                                <span class="cart_total_value">{{ $cart->total()->format() }}</span>
                            </div>

                            <h5 class="mb-3">Thêm mã giảm giá</h5>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="coupon_code"
                                       placeholder="Nhập mã giảm giá">
                                <button type="button" class="btn btn-outline-secondary btn-apply-coupon">Áp dụng</button>
                            </div>

                            <div class="payment-method mt-4">
                                <h5 class="mb-3">Phương thức thanh toán</h5>
                                @foreach($gateways as $key => $gateway)
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                               id="payment_{{$key}}" value="{{ $key }}" @if(old('payment_method') == $key) checked @endif required>
                                        <label class="form-check-label" for="payment_{{$key}}">
                                            {{ $gateway->label }}
                                        </label>
                                    </div>
                                @endforeach

                                <div id="payment-details" class="mt-3">
                                    @foreach($gateways as $key => $gateway)
                                        <div id="details_{{$key}}" class="details-item" @if(old('payment_method') != $key) style="display: none;" @endif >
                                            <h6 class="fw-bold mb-2">Hướng dẫn:</h6>
                                            <p class="mb-2">{!! $gateway->description !!}</p>
                                            @if(!empty($gateway->instructions))
                                                {!! $gateway->instructions !!}
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn-payment">Hoàn tất</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="featured">
                    <ul>
                        <li>
              <span class="f-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="none" viewBox="0 0 37 37">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M16.191 4.139 8.817 6.917c-1.7.635-3.088 2.645-3.088 4.448v10.98c0 1.744 1.152 4.034 2.556 5.083l6.354 4.744c2.084 1.566 5.513 1.566 7.596 0l6.355-4.744c1.404-1.049 2.556-3.34 2.556-5.083v-10.98c0-1.818-1.389-3.828-3.088-4.463l-7.374-2.763c-1.257-.459-3.266-.459-4.493 0Z">
                  </path>
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="m14.063 18.385 2.379 2.38 6.354-6.355"></path>
                </svg></span>
                            <span class="f-text">An toàn &amp; bảo mật</span>
                        </li>
                        <li class="seperate"></li>
                        <li><span class="f-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="37" fill="none" viewBox="0 0 36 37">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                        stroke-width="1.5"
                        d="M32.95 9.71v3.576c0 2.335-1.477 3.813-3.812 3.813h-5.054V6.769c0-1.64 1.345-2.97 2.985-2.97a5.941 5.941 0 0 1 4.153 1.729A5.948 5.948 0 0 1 32.95 9.71Z">
                  </path>
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                        stroke-width="1.5"
                        d="M3.395 11.188v20.689c0 1.226 1.389 1.92 2.364 1.182l2.527-1.892a1.489 1.489 0 0 1 1.95.148l2.454 2.468a1.49 1.49 0 0 0 2.098 0l2.483-2.483a1.465 1.465 0 0 1 1.921-.133l2.527 1.892c.975.724 2.364.03 2.364-1.182V6.754A2.964 2.964 0 0 1 27.04 3.8H9.306c-4.434 0-5.911 2.645-5.911 5.91v1.479Z">
                  </path>
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M13.74 20.07h4.434m-4.434-5.912h4.434"></path>
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.299 20.055h.013m-.013-5.91h.013"></path>
                </svg></span><span class="f-text">Thanh toán dễ dàng</span></li>
                        <li class="seperate"></li>
                        <li><span class="f-icon"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="37"
                                                      fill="none"
                                                      viewBox="0 0 36 37">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="m6.084 22.508-2.246-2.246a2.373 2.373 0 0 1 0-3.34l2.246-2.247c.384-.384.694-1.138.694-1.67V9.829c0-1.3 1.064-2.364 2.365-2.364h3.177c.532 0 1.286-.31 1.67-.695l2.246-2.246a2.373 2.373 0 0 1 3.34 0l2.246 2.246c.384.385 1.138.695 1.67.695h3.177c1.3 0 2.365 1.064 2.365 2.364v3.178c0 .531.31 1.285.694 1.67l2.246 2.246a2.373 2.373 0 0 1 0 3.34l-2.246 2.246c-.384.384-.694 1.138-.694 1.67v3.177c0 1.3-1.064 2.364-2.365 2.364h-3.177c-.532 0-1.286.31-1.67.695l-2.246 2.246a2.372 2.372 0 0 1-3.34 0l-2.246-2.246c-.384-.384-1.138-.695-1.67-.695H9.143a2.372 2.372 0 0 1-2.365-2.364v-3.177c0-.547-.31-1.3-.694-1.67Zm7.406.503 8.867-8.866">
                  </path>
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21.61 22.272h.013m-7.402-7.389h.013"></path>
                </svg></span><span class="f-text">Nhiều ưu đãi hấp dẫn</span></li>
                        <li class="seperate"></li>
                        <li><span class="f-icon"><svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                                      fill="none"
                                                      viewBox="0 0 37 37">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M29.017 14.143c0 2.143-.635 4.108-1.729 5.749-1.596 2.364-4.123 4.034-7.064 4.463a8.909 8.909 0 0 1-1.551.133 8.91 8.91 0 0 1-1.552-.133c-2.94-.429-5.468-2.099-7.064-4.463a10.297 10.297 0 0 1-1.729-5.749A10.337 10.337 0 0 1 18.673 3.8a10.337 10.337 0 0 1 10.344 10.344Z">
                  </path>
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="m32.343 28.137-2.439.577a1.45 1.45 0 0 0-1.093 1.093l-.517 2.173c-.281 1.182-1.788 1.537-2.572.606l-7.049-8.099-7.049 8.113c-.783.931-2.29.577-2.57-.606l-.518-2.172a1.472 1.472 0 0 0-1.094-1.093l-2.438-.577c-1.123-.266-1.522-1.67-.71-2.482l5.764-5.764c1.596 2.365 4.123 4.035 7.064 4.463.502.089 1.02.133 1.551.133a8.92 8.92 0 0 0 1.552-.133c2.94-.428 5.468-2.098 7.064-4.463l5.763 5.764c.813.798.414 2.201-.71 2.467ZM19.53 9.68l.872 1.744c.119.236.429.473.71.517l1.58.266c1.006.163 1.242.901.518 1.626l-1.226 1.226c-.207.207-.326.606-.252.902l.355 1.522c.28 1.197-.355 1.67-1.419 1.034l-1.477-.872c-.266-.162-.71-.162-.976 0l-1.477.872c-1.064.62-1.7.163-1.42-1.034l.356-1.522c.059-.281-.045-.695-.252-.902l-1.226-1.226c-.724-.725-.488-1.449.517-1.626l1.581-.266c.266-.044.576-.28.695-.517l.872-1.744c.428-.946 1.197-.946 1.67 0Z">
                  </path>
                </svg></span><span class="f-text">Bảo hành chính hãng</span></li>
                        <li class="seperate"></li>
                        <li><span class="f-icon"><svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                                      fill="none"
                                                      viewBox="0 0 37 37">
                  <path stroke="currentColor" stroke-miterlimit="10" stroke-width="1.5"
                        d="M33.156 27.93c0 .533-.118 1.08-.37 1.612a6.096 6.096 0 0 1-1.005 1.507c-.724.798-1.522 1.374-2.423 1.744a7.42 7.42 0 0 1-2.882.561c-1.507 0-3.118-.354-4.817-1.078-1.7-.725-3.4-1.7-5.084-2.926a42.48 42.48 0 0 1-4.847-4.138 41.988 41.988 0 0 1-4.123-4.832c-1.212-1.685-2.187-3.37-2.896-5.04-.71-1.684-1.064-3.295-1.064-4.832 0-1.005.177-1.965.532-2.852.354-.902.916-1.73 1.699-2.468.946-.931 1.98-1.39 3.074-1.39.414 0 .827.09 1.197.267.384.177.724.443.99.827l3.428 4.833c.266.37.458.71.591 1.034.133.31.207.62.207.902 0 .354-.103.709-.31 1.049a5.05 5.05 0 0 1-.828 1.05l-1.123 1.167a.791.791 0 0 0-.236.59c0 .119.015.222.044.34.044.119.089.207.118.296.266.488.724 1.123 1.375 1.892a50.529 50.529 0 0 0 2.143 2.334 44.47 44.47 0 0 0 2.35 2.173c.768.65 1.403 1.093 1.905 1.36.074.029.163.073.267.118.118.044.236.059.369.059a.813.813 0 0 0 .606-.252l1.123-1.108c.37-.37.724-.65 1.064-.827.34-.207.68-.31 1.05-.31.28 0 .575.058.9.191.326.133.666.325 1.035.577l4.891 3.473c.385.266.65.576.813.945.148.37.237.74.237 1.153Z">
                  </path>
                </svg></span>
                            <span class="f-text">Hỗ trợ 24/7</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let provinceId = 0;
        let districtId = 0;

        $(document).ready(function () {
            $('#provinces-select').select2({
                placeholder: 'Lựa chọn tỉnh/thành phố'
            });

            $('#district-select').select2({
                placeholder: 'Lựa chọn quận/huyện'
            });

            $('#ward-select').select2({
                placeholder: 'Lựa chọn xã/phường'
            });

            const $propertyType = $('input[name=property_type]:checked');
            if ($propertyType.val() == 2) {
                $('.chung_cu').addClass('open');
                $('.nha_rieng').removeClass('open');
            }

            const $provinceSelect = $('#provinces-select');
            fetchDistricts($provinceSelect.val());

            $('#provinces-select').change(function (e) {
                e.preventDefault();
                provinceId = $(this).val();
                fetchDistricts(provinceId);
            });

            $('#district-select').change(function () {
                districtId = $(this).val();
                fetchWards(districtId);
            });

            $('input[name="payment_method"]').on('change', function () {
                // Ẩn tất cả chi tiết
                $('.details-item').hide();
                // Hiển thị chi tiết phù hợp với phương thức được chọn
                const selectedMethod = $(this).val();
                $(`#details_${selectedMethod}`).fadeIn();
            });
        })

        function fetchDistricts(provinceId) {
            $.ajax({
                url: `/provinces/${provinceId}/districts`,
                type: 'GET',
                success: function (data) {
                    $('#district-select').children().remove();

                    data.forEach(district => {
                        $('#district-select').append(`
                            <option value="${district.id}">${district.name}</option>
                        `)
                    });

                    if (data.length > 0) {
                        fetchWards(data[0].id);
                    }
                }
            })
        }

        function fetchWards(districtId) {
            $.ajax({
                url: `/provinces/${provinceId}/districts/${districtId}/wards`,
                type: 'GET',
                success: function (data) {
                    $('#ward-select').children().remove();

                    data.forEach(ward => {
                        $('#ward-select').append(`
                            <option value="${ward.id}">${ward.name}</option>
                        `)
                    })
                }
            })
        }
    </script>
@endpush