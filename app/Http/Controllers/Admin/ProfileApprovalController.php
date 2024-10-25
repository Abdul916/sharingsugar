<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileChangeLog;
use App\Models\User;
use Illuminate\Http\Request;

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
        if(!$data['approval']) {
            return redirect()->route('admin.profile_approvals')->with('error', 'Approval not found');
        }
        $data['user'] = $data['approval']->user;
        $data['approval_data'] = json_decode($data['approval']->updated_data, true);
        return view('admin.profile_approvals.show', $data);
    }

    public function approve(Request $request)
    {
        $approval = ProfileChangeLog::find($request->id);
        if(!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }
        $user_id = $approval->user_id;
        $updated_data = json_decode($approval->updated_data, true);
        $user = User::find($user_id);
        if ($user) {
            $user->first_name = $updated_data['first_name'];
            $user->last_name = $updated_data['last_name'];
            $user->username = $updated_data['username'];
            $user->dob = $updated_data['dob'];
            $user->age = $updated_data['age'];
            $user->gender = $updated_data['gender'];
            $user->height = $updated_data['height'];
            $user->weight = $updated_data['weight'];
            $user->marital_status = $updated_data['marital_status'];
            $user->child = $updated_data['child'];
            $user->body_type = $updated_data['body_type'];
            $user->state = $updated_data['state'];
            $user->zipcode = $updated_data['zipcode'];
            $user->country = $updated_data['country'];
            $user->city = $updated_data['city'];
            $user->address = $updated_data['address'];
            $user->about_me = $updated_data['about_me'];
            $user->latitude = $updated_data['latitude'];
            $user->longitude = $updated_data['longitude'];
            $user->profile_status = $updated_data['profile_status'];
            $user->save();
        }
        $approval->delete();
        $email_subject = get_section_content('project', 'site_title') . '(Profile update approval)';
        $email_text = 'Your acount detail has been approved';
        send_notification_email($user, $email_subject, $email_text);
        return response()->json(['status' => 'success', 'message' => 'Approval approved successfully']);
    }

    public function decline(Request $request)
    {
        $approval = ProfileChangeLog::find($request->id);
        if(!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }
        $user = User::find($approval->user_id);
        $approval->delete();
        $email_subject = get_section_content('project', 'site_title') . '(Profile update rejected)';
        $email_text = 'Your profile detail has been rejected because it is violating over policy please resubmit your profile details and if you need any help please fill contact us form';
        send_notification_email($user, $email_subject, $email_text);
        return response()->json(['status' => 'success', 'message' => 'Approval declined successfully']);
    }
}
