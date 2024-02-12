<?php

namespace App\Providers;

use App\Repositories\Cart\CartModelRrpository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\ServiceProvider;
class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(CartRepository::class,function()
        {
            return new CartModelRrpository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
