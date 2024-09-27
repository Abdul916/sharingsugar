<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\Users;
use Session, Validator, DB;

class MembershipsController extends Controller
{
	public function index()
	{
		return view('admin/memberships/memberships');
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