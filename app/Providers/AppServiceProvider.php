<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use App\Models\DynamicPage;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {

            $sessionId = session()->getId();

            $cart = Cart::with('items')
                ->where('session_id', $sessionId)
                ->first();

            $count = $cart ? $cart->items()->count() : 0;

            $view->with('globalCartCount', $count);
        });


        View::composer('*', function ($view) {

            $pages = DynamicPage::where('status', 1)->get();

            $view->with('footerPages', $pages);
        });

    }
}
