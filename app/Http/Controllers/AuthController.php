<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:250',
            'username' => 'required|string|min:5|max:16|unique:users,username',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8'
        ]);
        $data['password'] = Hash::make($request->password);

        User::create($data);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Register Successfully!'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $remember = $request->has('remember');

        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password], $remember)) {
            $notification = array(
                'alert-type' => 'success',
                'message' => 'Login Successfully!'
            );
            return redirect()->route('dashboard')->with($notification);
        } else {
            $notification = array(
                'alert-type' => 'error',
                'message' => 'Login Failed!'
            );
            return redirect()->route('login')
                ->with($notification);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showChange()
    {
        return view('pages.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        $errorNotif = [
            'alert-type' => 'error',
            'message' => 'Current password is incorrect!',
        ];
        // Passwoed Matches
        if (!Hash::check($request->get('current_password'), $user->password)) {
            return  redirect()->back()->with($errorNotif);
        }

        // Current Password and New Password
        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            return redirect()->back()->with(['alert-type' => 'error', 'message' => 'New Password cannot be same with Current Password!']);
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with(['alert-type' => 'success', 'message' => 'Password Changed Successfully!']);
    }
}
