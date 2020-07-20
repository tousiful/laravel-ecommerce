<?php

namespace App\Http\Controllers;
use Session;
use Cart;
use App\Product;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function add_to_cart(){
    	$product = Product::find(request()->pdt_id);

    	$cartItem = Cart::add([
    		'id' => $product->id,
    		'name'=> $product->name,
    		'qty' => request()->qty,
    		'price' => $product->price,

    	]);

        Cart::associate($cartItem->rowId, 'App\Product');
        Session::flash('success', 'Product added to cart.');
    	return redirect()->route('cart');
    }

    public function cart(){

        return view('cart');
    }

     public function cart_delete($id){

        Cart::remove($id);
        Session::flash('success', 'Product removed from cart.');
        return redirect()->back();
    }

    public function incr($id, $qty){

        Cart::update($id, $qty+1);
     
         Session::flash('success', 'Product quantity updated.');
        return redirect()->back();
    }

    public function decr($id, $qty){
        
        Cart::update($id, $qty-1);
        Session::flash('success', 'Product quantity updated.');

        return redirect()->back();
    }

     public function rapid_add($id){
        
        $product = Product::find($id);

        $cartItem = Cart::add([
            'id' => $product->id,
            'name'=> $product->name,
            'qty' => 1,
            'price' => $product->price,

        ]);

        Cart::associate($cartItem->rowId, 'App\Product');
        Session::flash('success', 'Product added to cart.');
        return redirect()->route('cart');
    }
}
