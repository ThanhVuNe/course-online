<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $carts = Session::get('cart');

        if(!$carts) {
            return redirect()->route('carts');
        }
    
        return view('checkout.index', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $itemCarts = $request->input('select_items');
        if (empty($itemCarts)) {
            session()->flash('error', __('messages.checkout.error.save'));
            return redirect()->route('carts.index');
        }
        $carts = $this->cartService->findSelectCart($itemCarts);
        Session::put('cart', $carts);

        return redirect()->route('checkouts.index');
    }
}
