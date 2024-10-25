<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoChangeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoChangeApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = PhotoChangeLog::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->whereHas('user', function ($query) use ($search_query) {
                    $query->where('email', 'like', '%' . $search_query . '%')
                    ->orWhere('username', 'like', '%' . $search_query . '%')
                    ->orWhere('last_name', 'like', '%' . $search_query . '%')
                    ->orWhere('first_name', 'like', '%' . $search_query . '%');
                });
            });
        }
        $data['approvals'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/photo_approvals/approvals', $data);
    }

    public function show($id)
    {
        $data['approval'] = PhotoChangeLog::find($id);
        if (!$data['approval']) {
            return redirect()->route('photo_approvals');
        }

        $data['user'] = $data['approval']->user;
        // print_r($data['user']); exit;
        return view('admin.photo_approvals.show', $data);
    }

    public function approve(Request $request)
    {
        $approval = PhotoChangeLog::find($request->id);
        $user = $approval->user;
        if (!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }
        // delete old image
        if ($approval->type == 0) {
            $old_image = $approval->user->profile_image;
            // delete old image
            if ($old_image != 'default.png') {
                $image_path = public_path('assets/app_images/' . $old_image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $user = $approval->user;
            $user->profile_image = $approval->photo;
            $user->save();
            $approval->delete();
        } else {
            $query = DB::table('user_photos')->insertGetId([
                'user_id' => $approval->user->id,
                'photo' => $approval->photo,
                'type' => $approval->type,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $query_two = $approval->delete();
        }
        $email_subject = get_section_content('project', 'site_title') . '(Image approval)';
        $email_text = 'Your acount image has been approved';
        send_notification_email($user, $email_subject, $email_text);
        return response()->json(['status' => 'success', 'message' => 'Approval approved successfully']);
    }

    public function decline(Request $request)
    {
        $approval = PhotoChangeLog::find($request->id);
        $user = $approval->user;
        if (!$approval) {
            return response()->json(['status' => 'error', 'message' => 'Approval not found']);
        }
        // delete approval photo
        if ($approval->type == 0) {
            $image_path = public_path('assets/app_images/' . $approval->photo);
        } else {
            $image_path = public_path('assets/app_images/user_photos/' . $approval->photo);
        }
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $approval->delete();
        $email_subject = $email_subject = get_section_content('project', 'site_title') . '(Image rejection)';
        $email_text = 'Your image has been rejected because it is violating over policy please resubmit your profile details and if you need any help please fill contact us form';
        send_notification_email($user, $email_subject, $email_text);
        return response()->json(['status' => 'success', 'message' => 'Approval declined successfully']);
    }
}
