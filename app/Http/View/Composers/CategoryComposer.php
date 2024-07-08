<?php

namespace App\Http\View\Composers;

use App\Services\CategoryService;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * @var CartService
     */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $categories = $this->categoryService->getAllCategory();
       
        $view->with('categories', $categories);
    }
}
