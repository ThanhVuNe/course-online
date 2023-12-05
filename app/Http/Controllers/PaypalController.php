<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\PaypalService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * @var PaypalService
     */
    protected $paypalService;

    public function __construct(OrderService $orderService, PaypalService $paypalService)
    {
        $this->orderService = $orderService;
        $this->paypalService = $paypalService;
    }

    /**
     * create order payment and redirect to paypal
     * @return RedirectResponse
     */
    public function handlePayment(): RedirectResponse
    {
        $cart = session()->get('cart');

        abort_if(!$cart, 404);

        $totalAmount = $this->paypalService->calculateTotalAmount($cart);

        $response = $this->paypalService->createOrder($totalAmount);
        $approveLink = $this->paypalService->findApproveLink($response['links']);

        if ($approveLink) {
            return redirect()->away($approveLink);
        }

        return redirect()->route('checkouts.index')->with('error', $response['message'] ?? __('messages.payment.paypal.error'));
    }

    /**
     * Store a newly created resource in storage.
     * @return RedirectResponse
     */
    public function afterPayment(Request $request): RedirectResponse
    {
        $token = $request->input('token');

        abort_if(!$token, 404);

        $response = $this->paypalService->capturePaymentOrder($token);

        if ($response['status'] == 'COMPLETED') {
            $cart = session()->get('cart');
            $totalAmount = $this->paypalService->calculateTotalAmount($cart);
            $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

            if ($totalAmount !== $amount) {
                return redirect()->route('carts.index')->with('error', __('messages.payment.paypal.error'));
            }

            try {
                $userId = (int) auth()->id();
                $this->orderService->buyCourses($userId, $cart);
            } catch (Exception $e) {
                session()->flash('error', __('messages.order.error.create_order'));
                return redirect()->route('carts.index');
            }
            return redirect()->route('orders.index');
        }

        return redirect()->route('cart.index')->with('error', $response['message'] ?? __('messages.payment.paypal.error'));
    }
}
