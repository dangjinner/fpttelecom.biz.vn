@extends('public.layout')

@push('styles')
    <style>
        .cart-table th, .cart-table td {
            text-align: center;
            vertical-align: middle;
        }

        .cart-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .cart-table img {
            display: block;
            margin: 0 auto;
        }

        .cart_actions {
            display: flex;
            justify-content: space-between;
        }

        .cart_empty {
        }
    </style>
@endpush

@section('content')

    @if(!$cart->items()->isEmpty())
        <div class="cart_wrapper">
            <div class="container my-5">
                <div class="row">
                    <!-- Danh sách sản phẩm -->
                    <div class="col-lg-8">
                        <h4 class="mb-4">Giỏ hàng của bạn</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered cart-table">
                                <thead class="table-light">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart->items() as $cartItem)
                                    <tr class="cart_item" data-id="{{ $cartItem->id }}">
                                        <td><img src="{{ $cartItem->product->base_image->path }}" class="img-fluid"
                                                 alt="Product Image" style="width: 80px;"></td>
                                        <td>{{ $cartItem->product->name }}</td>
                                        <td>
                                            {{ $cartItem->product->selling_price->format() }}
                                        </td>
                                        <td>
                                            <input type="number" class="form-control cart_item_qty"
                                                   value="{{ $cartItem->qty }}" min="1" style="width: 70px;">
                                        </td>
                                        <td>{{ $cartItem->product->selling_price->multiply($cartItem->qty)->format() }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm btn-remove-item"
                                                    data-url="{{ route('cart.items.destroy', ['cartItemId' => $cartItem->id]) }}"
                                                    data-id="{{ $cartItem->id }}">Xóa
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Thêm nhiều sản phẩm tương tự tại đây -->
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_actions">
                            <a href="{{ route('home') }}" class="btn btn-secondary"> {{ "Quay lại trang chủ" }}</a>
                            <button class="btn btn-success btn-update-cart">Cập nhật giỏ hàng</button>
                        </div>
                    </div>

                    <!-- Tổng cộng và các mục khác -->
                    <div class="col-lg-4">
                        <h4 class="mb-4">Tổng cộng</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Tạm tính:</span>
                                    <span>{{ $cart->subTotal()->format() }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Tổng cộng:</span>
                                    <span><strong>{{ $cart->total()->format() }}</strong></span>
                                </div>
                                <button class="btn btn-primary w-100 mb-3">Đặt hàng</button>

                                <h5 class="mb-3">Thêm mã giảm giá</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                                    <button class="btn btn-outline-secondary">Áp dụng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="cart_empty">
            <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
                <div class="row justify-content-center w-100 px-3">
                    <div class="col-md-8 col-lg-6 text-center p-5 rounded shadow-lg" style="background-color: #f8f9fa;">
                        <!-- Icon SVG cho giỏ hàng trống -->
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-cart-x" style="color: #f0652b;" viewBox="0 0 16 16">
                                <path d="M5 1a1 1 0 0 0-1 1v.5H3A1.5 1.5 0 0 0 1.5 3a1.5 1.5 0 0 0-1.5 1.5 1.5 1.5 0 0 0 1.5 1.5h.5v7a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6h.5a1.5 1.5 0 0 0 1.5-1.5A1.5 1.5 0 0 0 14.5 3a1.5 1.5 0 0 0-1.5-1.5h-.5V2a1 1 0 0 0-1-1H5zM3 4h10v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4zm0 0" />
                            </svg>
                        </div>
                        <h2 class="mb-3 text-dark font-weight-bold" style="font-size: 2.5rem;">Giỏ hàng của bạn hiện đang trống</h2>
                        <p class="mb-4 text-muted" style="font-size: 1.2rem;">Không có sản phẩm nào trong giỏ. Hãy quay lại trang chủ để tiếp tục mua sắm!</p>
                        <a href="{{ route('home') }}" class="btn btn-md" style="background-color: #f0652b; color: white; font-weight: bold; padding: 12px 30px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                            Quay lại trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-update-cart').click(function (e) {
                e.preventDefault();
                const cartData = {};
                $('.cart_item').each(function () {
                    const cartItemId = $(this).data('id');
                    const qty = $(this).find('.cart_item_qty').val();
                    cartData[cartItemId] = qty;
                });

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: 'POST',
                    data: {
                        cart: cartData,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function () {
                        window.location.reload();
                    }
                })
            })

            $('.btn-remove-item').click(function (e) {
                e.preventDefault();
                const url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": 'DELETE'
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        })
    </script>
@endpush
