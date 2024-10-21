<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\MembershipLogs;
use Session, Validator, DB;

class MembershipsController extends Controller
{

	public function index(Request $request)
	{
		$query = MembershipLogs::query();
		$search_query = $request->input('search_query');
		$query->join('users', 'membership_logs.user_id', '=', 'users.id')
		->select('membership_logs.*' , 'users.first_name', 'users.last_name', 'users.username');
		if ($request->has('search_query') && !empty($search_query)) {
			$query->where(function ($query) use ($search_query) {
				$query->where('membership_logs.membership_type', 'like', '%' . $search_query . '%')
				->orWhere('users.first_name', 'like', '%' . $search_query . '%')
				->orWhere('users.last_name', 'like', '%' . $search_query . '%')
				->orWhere('users.username', 'like', '%' . $search_query . '%')
				->orWhere('users.email', 'like', '%' . $search_query . '%');
			});
		}
		$data['membership_logs'] = $query->orderBy('membership_logs.id', 'DESC')->paginate(50);
		$data['searchParams'] = $request->all();
		return view('admin/memberships/memberships', $data);
	}

	public function create()
	{
		//
	}

	public function store(Request $request)
	{
		//
	}

	public function edit(Request $request)
	{
		//
	}

	public function update(Request $request)
	{
		//
	}

	public function show()
	{
        //
	}

	public function destroy(Request $request)
	{
		// $data = $request->all();


		// $response_status = Post::find($data['id'])->delete();

		// if($response_status > 0) {
		// 	return response()->json(['msg' => 'success', 'response'=>'Post successfully deleted.']);
		// } else {
		// 	return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		// }
	}
}