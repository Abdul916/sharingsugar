<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;

class PlanStripeController extends Controller
{
    public function index($id)
    {
        $plan = Plans::find($id);
        if(empty($plan)) {
            return redirect('membership')->with('error', 'Invalid plan selected.');
        }
        return view('cms/payment_form', compact('plan'));
    }

    public function process(Request $request)
    {
        $plan = Plans::find($request->plan_id);
        if(empty($plan)) {
            dd('Invalid plan selected.');
        }
        $request->validate([
            'stripeToken' => 'required',
        ]);
        $stripeSecretKey = env('STRIPE_SECRET_KEY');
        \Stripe\Stripe::setApiKey($stripeSecretKey);
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $plan->price * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => $plan->description,
            ]);
            // dd($charge->id);
            // Record Membership Log
            switch($plan->id){
                case 1:
                    $days = 30;
                    break;
                case 2:
                    $days = 90;
                    break;
                case 3:
                    $days = 180;
                    break;
                case 4:
                    $days = 365;
                    break;
                default:
                    $days = 30;
            }
            $query = DB::table('membership_logs')->insert([
                'user_id' => auth()->user()->id,
                'plan_id' => $plan->id,
                'membership_price' => $plan->price,
                'membership_start' => formated_date(now()),
                'membership_end' => formated_date(now()->addDays($days)),
                'stripe_charge_id' => $charge->id,
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // Record USer Table 
            $user = auth()->user();
            $user->membership_plan = $plan->id;
            $user->membership_price = $plan->price;
            $user->membership_start = formated_date(now());
            $user->membership_end = formated_date(now()->addDays($days));
            $user->membership_status = 7;
            $user->save();

            dd('Payment Success');

        } catch (\Stripe\Exception\CardException $e) {
            // return back()->with('error', 'Error! ' . $e->getMessage());
            dd('Error! ' . $e->getMessage());
        }
    }
}