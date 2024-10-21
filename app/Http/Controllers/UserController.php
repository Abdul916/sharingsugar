<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfileChangeLog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash, Session, Validator, DB, DateTime;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{

    public function index()
    {
        $data['user'] = User::find(Auth::user()->id);
        return view('user/profile', $data);
    }

    public function public_profile($unique_id = '')
    {

        $data['user'] = User::where('unique_id', $unique_id)->first();
        if (!empty($data['user'])) {
            return view('user/public_profile', $data);
        } else {
            return redirect('home');
        }
    }

    public function edit()
    {
        $data['user'] = User::find(Auth::user()->id);
        if(is_profile_approval_pending(Auth::user()->id)){
            return redirect('profile');
        }
        return view('user/edit_profile', $data);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validator = FacadesValidator::make(
            $data,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required|unique:users,username,' . $data['id'],
                'dob' => 'required',
                'gender' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'marital_status' => 'required',
                'child' => 'required',
                'body_type' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
                'country' => 'required',
                'city' => 'required',
                'address' => 'required',
                'about_me' => 'required'
            ],
            [
                'username.unique' => 'This username already taken.',
            ]
        );
        if ($validator->fails()) {
            $finalResult = response()->json(array('msg' => 'lvl_error', 'response' => $validator->errors()->all()));
            return $finalResult;
        }

        $bday = new \DateTime($data['dob']);
        $today = new \Datetime(date('m/d/Y'));
        $diff = $today->diff($bday);
        $age = $diff->y;

        // $status = User::where('id', $data['id'])->update([
        //     'first_name' => $data['first_name'],
        //     'last_name' => $data['last_name'],
        //     'username' => $data['username'],
        //     'dob' => date('Y-m-d', strtotime(str_replace('/', '-', $data['dob']))),
        //     'age' => $age,
        //     'gender' => $data['gender'],
        //     'height' => $data['height'],
        //     'weight' => $data['weight'],
        //     'marital_status' => $data['marital_status'],
        //     'child' => $data['child'],
        //     'body_type' => $data['body_type'],
        //     'state' => $data['state'],
        //     'zipcode' => $data['zip_code'],
        //     'country' => $data['country'],
        //     'city' => $data['city'],
        //     'address' => $data['address'],
        //     'about_me' => $data['about_me'],
        //     'latitude' => $data['latitude'] ?? null,
        //     'longitude' => $data['longitude'] ?? null,
        //     'profile_status' => '2',
        // ]);

        $updated_data = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'dob' => date('Y-m-d', strtotime(str_replace('/', '-', $data['dob']))),
            'age' => $age,
            'gender' => $data['gender'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'marital_status' => $data['marital_status'],
            'child' => $data['child'],
            'body_type' => $data['body_type'],
            'state' => $data['state'],
            'zipcode' => $data['zip_code'],
            'country' => $data['country'],
            'city' => $data['city'],
            'address' => $data['address'],
            'about_me' => $data['about_me'],
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'profile_status' => '2',
        ];

        $profile_change_log = new ProfileChangeLog();
        $profile_change_log->user_id = $data['id'];
        $profile_change_log->updated_data = json_encode($updated_data);
        $profile_change_log->status  = 0;
        $query = $profile_change_log->save();
        if ($query > 0) {
            $finalResult = response()->json(array('msg' => 'success', 'response' => 'Your updated profile will be reviewed by admin. Changes would be propagated shortly after approval.'));
            return $finalResult;
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response' => 'Something went wrong.'));
            return $finalResult;
        }
    }

    public function change_password()
    {
        $data['user'] = User::find(Auth::user()->id);
        return view('user/change_password', $data);
    }

    public function update_password(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'old_password' => 'required',
            'new_password' => 'required|min:6|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            $finalResult = response()->json(array('msg' => 'lvl_error', 'response' => $validator->errors()->all()));
            return $finalResult;
        }

        if (Hash::check($data['old_password'], Auth::user()->password)) {
            $status = User::where('id', $data['id'])->update([
                'password' => Hash::make($data['new_password'])
            ]);
            if ($status > 0) {
                $finalResult = response()->json(array('msg' => 'success', 'response' => 'Password successfully updated.'));
                return $finalResult;
            } else {
                $finalResult = response()->json(array('msg' => 'error', 'response' => 'Something went wrong.'));
                return $finalResult;
            }
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response' => 'Your password is wrong.'));
            return $finalResult;
        }
    }

    public function upload_profile_image(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'profile_pic' => 'mimes:jpeg,jpg,png,gif|max:10240',
        ]);
        if ($validator->fails()) {
            $finalResult = response()->json(array('msg' => 'lvl_error', 'response' => $validator->errors()->all()));
            return $finalResult;
        }

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $file_name = explode('.', $image->getClientOriginalName())[0];
            $data['profile_image'] = $file_name . '_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/app_images');
            $image->move($destinationPath, $data['profile_image']);
        }

        $query = DB::table('profile_images_logs')->insertGetId([
            'user_id' => $data['id'],
            'profile_image' => $data['profile_image'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $status = User::where('id', $data['id'])->update([
            'profile_image' => $data['profile_image']
        ]);

        if ($status > 0) {
            $finalResult = response()->json(array('msg' => 'success', 'response' => 'Profile Image successfully upload.'));
            return $finalResult;
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response' => 'Something went wrong.'));
            return $finalResult;
        }
    }

    public function my_photos()
    {
        $data['user'] = User::find(Auth::user()->id);
        return view('user/my_photos', $data);
    }

    public function upload_photos(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'my_photos' => 'required',
            'my_photos.*' => 'mimes:jpeg,jpg,png,gif|max:10240',
        ]);
        if ($validator->fails()) {
            $finalResult = response()->json(array('msg' => 'lvl_error', 'response' => $validator->errors()->all()));
            return $finalResult;
        }

        if ($request->hasFile('my_photos')) {
            foreach ($data['my_photos'] as $image) {
                $file_name = explode('.', $image->getClientOriginalName())[0];
                $photo_name = $file_name . '_' . time() . rand(1111, 9999) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/app_images/user_photos');
                $image->move($destinationPath, $photo_name);

                $status = DB::table('user_photos')->insertGetId([
                    'user_id' => $data['id'],
                    'photo' => $photo_name,
                    'type' => $data['type'],
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        if ($status > 0) {
            $finalResult = response()->json(array('msg' => 'success', 'response' => 'Photos successfully upload.'));
            return $finalResult;
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response' => 'Something went wrong.'));
            return $finalResult;
        }
    }

    public function delete_photos(Request $request)
    {
        $data = $request->all();
        $response_status = softly_deleted('user_photos', 'id', $data['id'], 'status', '3');
        if ($response_status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Photo successfully deleted.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function send_user_credential_email($data)
    {
        $to = $data['email'];
        $subject = get_section_content('project', 'site_title') . '(New Registration)';
        $email_body = view('emails/credential_email', compact("data"));
        $body = $email_body;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <' . get_section_content('project', 'noreply_email') . '>' . "\r\n";
        @mail($to, $subject, $body, $headers);
        return true;
    }

    public function user_membership()
    {
        $data['user'] = User::find(Auth::user()->id);
        return view('user/user_membership', $data);
    }

    public function favorites()
    {
        $data['user'] = User::find(Auth::user()->id);
        return view('user/favorites', $data);
    }

    public function privacy_settings()
    {
        $data['user'] = User::find(Auth::user()->id);

        $data['blocked'] = DB::table('user_configs')
        ->where('user_id', Auth::user()->id)
        ->where('type', 3)
        ->get();

        $data['today_visitor_count'] = DB::table('visitors')
        ->where('user_id', Auth::user()->id)
        ->whereDate('created_at', date('Y-m-d'))
        ->distinct()->count('visitor_user_id');


        $data['today_visitors'] = DB::table('visitors')
        ->where('user_id', Auth::user()->id)
        ->whereDate('created_at', date('Y-m-d'))
        ->distinct()
        ->get('visitor_user_id');

        $data['visitors'] = DB::table('visitors')
        ->where('user_id', Auth::user()->id)
        ->distinct()
        ->get('visitor_user_id');

        return view('user/privacy_settings', $data);
    }

    public function members(Request $request)
    {
        // dd($request->all());
        $query = User::query();
        $query->where('id', '<>', Auth::user()->id);
        if ($request->has('interestedin')) {
            if ($request->interestedin == 'Sugar Daddy') {
                $query->where('iam', 'Sugar Daddy');
            } else if ($request->interestedin == 'Sugar Mommy') {
                $query->where('iam', 'Sugar Mommy');
            } else if ($request->interestedin == 'Sugar Daddy Mommy') {
                $query->where('iam', 'Sugar Daddy Mommy');
            } else if ($request->interestedin == 'Sugar Baby Man') {
                $query->where('iam', 'Sugar Baby (Hombre / Man)');
            } else if ($request->interestedin == 'Sugar Baby Women') {
                $query->where('iam', 'Sugar Baby (Mujer / Woman)');
            } else if ($request->interestedin == 'Sugar Baby Trans') {
                $query->where('iam', 'Sugar Baby (Trans)');
            }
        }
        if($request->sorting == 'last_login'){
            $query->orderBy('last_login', 'DESC');
        } else if ($request->sorting == 'distance'){
            $query->orderByRaw('latitude IS NULL, longitude IS NULL, ( 3959 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) )');
        }

        if($request->only_photos == 'on'){
            $query->where('profile_image', '!=', NULL);
        }
        if($request->name != ''){
            $query->where('first_name', 'like', '%' . $request->name . '%')
            ->orWhere('last_name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('Age')) {
            $query->where('age', '>=', $request->minAge);
            $query->where('age', '<=', $request->maxAge);
        }
        if ($request->has('Height')) {
            $query->where('height', '>=', $request->minHeight);
            $query->where('height', '<=', $request->maxHeight);
        }
        if ($request->has('Weight')) {
            $query->where('weight', '>=', $request->minWeight);
            $query->where('weight', '<=', $request->maxWeight);
        }
        if ($request->has('Children')) {
            $query->where('child', '>=', $request->minChildren);
            $query->where('child', '<=', $request->maxChildren);
        }
        $body_types = [];
        if ($request->has('Skinny')) {
            $body_types[] = 1;
        }
        if ($request->has('Tiny')) {
            $body_types[] = 2;
        }
        if ($request->has('Median')) {
            $body_types[] = 3;
        }
        if ($request->has('Athletic')) {
            $body_types[] = 4;
        }

        if ($request->has('Curvilinear')) {
            $body_types[] = 5;
        }
        if ($request->has('Full_Height')) {
            $body_types[] = 6;
        }
        if (count($body_types) > 0) {
            $query->whereIn('body_type', $body_types);
        }

        if ($request->has('locationsec')) {
            if ($request->has('city') && $request->city != '') {
                $query->where('city', 'like', '%' . $request->city . '%');
            }
            if ($request->has('state') && $request->state != '') {
                $query->where('state', 'like', '%' . $request->state . '%');
            }
            if ($request->has('country') && $request->country != '') {
                $query->where('country', 'like', '%' . $request->country . '%');
            }
            if ($request->has('address') && $request->address != '') {
                $distance = $request->distance;
                $latitude = $request->latitude;
                $longitude = $request->longitude;
                $radius = 6371;

                $latRadians = deg2rad($latitude);
                $lngRadians = deg2rad($longitude);

                $angularDistance = $distance / $radius;

                $lngMinRadians = $lngRadians - $angularDistance / cos($latRadians);
                $lngMaxRadians = $lngRadians + $angularDistance / cos($latRadians);

                $latMin = rad2deg($latRadians - $angularDistance);
                $latMax = rad2deg($latRadians + $angularDistance);
                $lngMin = rad2deg($lngMinRadians);
                $lngMax = rad2deg($lngMaxRadians);

                $query->whereBetween('latitude', [$latMin, $latMax]);
                $query->whereBetween('longitude', [$lngMin, $lngMax]);
            }
        }
        // those blocked should not be in query
        $blocked = DB::table('user_configs')
        ->where('user_id', Auth::user()->id)
        ->where('type', 3)
        ->get();
        $blocked_ids = [];
        foreach ($blocked as $block) {
            $blocked_ids[] = $block->config_user_id;
        }
        $query->whereNotIn('id', $blocked_ids);
        // $data['users'] = $query->paginate(3);
        $users = $query->paginate(3);
        $users->appends($request->except('page'));
        $data['users'] = $users;
        $data['parameters'] = $request->all();
        $data['cordinates'] = [];
        foreach ($data['users'] as $user) {
            if ($user->latitude != null && $user->longitude != null) {
                $data['cordinates'][] = [
                    'lat' => (float)$user->latitude,
                    'lng' => (float)$user->longitude,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'profile_link' => url('public_profile/' . $user->unique_id),
                ];
            }
        }
        $data['cordinates'] = json_encode($data['cordinates']);
        return view('user/members', $data);
    }

    public function add_remover_user_configuration(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == 'favorite') {
            add_notifications(Auth::user()->id, $data['id'], 'added your profile to favorites list', '3');
            $status = add_user_configuration(Auth::user()->id, $data['id'], '1', '', '', '1', '');
            $response = 'User successfully added in favorite list.';
        } elseif ($data['action'] == 'like') {
            add_notifications(Auth::user()->id, $data['id'], 'liked your profile', '1');
            $status = add_user_configuration(Auth::user()->id, $data['id'], '2', '', '', '1', '');
            $response = 'User liked successfully.';
        } elseif ($data['action'] == 'block') {
            $status = add_user_configuration(Auth::user()->id, $data['id'], '3', '', '', '1', '');
            $response = 'User blocked successfully.';
        } elseif ($data['action'] == 'allow_private_photos') {
            add_notifications(Auth::user()->id, $data['id'], 'allow you to view private photos', '5');
            $status = add_user_configuration(Auth::user()->id, $data['id'], '5', '', '', '2', $data['requested_id']);
            $response = 'User successfully allow to view your private photos.';
        } elseif ($data['action'] == 'request_private_photos') {
            $status = add_user_configuration($data['id'], Auth::user()->id, '5', '', '', '1', '');
            $response = 'Your request was successfully submitted.';
        } elseif ($data['action'] == 'report') {

            $validator = Validator::make($data, [
                'report_image' => 'mimes:jpeg,jpg,png,gif|max:10240',
            ]);
            if ($validator->fails()) {
                $finalResult = response()->json(array('msg' => 'lvl_error', 'response' => $validator->errors()->all()));
                return $finalResult;
            }

            $data['report_image'] = "";
            if ($request->hasFile('report_image')) {
                $image = $request->file('report_image');
                $file_name = explode('.', $image->getClientOriginalName())[0];
                $data['report_image'] = $file_name . '_' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/report_images');
                $image->move($destinationPath, $data['report_image']);
            }

            $status = add_user_configuration(Auth::user()->id, $data['id'], '4', $data['description'], $data['report_image'], '1', '');
            $response = 'User reported successfully.';
        } elseif ($data['action'] == 'unlike') {
            $status = remove_user_configuration(Auth::user()->id, $data['id'], '2');
            $response = 'User successfully removed from liked.';
        } elseif ($data['action'] == 'unfavorite') {
            $status = remove_user_configuration(Auth::user()->id, $data['id'], '1');
            $response = 'User successfully removed from favorites.';
        } elseif ($data['action'] == 'unblock') {
            $status = remove_user_configuration(Auth::user()->id, $data['id'], '3');
            $response = 'User successfully unblocked.';
        } elseif ($data['action'] == 'block_private_photos') {
            $status = remove_user_configuration(Auth::user()->id, $data['id'], '5');
            $response = 'User successfully blocked to view your private photos.';
        } elseif ($data['action'] == 'delete_request') {
            $status = remove_user_configuration($data['id'], Auth::user()->id, '5');
            $response = 'Your request successfully deleted.';
        }
        if ($status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => $response]);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }


    public function like_user_photos(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == 'like') {
            add_notifications(Auth::user()->id, $data['photo_user_id'], 'liked your photo', '2');
            $status = like_photos($data['user_id'], $data['photo_user_id'], $data['id']);
            $response = 'Photo liked successfully.';
        } elseif ($data['action'] == 'unlike') {
            $status = unlike_photos($data['user_id'], $data['photo_user_id'], $data['id']);
            $response = 'Photo unliked successfully.';
        }
        if ($status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => $response]);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function requests()
    {
        $data['user'] = User::find(Auth::user()->id);
        $data['pending'] = DB::table('user_configs')
        ->where('user_id', Auth::user()->id)
        ->where('type', 5)
        ->where('status', 1)
        ->get();

        $data['approved'] = DB::table('user_configs')
        ->where('user_id', Auth::user()->id)
        ->where('type', 5)
        ->where('status', 2)
        ->get();


        $data['my_pending'] = DB::table('user_configs')
        ->where('config_user_id', Auth::user()->id)
        ->where('type', 5)
        ->where('status', 1)
        ->get();

        $data['my_approved'] = DB::table('user_configs')
        ->where('config_user_id', Auth::user()->id)
        ->where('type', 5)
        ->where('status', 2)
        ->get();

        return view('user/requests', $data);
    }


    public function update_user_privacy_settings(Request $request)
    {
        $data = $request->all();
        if ($data['value'] == 1) {
            $status = "1";
        } else {
            $status = "0";
        }
        if ($data['action'] == 'last_login') {
            $status = update_user_privacy_settings('show_last_login', $status);
            $response = 'Successfully updated.';
        } elseif ($data['action'] == 'block_male') {
            $status = update_user_privacy_settings('block_male_msg', $status);
            $response = 'Successfully updated.';
        } elseif ($data['action'] == 'block_female') {
            $status = update_user_privacy_settings('block_female_msg', $status);
            $response = 'Successfully updated.';
        } elseif ($data['action'] == 'block_trans') {
            $status = update_user_privacy_settings('block_trans_msg', $status);
            $response = 'Successfully updated.';
        } elseif ($data['action'] == 'block_all_email') {
            update_user_privacy_settings('block_money_making_opp_email', $status);
            update_user_privacy_settings('block_local_event_meet_up_email', $status);
            update_user_privacy_settings('block_like_favorite_email', $status);
            $status = update_user_privacy_settings('block_all_email', $status);
            $response = 'Successfully updated.';
        } elseif ($data['action'] == 'block_money_opp') {
            $status = update_user_privacy_settings('block_money_making_opp_email', $status);
            $response = 'Successfully updated.';
        } elseif ($data['action'] == 'block_local_event') {
            $status = update_user_privacy_settings('block_local_event_meet_up_email', $status);
            $response = 'Successfully updated.';
        } elseif ($data['action'] == 'block_like_favorite') {
            $status = update_user_privacy_settings('block_like_favorite_email', $status);
            $response = 'Successfully updated.';
        }
        if ($status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => $response]);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function visit_profile(Request $request)
    {
        $data = $request->all();
        $status = DB::table('visitors')->insertGetId([
            'user_id' => $data['user_id'],
            'visitor_user_id' => $data['visitor_user_id'],
            'ip' => request()->ip(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    public function delete_account(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['password'], Auth::user()->password)) {
            $status = User::where('id', Auth::user()->id)->update([
                'status' => 3
            ]);
            if ($status > 0) {
                update_login_logs(Auth::user()->id);
                Session::flush();
                Auth::logout();
                $finalResult = response()->json(array('msg' => 'success', 'response' => 'Your Account successfully deleted.'));
                return $finalResult;
            } else {
                $finalResult = response()->json(array('msg' => 'error', 'response' => 'Something went wrong.'));
                return $finalResult;
            }
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response' => 'Your password is wrong.'));
            return $finalResult;
        }
    }

    public function chat(Request $request)
    {
        $data['chat_id'] = '';
        $data['receiver_id'] = '';
        if (isset($_GET['q'])) {
            $unique_id = $_GET['q'];
            $user = get_single_row('users', 'unique_id', $unique_id);
            $user_id = $user->id;

            $chatted = DB::table('chatted_users')
            ->where(function ($query1) use ($user_id) {
                $query1->where('sender_id', '=', Auth::user()->id)
                ->where('receiver_id', '=', $user_id);
            })
            ->orWhere(function ($query2) use ($user_id) {
                $query2->where('sender_id', $user_id)
                ->where('receiver_id', Auth::user()->id);
            })->first();

            if (empty($chatted->id)) {
                $chatted_id = DB::table('chatted_users')->insertGetId([
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $user_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        if (isset($_GET['q'])) {
            $unique_id = $_GET['q'];
            $user = get_single_row('users', 'unique_id', $unique_id);
            $user_id = $user->id;

            $chatted = DB::table('chatted_users')
            ->where(function ($query1) use ($user_id) {
                $query1->where('sender_id', '=', Auth::user()->id)
                ->where('receiver_id', '=', $user_id);
            })
            ->orWhere(function ($query2) use ($user_id) {
                $query2->where('sender_id', $user_id)
                ->where('receiver_id', Auth::user()->id);
            })->first();
            $data['chat_id'] = $chatted->id;
            $data['receiver_id'] = $user_id;
        }

        $data['chatted_users'] = DB::table('chatted_users')
        ->where(function ($query) {
            $query->where('sender_id', Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id);
        })->orderBy('id', 'ASC')->get();

        $data['user'] = User::find(Auth::user()->id);
        return view('user/chat', $data);
    }

    public function get_chats(Request $request)
    {
        $data = $request->all();
        $data['chats'] = DB::table('chat')
        ->where('chatted_id', $data['chat_id'])
        ->orderBy('id', 'ASC')->get();

        $data['chatted_id'] = $data['chat_id'];
        $row = get_single_row('chatted_users', 'id', $data['chat_id'], '', '', '', '');
        if ($row->sender_id == Auth::user()->id) {
            $data['chatted_user_id'] = $row->receiver_id;
        } else {
            $data['chatted_user_id'] = $row->sender_id;
        }
        $htmlresult = view('user/chat_ajax', $data)->render();
        $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
        return $finalResult;
    }

    public function save_chats(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $finalResult = response()->json(array('msg' => 'lvl_error', 'response' => $validator->errors()->all()));
            return $finalResult;
        }

        $status = DB::table('chat')->insertGetId([
            'chatted_id' => $data['chat_id'],
            'sender_id' => Auth::user()->id,
            'receiver_id' => $data['receiver_id'],
            'message' => $data['message'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->id,
        ]);

        if ($status > 0) {
            add_notifications(Auth::user()->id, $data['receiver_id'], 'sent a text message', '4');
            $finalResult = response()->json(array('msg' => 'success', 'response' => 'Message sent successfully.'));
            return $finalResult;
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response' => 'Something went wrong.'));
            return $finalResult;
        }
    }

    public function update_delete_notifications(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == 'read_all') {
            $status = update_notifications('');
            $response = 'Updated successfully.';
        } elseif ($data['action'] == 'read_one') {
            $status = update_notifications($data['id']);
            $response = 'Deleted successfully.';
        } elseif ($data['action'] == 'delete_one') {
            $status = delete_notifications($data['id']);
            $response = 'Deleted successfully.';
        } elseif ($data['action'] == 'delete_all') {
            $status = delete_notifications('');
            $response = 'Deleted successfully.';
        }
        if ($status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => $response]);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function delete_user_chats(Request $request)
    {
        $data = $request->all();
        $query = DB::table('chatted_users');
        $query->where('id', $data['id']);
        $query->delete();
        $query = DB::table('chat');
        $query->where('chatted_id', $data['id']);
        $query->delete();
        $finalResult = response()->json(array('msg' => 'success', 'response' => 'Chat successfully deleted.'));
        return $finalResult;
    }
}
