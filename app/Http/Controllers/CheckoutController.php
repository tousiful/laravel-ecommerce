<?php

namespace App\Http\Controllers;
use Cart;
use Mail;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
    	if(Cart::content()->count()==0){
    		Session::flash('info', 'Your cart is still empty. Do some shopping');
    	}
    	return view('checkout');
    }

    public function pay(){
    	

    	Stripe::setApiKey("sk_test_rHZWkmhheiPbDMLBE2s6Ry8X");

    	$token = request()->stripeToken;

    	$charge = Charge::create([
		    'amount' => Cart::total() * 100,
		    'currency' => 'usd',
		    'description' => 'Selling books',
		    'source' => $token
		]);
		
		Session::flash('success', 'Purchase successfull. Wait for our email.');
		Cart::destroy();
		Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);
		return redirect()->route('index');

    }
}