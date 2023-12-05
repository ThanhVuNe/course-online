<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     * @return RedirectResponse|View
     */
    public function index()
    {
        $orders = session()->get('cart');
        if ($orders) {
            session()->forget('cart');
            return view('order.index', compact('orders'));
        }
        return redirect()->route('carts.index');
    }

    /**
     * Store a newly created resource in storage.
     * @return RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod === config('payment.paypal')) {
            return redirect()->route('paypal.payment');
        }

        return redirect()->route('vnPay.payment');
    }
}
