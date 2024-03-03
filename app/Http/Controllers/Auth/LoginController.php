<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $remember = $request->has('remember');

        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password], $remember)) {
            $success = array(
                'alert-type' => 'success',
                'message' => 'Login Successfully!'
            );
            return redirect()->route('dashboard')->with($success);
        } else {
            $error = array(
                'alert-type' => 'error',
                'message' => 'Login Failed!'
            );
            return redirect()->back()->with($error);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
