<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlansController extends Controller
{
    public function index(Request $request)
    {
        $query = Plans::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('name', 'like', '%' . $search_query . '%');
            });
        }
        $data['plans'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/plans/plans', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stripe_product_id' => 'required',
        ]);

        if ($validator->fails()) {
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        }

        $plan = new Plans();
        $plan->name = $request->name;
        $plan->subtitle = $request->subtitle ?? null;
        $plan->off_percent = $request->off_percent ?? null;
        $plan->description = $request->description;
        $plan->price = $request->price;
        $plan->stripe_product_id = $request->stripe_product_id;
        $plan->save();

        if ($plan->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Membership plan added successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function show(Request $request)
    {
        $plan = Plans::where('id', $request->id)->first();
        if (!empty($plan)) {
            $htmlresult = view('admin/plans/plans_ajax', compact('plan'))->render();
            $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
            return $finalResult;
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Plan not found.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stripe_product_id' => 'required',
        ]);

        if ($validator->fails()) {
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        }
        $plan = Plans::where('id', $request->id)->first();
        if (!empty($plan)) {
            $plan->name = $request->name;
            $plan->subtitle = $request->subtitle ?? null;
            $plan->off_percent = $request->off_percent ?? null;
            $plan->description = $request->description;
            $plan->price = $request->price;
            $plan->stripe_product_id = $request->stripe_product_id;
            $plan->save();
            return response()->json(['msg' => 'success', 'response' => 'Plan updated successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Plan not found.']);
        }
    }
    public function destroy(Request $request)
    {
        // dd($request->all());
        $plan = Plans::find($request->id);
        if (!empty($plan)) {
            $plan->delete();
            return response()->json(['msg' => 'success', 'response' => 'Plan deleted successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Plan not found.']);
        }
    }
}
