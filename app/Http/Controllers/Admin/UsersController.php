<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Users;
use Session, Validator, DB;

class UsersController extends Controller
{
    public function index()
    {
        $data['users'] = Users::orderBy('id', 'DESC')->get();
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
        permanently_deleted('profile_images_logs', 'user_id', $data['id']);
        permanently_deleted('user_configs', 'user_id', $data['id']);
        permanently_deleted('user_configs', 'config_user_id', $data['id']);
        permanently_deleted('user_login_logs', 'user_id', $data['id']);
        permanently_deleted('user_photos', 'user_id', $data['id']);
        permanently_deleted('visitors', 'user_id', $data['id']);
        permanently_deleted('visitors', 'visitor_user_id', $data['id']);
        $response_status = permanently_deleted('users', 'id', $data['id']);
        if($response_status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response'=>'User permanently deleted.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
            return $finalResult;
        }
    }

    public function reported_users()
    {
        $data['reported_users'] = DB::table('user_configs')
        ->select('config_user_id', DB::raw('count(*) as total_reports'))
        ->groupBy('config_user_id')
        ->where('type', 4)
        ->get();
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


}
