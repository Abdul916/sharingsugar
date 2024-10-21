<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PlanStripeController extends Controller
{
    public function buyPost(Request $request)
    {
        $plan = Plans::find($request->plan_id);
        if (empty($plan)) {
            return redirect('membership')->with('error', 'Invalid plan selected.');
        }

        // Set Stripe API key from .env file
        $stripeSecretKey = env('STRIPE_SECRET_KEY');

        // Create Stripe Checkout session with application/x-www-form-urlencoded format
        $checkoutResponse = Http::withBasicAuth($stripeSecretKey, '')
            ->asForm()  // Ensures data is sent as application/x-www-form-urlencoded
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
                            'unit_amount' => $plan->price * 100, // Amount in cents
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => url('/membership/success?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/membership/cancel'),
                'customer_email' => auth()->user()->email,
            ]);

        // dd($checkoutResponse->json());
        if (!isset($checkoutSession['id'])) {
            dd("Failed to create checkout session");
        }
        dd("redirect to checkout session url");
    }
}
