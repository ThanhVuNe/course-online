<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\CategoryComposer;
use App\Http\View\Composers\ProfileComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.header', CartComposer::class);
        View::composer('layouts.header', ProfileComposer::class);
        View::composer('layouts.header', CategoryComposer::class);
    }
}
