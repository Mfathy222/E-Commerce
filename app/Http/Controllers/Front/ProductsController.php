<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {

    }

    public function show(product $product)
    {
        
        if ($product->status != 'active') {
            abort(404);
        }

        return view('front.products.show', compact('product'));
    }
}
