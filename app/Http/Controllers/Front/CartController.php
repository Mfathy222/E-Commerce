<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\product;
// use App\Repositories\Cart\CartModelRrpository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        // $repository = new CartModelRrpository();
        // $items = $cart->get();

        return view('front.cart',[
            'cart'=>$cart
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,CartRepository $cart)
    {
        $request->validate([
            'product_id'=>['required','int','exists:product,id'],
            'quantity'=>['nullable', 'int' , 'min:1'],
        ]);

        $product = product::findOrFail($request->post('product_id'));
        // $repository =new CartModelRrpository();
        $cart->add($product,$request->post('quantity'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,CartRepository $cart)
    {
        $request->validate([
            'product_id'=>['required','int','exists:product,id'],
            'quantity'=>['nullable', 'int' , 'min:1'],
        ]);

        $product = product::findOrFail($request->post('product_id'));
        // $repository =new CartModelRrpository();
        $cart->update($product,$request->post('quantity'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, $id)
    {
        $cart->delete($id);
    }
}
