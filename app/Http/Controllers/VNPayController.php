<?php

namespace App\Http\Controllers;

use App\Services\VNPayService;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class VNPayController extends Controller
{
    /**
     * @var VNPayService
     */
    protected $momoPaymentService;

    /**
     * @var OrderService
     */
    protected $orderService;

    public function __construct(VNPayService $momoPaymentService, OrderService $orderService)
    {
        $this->momoPaymentService = $momoPaymentService;
        $this->orderService = $orderService;
    }

    /**
     * Rediect to URL VN Pay to Payment.
     *
     * @return RedirectResponse
     */
    public function index()
    {
        $vnpUrl = $this->momoPaymentService->getUrlPayment();

        return redirect($vnpUrl);
    }

    /**
     * Check Status Payment and Store data to database
     *
     * @return RedirectResponse
     */
    public function processPaymentAndOrder(Request $request)
    {
        $statusPayment = $this->momoPaymentService->checkPayment($request);

        if (!$statusPayment) {
            return redirect()->route('carts.index');
        }

        try {
            $userId = (int) auth()->id();
            $cart = session()->get('cart');
            $this->orderService->buyCourses($userId, $cart);
        } catch (Exception $e) {
            session()->flash('error', __('messages.order.error.create_order'));
            return redirect()->route('carts.index');
        }

        $method = 'VnPay';
        return redirect()->route('orders.index', ['method' => $method]);
    }
}
