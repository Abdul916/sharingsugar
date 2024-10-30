<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileChangeLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = ProfileChangeLog::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->whereHas('user', function ($query) use ($search_query) {
                    $query->where('first_name', 'like', '%' . $search_query . '%')
                        ->orWhere('last_name', 'like', '%' . $search_query . '%')
                        ->orWhere('username', 'like', '%' . $search_query . '%')
                        ->orWhere('email', 'like', '%' . $search_query . '%');
                });
            });
        }
        $data['approvals'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/profile_approvals/approvals', $data);
    }

    public function show($id)
    {
        $data['approval'] = ProfileChangeLog::find($id);
        if (!$data['approval']) {
            return redirect()->route('admin.profile_approvals')->with('error', 'Approval not found');
        }
        $data['user'] = $data['approval']->user;
        $data['previous_data'] = json_decode($data['approval']->previous_data, true);
        return view('admin.profile_approvals.show', $data);
    }

    public function approve(Request $request)
    {
        $approval = ProfileChangeLog::find($request->id);
        if (!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }

        $query = $approval->delete();
        if ($query) {
            return response()->json(['status' => 'success', 'message' => 'Changes approved successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
    }

    public function decline(Request $request)
    {
        $approval = ProfileChangeLog::find($request->id);
        $previous_data = json_decode($approval->previous_data, true);
        if (!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }

        $user = Auth::user();
        dd($user, $previous_data);
        $user->first_name = $previous_data['first_name'];
        $user->last_name = $previous_data['last_name'];
        $user->username = $previous_data['username'];
        $user->iam = $previous_data['iam'];
        $user->interestedin = $previous_data['interestedin'];
        $user->dob = $previous_data['dob'];
        $user->age = $previous_data['age'];
        $user->gender = $previous_data['gender'];
        $user->height = $previous_data['height'];
        $user->weight = $previous_data['weight'];
        $user->marital_status = $previous_data['marital_status'];
        $user->child = $previous_data['child'];
        $user->body_type = $previous_data['body_type'];
        $user->state = $previous_data['state'];
        $user->zipcode = $previous_data['zipcode'];
        $user->country = $previous_data['country'];
        $user->city = $previous_data['city'];
        $user->address = $previous_data['address'];
        $user->about_me = $previous_data['about_me'];
        $user->latitude = $previous_data['latitude'];
        $user->longitude = $previous_data['longitude'];
        $user->profile_status = 1;

        $query = $user->save();

        if ($query) {
            $approval->delete();
            return response()->json(['status' => 'success', 'message' => 'Changes declined successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
