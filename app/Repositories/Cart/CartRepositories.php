<?php
namespace App\Repositories\Cart;

use App\Models\product;
use Illuminate\Support\Collection;

interface  CartRepository
{
    public function get() : Collection ;
    public function add(product $product,$quantity=1);
    public function update(product $product , $quantity);

    public function delete($id);

    public function empty();

    public function total(): float;
}

