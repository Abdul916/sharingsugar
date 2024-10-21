<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;

class PlanStripeController extends Controller
{
    public function index(Request $request)
    {
        return view('cms/payment_form');
    }

    public function process(Request $request)
    {
        $request->validate([
            'stripeToken' => 'required',
        ]);
        $stripeSecretKey = env('STRIPE_SECRET_KEY');
        \Stripe\Stripe::setApiKey($stripeSecretKey);
        try {
            $charge = \Stripe\Charge::create([
                'amount' => 1000,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment Description',
            ]);
            return back()->with('success', 'Payment successful! Charge ID: ' . $charge->id);
        } catch (\Stripe\Exception\CardException $e) {
            return back()->with('error', 'Error! ' . $e->getMessage());
        }
    }


    public function buyPost(Request $request)
    {
        $plan = Plans::find($request->plan_id);
        if (empty($plan)) {
            return redirect('membership')->with('error', 'Invalid plan selected.');
        }
        $stripeSecretKey = env('STRIPE_SECRET_KEY');
        $checkoutResponse = Http::withBasicAuth($stripeSecretKey, '')
        ->asForm()
        ->post('https://api.stripe.com/v1/checkout/sessions', [
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $plan->name,
                            'description' => $plan->description,
                        ],
                        'unit_amount' => $plan->price * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => url('/membership/success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/membership/cancel'),
            'customer_email' => auth()->user()->email,
        ]);
        if (!isset($checkoutSession['id'])) {
            dd("Failed to create checkout session");
        }
        dd("redirect to checkout session url");
    }
}