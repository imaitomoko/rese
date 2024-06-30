<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }
    
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $amount = $request->input('amount');

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount, // Stripeは最小単位（円の場合は1円=100）の整数を受け取る
            'currency' => 'jpy',
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }

}
