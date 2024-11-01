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
        if ($data['approval']->type != 0) {
            $data['photos'] = json_decode($data['approval']->photo);
        }
        return view('admin.photo_approvals.show', $data);
    }

    public function approve(Request $request)
    {
        $approval = PhotoChangeLog::find($request->id);
        $user = $approval->user;
        if ($approval->type == 0) {
            $old_image_path = public_path('assets/app_images/' . $approval->photo);
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }

        $query = $approval->delete();

        if ($query) {
            $email_subject = $email_subject = get_section_content('project', 'site_title') . '(Image approval)';
            $email_text = 'Your recent uploads have been by admin at Sharing Sugar.';
            send_notification_email($user, $email_subject, $email_text);
            return response()->json(['status' => 'success', 'message' => 'Approval approved successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
    }

    public function decline(Request $request)
    {
        $approval = PhotoChangeLog::find($request->id);
        $user = $approval->user;
        if ($approval->type == 0) {
            $new_photo_path = public_path('assets/app_images/' . $user->profile_image);
            $user->profile_image = $approval->photo;
            $query = $user->save();
            if ($query) {
                if (file_exists($new_photo_path)) {
                    unlink($new_photo_path);
                }
            }

            return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
        } else {
            $images = json_decode($approval->photo);
            foreach ($images as $image) {
                $image_path = public_path('assets/app_images/user_photos/' . $image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $user_pic = DB::table('user_photos')->where('user_id', $approval->user_id)->where('photo', $image)->delete();
            }
        }

        $query_two = $approval->delete();
        if ($query_two) {
            $email_subject = $email_subject = get_section_content('project', 'site_title') . '(Image rejection)';
            $email_text = 'Your recent uploads have been rejected because they violate our policy please resubmit your profile details and if you need any help please fill contact form on our website.';
            send_notification_email($user, $email_subject, $email_text);
            return response()->json(['status' => 'success', 'message' => 'Approval declined successfully']);
        }
        return response()->json(['status' => 'success', 'message' => 'Approval declined successfully but not deleted.']);
    }
}
