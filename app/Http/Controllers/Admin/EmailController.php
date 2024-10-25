<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MassEmail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        $query = Email::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('title', 'like', '%' . $search_query . '%');
            });
        }
        $data['emails'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/emails/emails', $data);
    }

    public function create()
    {
        return view('admin/emails/create');
    }

    public function dispatch_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['msg' => 'lvl_error', 'response' => $validator->errors()->all()]);
        }
        $title = $request->title;
        $body = $request->body;
        $email = new Email();
        $email->title = $title;
        $email->body = $body;
        $email->save();
        $allUsers = User::all();
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.get_section_content('project', 'noreply_email').'>' . "\r\n";
        $subject = $title;
        $emailTemplate = view('emails.template', compact(['title', 'body']))->render();
        foreach ($allUsers as $user) {
            $sendMail = mail($user->email, $subject, $emailTemplate, $headers);
            if(!$sendMail){
                $email->status = 2;
                $email->save();
                return response()->json(['msg' => 'error', 'response' => 'Email sending failed in process.']);
            }
        }
        $email->status = 1;
        $email->save();
        return response()->json(['msg' => 'success', 'response' => 'Email sent successfully']);
    }

    public function show($id)
    {
        $email = Email::where('id', $id)->first();
        if (!empty($email)) {
            return view('admin.emails.show_email', compact('email'));
        } else {
            return redirect()->route('admin.emails.emails')->with('error', 'Email not found');
        }
    }
}
