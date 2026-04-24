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
            $userId = auth('customer')->id();

            // ================= CART COUNT =================
            $cart = Cart::with('items')
                ->when($userId, function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }, function ($q) use ($sessionId) {
                    $q->where('session_id', $sessionId);
                })
                ->first();

            $cartCount = $cart ? $cart->items()->count() : 0;


            // ================= PASS TO ALL VIEWS =================
            $view->with([
                'globalCartCount' => $cartCount
            ]);
        });


        View::composer('*', function ($view) {

            $pages = DynamicPage::where('status', 1)->get();

            $view->with('footerPages', $pages);
        });

        View::composer('*', function ($view) {
            $settings = \App\Models\Setting::pluck('value', 'key');
            $view->with('settings', $settings);

        });

    }
}
