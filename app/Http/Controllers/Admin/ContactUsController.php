<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\ContactUsMsgs;
use Session, Validator, DB;

class ContactUsController extends Controller
{
	public function index()
	{
		$data['contactus_msgs'] = ContactUsMsgs::get();
		return view('admin/contacts_us/contacts_us', $data);
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
		$data = $request->all();

		$response_status = ContactUsMsgs::find($data['id'])->delete();

		if($response_status > 0) {
			return response()->json(['msg' => 'success', 'response'=>'Message successfully deleted.']);
		} else {
			return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		}
	}
}