<?php

namespace App\Http\View\Composers;

use App\Services\CartService;
use Illuminate\View\View;

class CartComposer
{
    /**
     * @var CartService
     */
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $countCart = 0;
        if (auth()->id()) {
            $countCart = $this->cartService->getCountCart((int) auth()->id());
        }
        $view->with('countCart', $countCart == 0 ? '' : $countCart);
    }
}
