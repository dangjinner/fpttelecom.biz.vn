<?php

namespace Themes\Fpt\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Session;
use Modules\Cart\Http\Middleware\CheckCartStock;
use Modules\Cart\Http\Middleware\RedirectIfCartIsEmpty;
use Illuminate\Routing\Controller;
use Modules\Cart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Coupon\Checkers\MaximumSpend;
use Modules\Coupon\Checkers\MinimumSpend;
use Illuminate\Pipeline\Pipeline;
use Modules\Coupon\Exceptions\MaximumSpendException;
use Modules\Coupon\Exceptions\MinimumSpendException;
use Mail;
use Modules\Core\Entities\District;
use Modules\Order\Jobs\HandleNewOrderJob;
use Modules\Payment\Facades\Gateway;
use Modules\Province\Entities\Province;
use Themes\Fpt\Http\Services\OrderService;
use Themes\Fpt\Http\Requests\CheckoutRequest;

class CartController extends Controller
{
    private $checkers = [
        MinimumSpend::class,
        MaximumSpend::class,
    ];

    public function __construct() {
        $this->middleware([
            RedirectIfCartIsEmpty::class,
            CheckCartStock::class,
        ])->except('index', 'completed');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOMeta::setTitle('Giỏ hàng');
        $cart = Cart::instance();
        return view('public.cart.index', compact('cart'));
    }


    public function update(Request $request)
    {
        foreach ($request->cart as $cartItemId => $qty) {
            $this->updateItem($cartItemId, $qty);
        }
        return back();
    }

    private function updateItem($cartItemId, $qty)
    {

        Cart::updateQuantity($cartItemId, $qty);

        try {
            resolve(Pipeline::class)
                ->send(Cart::coupon())
                ->through($this->checkers)
                ->thenReturn();
        } catch (MinimumSpendException | MaximumSpendException $e) {
            Cart::removeCoupon();
        }
    }

    public function payment()
    {
        SEOMeta::setTitle('Thông tin thanh toán');
        $cart = Cart::instance();
        $gateways = Gateway::all();
        $provinces = Province::all();
        return view('public.cart.payment', compact('cart', 'gateways', 'provinces'));
    }

    public function getDistrict($provinceId)
    {
        return District::where('province_id', $provinceId)->get();
    }

    public function postCheckout(CheckoutRequest $request, OrderService $orderService)
    {
        $order = $orderService->create($request);
        Cart::clear();

        HandleNewOrderJob::dispatch($order);

        Session::put('order', $order);
        return redirect()->route('cart.completed');
    }

    public function completed()
    {
        SEOMeta::setTitle('Đặt hàng thành công');
        $order = Session::get('order');

        if (empty($order)) {
            return redirect()->route('home');
        }

        return view('public.cart.completed', compact('order'));
    }
}

