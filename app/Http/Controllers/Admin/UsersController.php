<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Users;
use Hash, Session, Validator, DB;
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = Users::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('first_name', 'like', '%' . $search_query . '%')
                ->orWhere('last_name', 'like', '%' . $search_query . '%')
                ->orWhere('username', 'like', '%' . $search_query . '%')
                ->orWhere('email', 'like', '%' . $search_query . '%');
            });
        }
        $data['users'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/users/users', $data);
    }
    public function view_profile($id='')
    {
        $data['user'] = Users::find($id);
        if(!empty($data['user'])){
            return view('admin/users/user_profile', $data);
        }else{
            return view('common/admin_404');
        }
    }
    public function change_status(Request $request)
    {
        $data = $request->all();
        $status = Users::where('id', $data['id'])->update([
            'status' => $data['action']
        ]);
        if($data['action'] == '1'){
            $response_msg = 'User Activated successfully.';
        }else{
            $response_msg = 'User Blocked successfully.';
        }
        if($status > 0) {
            return response()->json(array('msg' => 'success', 'response'=>$response_msg));
        } else {
            return response()->json(array('msg' => 'error', 'response'=>'Something went wrong.'));
        }
    }
    public function destroy(Request $request)
    {
        $data = $request->all();
        permanently_deleted('chat', 'sender_id', $data['id']);
        permanently_deleted('chat', 'receiver_id', $data['id']);
        permanently_deleted('chatted_users', 'sender_id', $data['id']);
        permanently_deleted('chatted_users', 'receiver_id', $data['id']);
        permanently_deleted('like_images', 'user_id', $data['id']);
        permanently_deleted('like_images', 'photo_user_id', $data['id']);
        permanently_deleted('membership_logs', 'user_id', $data['id']);
        permanently_deleted('notifications', 'user_id', $data['id']);
        permanently_deleted('notifications', 'notify_user_id', $data['id']);
        permanently_deleted('user_configs', 'user_id', $data['id']);
        permanently_deleted('user_configs', 'config_user_id', $data['id']);
        permanently_deleted('user_login_logs', 'user_id', $data['id']);
        permanently_deleted('user_photos', 'user_id', $data['id']);
        permanently_deleted('visitors', 'user_id', $data['id']);
        permanently_deleted('visitors', 'visitor_user_id', $data['id']);
        permanently_deleted('photo_change_logs', 'user_id', $data['id']);
        permanently_deleted('profile_change_logs', 'user_id', $data['id']);
        $response_status = permanently_deleted('users', 'id', $data['id']);
        if($response_status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response'=>'User permanently deleted.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
            return $finalResult;
        }
    }

    public function reported_users(Request $request)
    {
        $search_query = $request->input('search_query');
        $data['reported_users'] = DB::table('user_configs')
        ->join('users', 'user_configs.config_user_id', '=', 'users.id')
        ->select('user_configs.config_user_id', 'users.id', 'users.username', 'users.profile_image', 'users.email', DB::raw('count(*) as total_reports'))
        ->where('user_configs.type', 4)
        ->groupBy('user_configs.config_user_id', 'users.id', 'users.username', 'users.profile_image', 'users.email')
        ->orderBy('users.id', 'DESC');

        if (!empty($search_query)) {
            $data['reported_users']->where(function($query) use ($search_query) {
                $query->where('users.first_name', 'like', '%' . $search_query . '%')
                ->orWhere('users.last_name', 'like', '%' . $search_query . '%')
                ->orWhere('users.username', 'like', '%' . $search_query . '%')
                ->orWhere('users.email', 'like', '%' . $search_query . '%');
            });
        }
        $data['reported_users'] = $data['reported_users']->paginate(50);

        // print_r($data['reported_users']); exit;
        $data['searchParams'] = $request->all();
        return view('admin/reported_users/reported_users', $data);
    }

    public function view_report($id='')
    {
        $data['user'] = Users::find($id);
        if(!empty($data['user'])){
            $data['user_reports'] = DB::table('user_configs')->where('config_user_id', $id)->where('type', 4)->get();
            return view('admin/reported_users/view_reported_user', $data);
        }else{
            return view('common/admin_404');
        }
    }
    public function destroy_reports(Request $request)
    {
        $data = $request->all();
        $response_status = DB::table('user_configs')
        ->where('config_user_id', $data['id'])
        ->where('type', 4)
        ->delete();
        if($response_status > 0) {
            return response()->json(['msg' => 'success', 'response'=>'reports successfully deleted.']);
        } else {
            return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
        }
    }

    public function generate_new_user_password(Request $request)
    {
        $data = $request->all();
        $data['password'] = rand(10000000, 99999999);
        $status = Users::where('id', $data['id'])->update([
            'password' => Hash::make($data['password'])
        ]);
        if($status > 0) {
            $this->send_user_notification_email($data);
            return response()->json(['msg' => 'success', 'response'=>'New password generated successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
        }
    }

    public function send_user_notification_email($data)
    {
        $data['user'] = Users::find($data['id']);
        $to = $data['user']['email'];
        $subject = 'Password Changed';
        $email_body = view('emails/generated_new_password', compact("data"));
        $body = $email_body;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.get_section_content('project', 'noreply_email').'>' . "\r\n";
        @mail($to, $subject, $body, $headers);
    }

    public function export_users(Request $request, $format)
    {
        if ($format === 'xlsx') {
            return Excel::download(new ExportUsers, 'users.xlsx');
        } elseif ($format === 'csv') {
            return Excel::download(new ExportUsers, 'users.csv');
        }
        return redirect()->back()->with('error', 'Invalid format requested.');
    }

    public function free_membership(Request $request)
    {
        $data = $request->all();
        $days = 30;
        $membership_type = '1';
        DB::table('membership_logs')->insert([
            'user_id' => $data['id'],
            'plan_id' => 1,
            'membership_type' => 1,
            'membership_price' => 0,
            'membership_start' => date('Y-m-d'),
            'membership_end' => date('Y-m-d', strtotime('+' . $days . 'days')),
            'status' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $query = DB::table('users')
        ->where('id', $data['id'])
        ->update([
            'plan_id' => 1,
            'membership_type' => 1,
            'membership_price' => 0,
            'membership_start' => date('Y-m-d'),
            'membership_end' => date('Y-m-d', strtotime('+' . $days . 'days')),
            'membership_status' => 7,
        ]);

        if($query > 0) {
            return response()->json(['msg' => 'success', 'response'=>'One month free membership successfully processed.']);
        } else {
            return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
        }
    }

}