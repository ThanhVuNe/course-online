<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCartsRequest;
use App\Services\CartService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
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
     * show list course of cart by user
     * @return View
     */
    public function index(): View
    {
        $cart = $this->cartService->getCartByUser((int)auth()->id());
        return view('cart.index', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $courseId = $request->input('course_id');
            $userId = (int) auth()->id();
            $this->cartService->addToCart($userId, $courseId);
            session()->flash('message', __('messages.cart.success.create'));
        } catch (Exception $e) {
            session()->flash('error', __('messages.cart.error.create'));
        }
        return redirect()->back()->withErrors(__('messages.cart.error.delete'));
    }

    /**
     * @param int $id
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        if ($this->cartService->deleteCart($id)) {
            session()->flash('message', __('messages.cart.success.delete'));
            return redirect()->back();
        }
        session()->flash('error', __('messages.cart.error.delete'));
        return redirect()->back();
    }

    /**
     * @param DeleteCartsRequest $request
     * @return RedirectResponse
     */
    public function deleteMutilCarts(DeleteCartsRequest $request)
    {
        $selectedItems = $request->input('selected_items');
        $userId = (int) auth()->id();
        $ids = explode(',', data_get($selectedItems, []));
        if ($this->cartService->deleteCarts($ids, $userId)) {
            session()->flash('message', __('messages.cart.success.delete'));
            return redirect()->back();
        }

        return redirect()->back();
    }
}
