<?php


namespace App\Facades;

use App\Repositories\Cart\CartRepositories;
// use Facade;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CartRepositories::class;
    }

}