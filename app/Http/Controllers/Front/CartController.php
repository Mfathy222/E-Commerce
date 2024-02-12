<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Cart\CartRepositories;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepositories $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repository = new CartModelRepository();
        $items = $repository->get();

        return view('front.cart',[
            'cart'=> $this->cart,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,CartRepositories $cart)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable', 'int' , 'min:1'],
        ]);
        

        $product = product::findOrFail($request->post('product_id'));
        $this->cart->add($product, $request->post('quantity'));

        return redirect()
        ->route('cart.index')
        ->with('success','product added to cart');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,CartRepositories $cart)
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
    public function destroy(CartRepositories $cart, $id)
    {
        $cart->delete($id);
    }
}
