<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash, Session, Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('register');
    }

    public function store_new_users(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'financial_support' => 'required',
            'interested_in' => 'required',
            'email' => 'required|email|unique:users',
        ],
        [
            'financial_support.required'=> 'Select financial support field.',
            'interested_in.required'=> 'Select your interested.',
            'email.unique'=> 'This email address already registered.',
        ]);
        if ($validator->fails()) {
            $finalResult = response()->json(array('msg' => 'lvl_error', 'response'=>$validator->errors()->all()));
            return $finalResult;
        }

        if($data['financial_support'] == '1' && $data['interested_in'] == '1'){
            $data['iam'] = 'Sugar Mommy';
            $data['iam_interested_in'] = 'Sugar Baby (Hombre / Man)';
        }else if($data['financial_support'] == '1' && $data['interested_in'] == '2'){
            $data['iam'] = 'Sugar Daddy';
            $data['iam_interested_in'] = 'Sugar Baby (Mujer / Woman)';
        }else if($data['financial_support'] == '1' && $data['interested_in'] == '3'){
            $data['iam'] = 'Sugar Daddy Mommy';
            $data['iam_interested_in'] = 'Sugar Baby (Trans)';
        }else if($data['financial_support'] == '2' && $data['interested_in'] == '1'){
            $data['iam'] = 'Sugar Baby (Mujer / Woman)';
            $data['iam_interested_in'] = 'Sugar Daddy';
        }else if($data['financial_support'] == '2' && $data['interested_in'] == '2'){
            $data['iam'] = 'Sugar Baby (Hombre / Man)';
            $data['iam_interested_in'] = 'Sugar Mommy';
        }else if($data['financial_support'] == '2' && $data['interested_in'] == '3'){
            $data['iam'] = 'Sugar Baby (Trans)';
            $data['iam_interested_in'] = 'Sugar Daddy Mommy';
        }else{
            $data['iam'] = 'Sugar Daddy';
            $data['iam_interested_in'] = 'Sugar Baby (Mujer / Woman)';
        }

        $data['password'] = rand(10000000, 99999999);

        $prefix = strstr($data['email'], '@', true);
        $data['unique_id'] = uniqid($prefix);

        $status = User::create([
            'username' => $prefix,
            'unique_id' => $data['unique_id'],
            'iam' => $data['iam'],
            'interestedin' => $data['iam_interested_in'],
            'financial_support' => $data['financial_support'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        if($status->id > 0) {
            $this->send_user_credential_email($data);
            $finalResult = response()->json(array('msg' => 'success', 'response_head'=>'Check Your Inbox!', 'response'=>'Your account has been successfully created, Please check your index and follow the instruction.'));
            return $finalResult;
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response'=>'Something went wrong.'));
            return $finalResult;
        }
    }

    public function send_user_credential_email($data)
    {
        $to = $data['email'];
        $subject = get_section_content('project', 'site_title') .'(New Registration)';
        $email_body = view('emails/credential_email', compact("data"));
        $body = $email_body;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.get_section_content('project', 'noreply_email').'>' . "\r\n";
        @mail($to, $subject, $body, $headers);
        return true;
    }
}
