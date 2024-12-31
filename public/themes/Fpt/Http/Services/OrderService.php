<?php

namespace Themes\Fpt\Http\Services;

use HoangPhi\VietnamMap\Models\Ward;
use Modules\Cart\Facades\Cart;
use Modules\Core\Entities\District;
use Modules\Order\Entities\Order;
use Modules\FlashSale\Entities\FlashSale;
use Modules\Currency\Entities\CurrencyRate;
use Modules\Province\Entities\Province;

class OrderService
{
    public function create($request)
    {
        return tap($this->store($request), function ($order) {
            $this->storeOrderProducts($order);
            $this->storeFlashSaleProductOrders($order);
            $this->incrementCouponUsage($order);
            $this->attachTaxes($order);
            $this->reduceStock();
        });
    }

    private function store($request)
    {
        $name = $this->extractName($request->name);
        return Order::create([
            'customer_id' => auth()->id(),
            'customer_email' => $request->email,
            'customer_phone' => $request->phone_number,
            'customer_first_name' => $name[0],
            'customer_last_name' => $name[1],
            'billing_address_1' => $this->getAddress($request),
            'sub_total' => Cart::subTotal()->amount(),
            'shipping_method' => Cart::shippingMethod()->name(),
            'shipping_cost' => Cart::shippingCost()->amount(),
            'coupon_id' => Cart::coupon()->id(),
            'discount' => Cart::discount()->amount(),
            'total' => Cart::total()->amount(),
            'payment_method' => $request->payment_method,
            'currency' => currency(),
            'currency_rate' => CurrencyRate::for(currency()),
            'locale' => locale(),
            'status' => Order::PENDING_PAYMENT,
            'note' => $request->note ?? ''
        ]);
    }

    private function getAddress($request)
    {
        $province = Province::find($request->province_id)->name ?? '';
        $district = District::find($request->district_id)->name ?? '';
        $ward = Ward::find($request->ward_id)->name ?? '';
        $address = $request->address;

        return "{$address}, {$ward}, {$district}, {$province}";
    }

    private function extractName($name)
    {
        return explode(' ', $name, 2);
    }

    private function storeOrderProducts(Order $order)
    {
        Cart::items()->each(function ($cartItem) use ($order) {
            $order->storeProducts($cartItem);
        });
    }

    private function storeFlashSaleProductOrders(Order $order)
    {
        Cart::items()->each(function ($cartItem) use ($order) {
            if (! FlashSale::contains($cartItem->product)) {
                return;
            }

            FlashSale::pivot($cartItem->product)
                ->orders()
                ->attach([
                    $cartItem->product->id => [
                        'order_id' => $order->id,
                        'qty' => $cartItem->qty,
                    ],
                ]);
        });
    }

    private function incrementCouponUsage()
    {
        Cart::coupon()->usedOnce();
    }

    private function attachTaxes(Order $order)
    {
        Cart::taxes()->each(function ($cartTax) use ($order) {
            $order->attachTax($cartTax);
        });
    }

    public function reduceStock()
    {
        Cart::reduceStock();
    }

    public function delete(Order $order)
    {
        $order->delete();

        Cart::restoreStock();
    }
}
