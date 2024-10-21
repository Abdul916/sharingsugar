<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileChangeLog;
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
        // dd($data['approval_data']);
        return view('admin.profile_approvals.show', $data);
    }

    public function approve(Request $request)
    {
        $approval = ProfileChangeLog::find($request->id);
        if(!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }
        $user = $approval->user;
        $updated_data = json_decode($approval->updated_data, true);
        $user->update($updated_data);
        $approval->delete();
        return response()->json(['status' => 'success', 'message' => 'Approval approved successfully']);
    }

    public function decline(Request $request)
    {
        $approval = ProfileChangeLog::find($request->id);
        if(!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }
        $approval->delete();
        return response()->json(['status' => 'success', 'message' => 'Approval declined successfully']);
    }
}
