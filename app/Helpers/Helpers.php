<?php

use App\Models\PhotoChangeLog;
use App\Models\ProfileChangeLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('admin_url')) {
	function admin_url()
	{
		return url('admin');
	}
}

if (!function_exists('formated_date')) {
	function formated_date($datee)
	{
		return date("d/m/Y", strtotime($datee));
	}
}
if (!function_exists('date_formated')) {
	function date_formated($datee)
	{
		return date("d-m-Y", strtotime($datee));
	}
}
if (!function_exists('date_with_month')) {
	function date_with_month($datee)
	{
		return date("F d, Y", strtotime($datee));
	}
}
if (!function_exists('db_date')) {
	function db_date($datee)
	{
		return date("Y-m-d", strtotime($datee));
	}
}
if (!function_exists('js_date_formate')) {
	function js_date_formate()
	{
		return "dd/mm/yyyy";
	}
}
if (!function_exists('date_time')) {
	function date_time($time)
	{
		return $newDateTime = formated_date($time) . " " . date('h:i A', strtotime($time));
	}
}

if (!function_exists('month_date_time')) {
	function month_date_time($time)
	{
		return $newDateTime = date_with_month($time) . " " . date('h:i A', strtotime($time));
	}
}

if (!function_exists('get_complete_table')) {
	function get_complete_table($table = '', $primary_key = '', $where_value = '', $type = '', $status = '', $orderby = '', $sorted = '')
	{
		$query = DB::table($table);
		if ($primary_key) {
			$query->where($primary_key, $where_value);
		}
		if ($type) {
			$query->where('type', $type);
		}
		if ($status) {
			$query->where('status', $status);
		}
		if ($sorted) {
			$query->orderBy($orderby, $sorted);
		} else {
			$query->orderBy('id', 'DESC');
		}
		$data = $query->get();
		return $data;
	}
}

if (!function_exists('get_single_value')) {
	function get_single_value($table, $value, $id)
	{
		$query = DB::table($table)
			->select($value)
			->where('id', $id)
			->first();
		return $query->$value;
	}
}

if (!function_exists('get_section_content')) {
	function get_section_content($meta_tag, $meta_key)
	{
		$query = DB::table('settings')
			->select('meta_value')
			->where('meta_tag', $meta_tag)
			->where('meta_key', $meta_key)
			->first();
		return $query->meta_value;
	}
}

if (! function_exists('permanently_deleted')) {
	function permanently_deleted($table, $primary_key, $where_id)
	{
		$query = DB::table($table)->where($primary_key, $where_id)->delete();
		return true;
	}
}

if (! function_exists('softly_deleted')) {
	function softly_deleted($table, $primary_key, $where_id, $set_column, $value)
	{
		$query = DB::table($table)
			->where($primary_key, $where_id)
			->update([
				$set_column => $value
			]);
		// return $query;
		return true;
	}
}

if (!function_exists('count_table_records')) {
	function count_table_records($table, $status = '')
	{
		$query = DB::table($table);
		if ($status) {
			$query->where('status', $status);
		}
		return $query->count();
	}
}

if (!function_exists('check_record_existing')) {
	function check_record_existing($table, $primary_key, $where_id, $primary_key2 = '', $where_id2 = '', $type = '', $type_value = '', $date_column = '', $date_value = '')
	{
		$query = DB::table($table);
		$query->where($primary_key, $where_id);
		if ($primary_key2) {
			$query->where($primary_key2, $where_id2);
		}
		if ($type) {
			$query->where($type, $type_value);
		}
		if ($date_column) {
			$query->whereDate($date_column, $date_value);
		}
		return $query->count();
	}
}

if (!function_exists('get_single_row')) {
	function get_single_row($table, $primary_key, $where_id, $primary_key2 = '', $where_id2 = '', $type = '', $type_value = '')
	{
		$query = DB::table($table);
		$query->where($primary_key, $where_id);
		if ($primary_key2) {
			$query->where($primary_key2, $where_id2);
		}
		if ($type) {
			$query->where($type, $type_value);
		}
		$query->orderBy('id', 'DESC');
		$data = $query->first();
		return $data;
	}
}

if (!function_exists('get_photos')) {
	function get_photos($table, $user_id, $type, $status)
	{
		$query = DB::table($table);
		$query->where('user_id', $user_id);
		$query->where('type', $type);
		$query->whereIn('status', $status);
		$query->orderBy('id', 'DESC');
		$data = $query->get();
		return $data;
	}
}

if (! function_exists('add_login_logs')) {
	function add_login_logs($id)
	{
		DB::table('user_login_logs')->insertGetId([
			'user_id' => $id,
			'ip' => request()->ip(),
			'login_time' => date('Y-m-d H:i:s'),
			'created_at' => date('Y-m-d H:i:s')
		]);

		$query = DB::table('users')
			->where('id', $id)
			->update([
				'last_login' => date('Y-m-d H:i:s')
			]);
		return true;
	}
}

if (! function_exists('update_login_logs')) {
	function update_login_logs($id)
	{
		$last_id = DB::table('user_login_logs')->where('user_id', $id)->orderBy('id', 'DESC')->first();

		$query = DB::table('user_login_logs')
			->where('id', $last_id->id)
			->update([
				'logout_time' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			]);
		return true;
	}
}

if (! function_exists('time_elapsed_string')) {
	function time_elapsed_string($datetime, $full = false)
	{
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}

if (! function_exists('add_user_configuration')) {
	function add_user_configuration($user_id, $config_user_id, $type, $desc = '', $image = '', $status = '', $requested_id = '')
	{
		if ($requested_id) {
			$query = DB::table('user_configs')
				->where('id', $requested_id)->update([
					'status' => 2
				]);
		} else {
			DB::table('user_configs')->insertGetId([
				'user_id' => $user_id,
				'config_user_id' => $config_user_id,
				'type' => $type,
				'description' => $desc,
				'image' => $image,
				'status' => $status,
				'created_at' => date('Y-m-d H:i:s')
			]);
		}
		return true;
	}
}

if (! function_exists('remove_user_configuration')) {
	function remove_user_configuration($user_id, $config_user_id, $type)
	{
		DB::table('user_configs')
			->where('user_id', $user_id)
			->where('config_user_id', $config_user_id)
			->where('type', $type)
			->delete();
		return true;
	}
}


if (! function_exists('like_photos')) {
	function like_photos($user_id, $photo_user_id, $photo_id)
	{
		DB::table('like_images')->insertGetId([
			'user_id' => $user_id,
			'photo_user_id' => $photo_user_id,
			'photo_id' => $photo_id,
			'created_at' => date('Y-m-d H:i:s')
		]);
		return true;
	}
}

if (! function_exists('unlike_photos')) {
	function unlike_photos($user_id, $photo_user_id, $photo_id)
	{
		DB::table('like_images')
			->where('user_id', $user_id)
			->where('photo_id', $photo_id)
			->delete();
		return true;
	}
}

if (! function_exists('update_user_privacy_settings')) {
	function update_user_privacy_settings($column, $value)
	{
		$query = DB::table('users')
			->where('id', Auth::user()->id)
			->update([
				$column => $value
			]);
		return true;
	}
}

if (! function_exists('age')) {
	function age($dateOfBirth)
	{
		return $years = Carbon::parse($dateOfBirth)->age;
	}
}

if (! function_exists('create_slug')) {
	function create_slug($table, $title, $id = '')
	{
		$slug = Str::slug($title);
		$query = DB::table($table);
		$query->where('slug', $slug);
		if ($id) {
			$query->where('id', '!=', $id);
		}
		$count = $query->count();
		if ($count > 0) {
			$slug_name = $slug . '-' . time();
		} else {
			$slug_name = $slug;
		}
		return $slug_name;
	}
}


if (! function_exists('add_notifications')) {
	function add_notifications($user_id, $notify_user_id, $message, $type)
	{
		DB::table('notifications')->insertGetId([
			'user_id' => $user_id,
			'notify_user_id' => $notify_user_id,
			'message' => $message,
			'type' => $type,
			'created_at' => date('Y-m-d H:i:s')
		]);
		return true;
	}
}
if (! function_exists('update_notifications')) {
	function update_notifications($id = '')
	{
		$query = DB::table('notifications');
		$query->where('notify_user_id', Auth::user()->id);
		$query->where('status', '1');
		if ($id) {
			$query->where('id', $id);
		}
		$query->update([
			'status' => 2,
			'updated_at' => date('Y-m-d H:i:s')
		]);
		return true;
	}
}
if (! function_exists('delete_notifications')) {
	function delete_notifications($id = '')
	{
		$query = DB::table('notifications');
		$query->where('notify_user_id', Auth::user()->id);
		if ($id) {
			$query->where('id', $id);
		} else {
			$query->where('status', '2');
		}
		$query->delete();
		return true;
	}
}

if (! function_exists('get_random_posts')) {
	function get_random_posts($offset, $limit)
	{
		$query = DB::table('posts');
		$query->where('status', '1');
		$query->skip($offset)->take($limit);
		$data = $query->get();
		return $data;
	}
}

if (! function_exists('get_next_post')) {
	function get_next_post($url)
	{
		$query = DB::table('posts');
		$query->where('status', '1');
		$query->skip($offset)->take($limit);
		$data = $query->get();
		return $data;
	}
}
if (! function_exists('is_profile_approval_pending')) {
	function is_profile_approval_pending($user_id)
	{
		$query = ProfileChangeLog::where('user_id', $user_id)->where('status', 0)->count();
		if ($query > 0) {
			return true;
		} else {
			return false;
		}
	}
}
if (! function_exists('is_profile_image_approval_pending')) {
	function is_profile_image_approval_pending($user_id)
	{
		$query = PhotoChangeLog::where('user_id', $user_id)->where('type', 0)->where('status', 0)->count();
		if ($query > 0) {
			return true;
		} else {
			return false;
		}
	}
}


if (! function_exists('is_profile_approval_declined')) {
	function is_profile_approval_declined($user_id)
	{
		// fetch last profile change log
		$last_profile_change_log = ProfileChangeLog::where('user_id', $user_id)->orderBy('id', 'DESC')->first();
		if ($last_profile_change_log) {
			if ($last_profile_change_log->status == 2) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
if (! function_exists('is_profile_image_approval_declined')) {
	function is_profile_image_approval_declined($user_id)
	{
		// fetch last profile change log
		$last_profile_change_log = PhotoChangeLog::where('user_id', $user_id)->where('type', 0)->orderBy('id', 'DESC')->first();
		if ($last_profile_change_log) {
			if ($last_profile_change_log->status == 2) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
if (! function_exists('map_gender')) {
	function map_gender($value)
	{
		switch ($value) {
			case 1:
				return 'Male';
				break;
			case 2:
				return 'Female';
				break;
			case 3:
				return 'Transgender';
				break;
			default:
				return 'Not Specified';
				break;
		}
	}
}
if (! function_exists('map_marital_status')) {
	function map_marital_status($value)
	{
		switch ($value) {
			case 1:
				return 'Single';
				break;
			case 2:
				return 'Married';
				break;
			case 3:
				return 'Widowed';
				break;
			case 4:
				return 'Divorced';
				break;
			default:
				return 'Not Specified';
				break;
		}
	}
}
if (! function_exists('map_body')) {
	function map_body($value)
	{
		switch ($value) {
			case 1:
				return 'Skinny';
				break;
			case 2:
				return 'Thin';
				break;
			case 3:
				return 'Median';
				break;
			case 4:
				return 'Athletic';
				break;
			case 5:
				return 'Curvilinear';
				break;
			case 6:
				return 'Full Height ';
				break;
			default:
				return 'Not Specified';
				break;
		}
	}
}

if (! function_exists('send_notification_email')) {
	function send_notification_email($user, $email_subject, $email_text)
	{
		$to = $user['email'];
		$subject = $email_subject;
		$user['inner_text'] = $email_text;
		$email_body = view('emails/notification_emails', compact("user"));
		$body = $email_body;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <' . get_section_content('project', 'noreply_email') . '>' . "\r\n";
		@mail($to, $subject, $body, $headers);
		return true;
	}
}

if (! function_exists('trial_checker')) {
	function trial_checker()
	{
		// check if user ever subscribed to membership by checking membership_logs table
		$membership_logs = DB::table('membership_logs')
			->where('user_id', Auth::user()->id)
			->count();
		if ($membership_logs > 0) {
			// check if user is currently subscribed to membership
			$membership_logs = DB::table('membership_logs')
				->where('user_id', Auth::user()->id)
				->where('membership_end', '>=', date('Y-m-d'))
				->count();

			if ($membership_logs > 0) {
				// user is currently subscribed to membership
				return [
					'status' => 0,
					'message' => 'You are currently subscribed to membership plan'
				];
			} else {
				return [
					'status' => 1,
					'message' => 'Your membership plan expired on ' . date('d-m-Y', strtotime(Auth::user()->membership_end))
				];
			}
		} else {
			$trialExpiresOn = Carbon::parse(Auth::user()->trial_expires_on); // Assume this is in UTC
			$serverTimezone = date_default_timezone_get(); // Get server timezone

			// Get current time in the server's timezone
			$now = Carbon::now()->setTimezone($serverTimezone);

			// Check if the trial is still active
			if ($trialExpiresOn->isFuture()) {
				// Calculate the remaining time
				$remainingTime = $trialExpiresOn->diff($now);

				// Extract hours and minutes from the DateInterval object
				$hours = $remainingTime->h + ($remainingTime->d * 24); // Add days * 24 to account for total hours
				$minutes = $remainingTime->i;

				return [
					'status' => 2,
					'message' => sprintf(
						'You are using a free trial. Your trial will expire in %d hour%s and %d minute%s.',
						$hours,
						$hours !== 1 ? 's' : '',
						$minutes,
						$minutes !== 1 ? 's' : ''
					),
				];
			} else {
				return [
					'status' => 3,
					'message' => sprintf(
						'Your trial period expired on %s.',
						$trialExpiresOn->format('d-m-Y')
					),
				];
			}
		}
	}
}
if (! function_exists('is_profile_incomplete')) {
	function is_profile_incomplete(): bool
	{
		$user = Auth::user();

		$fieldsToCheck = [
			'first_name',
			'last_name',
			'username',
			'financial_support',
			'dob',
			'height',
			'weight',
			'body_type',
			'child',
			'city',
			'state',
			'zipcode',
			'country',
			'address',
			'gender',
			'marital_status',
			'about_me'
		];

		foreach ($fieldsToCheck as $field) {
			if (is_null($user->$field)) {
				return true;
			}
		}

		return false;
	}
}
