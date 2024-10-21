<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\ContactUsMsgs;
use Session, Validator, DB;

class ContactUsController extends Controller
{

	public function index(Request $request)
	{
		$query = ContactUsMsgs::query();
		$search_query = $request->input('search_query');
		if ($request->has('search_query') && !empty($search_query)) {
			$query->where(function ($query) use ($search_query) {
				$query->where('name', 'like', '%' . $search_query . '%')
				->orWhere('email', 'like', '%' . $search_query . '%');
			});
		}
		$data['contactus_msgs'] = $query->orderBy('id', 'DESC')->paginate(50);
		$data['searchParams'] = $request->all();
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