<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (empty($plan)) {
            return redirect('membership')->with('error', 'Invalid plan selected.');
        }
        return view('cms/payment_form', compact('plan'));
    }

    public function process(Request $request)
    {
        $plan = Plans::find($request->plan_id);
        $stripeToken = $request->stripeToken;
        if (!empty($plan->id) && !empty($stripeToken)) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $plan->price * 100,
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => $plan->name,
                ]);
                switch ($plan->id) {
                    case 1:
                        $days = 30;
                        $membership_type = '1';
                        break;
                    case 2:
                        $days = 90;
                        $membership_type = '2';
                        break;
                    case 3:
                        $days = 180;
                        $membership_type = '3';
                        break;
                    case 4:
                        $days = 365;
                        $membership_type = '4';
                        break;
                    default:
                        $days = 30;
                        $membership_type = '1';
                }
                $query = DB::table('membership_logs')->insert([
                    'user_id' => auth()->user()->id,
                    'plan_id' => $plan->id,
                    'membership_type' => $membership_type,
                    'membership_price' => $plan->price,
                    'membership_start' => date('Y-m-d'),
                    'membership_end' => date('Y-m-d', strtotime('+' . $days . 'days')),
                    'stripe_charge_id' => $charge->id,
                    'status' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                // Record USer Table
                $user = auth()->user();
                $user->plan_id = $plan->id;
                $user->membership_type = $membership_type;
                $user->membership_price = $plan->price;
                $user->membership_start = date('Y-m-d');
                $user->membership_end = date('Y-m-d', strtotime('+' . $days . 'days'));
                $user->membership_status = 7;
                $user->save();

                return redirect('user_membership')->with('success', 'Payment successful.');

            } catch (\Stripe\Exception\CardException $e) {
                // return back()->with('error', 'Error! ' . $e->getMessage());
                dd('Error! ' . $e->getMessage());
            }
        }
    }
}
