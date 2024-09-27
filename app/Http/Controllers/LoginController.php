<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash, Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login');
    }

    public function verify_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $isactive = Auth::user()->status;
            if($isactive == 1) {
                add_login_logs(Auth::user()->id);
                return redirect('home');
            } else if($isactive == 2) {
                Auth::logout();
                Session::flush();
                return redirect("login")->withErrors('You are temporarily blocked. Please contact to admin!.');
            } else if($isactive == 3) {
                Auth::logout();
                Session::flush();
                return redirect("login")->withErrors('Your account has been deleted. If you want to recover your account, please contact to admin immediately!.');
            }
        } else {
            return redirect("login")->withErrors('Invalid email or password!.');
        }
    }

    public function logout() {
        update_login_logs(Auth::user()->id);
        Session::flush();
        Auth::logout();
        return redirect('home');
    }

}
