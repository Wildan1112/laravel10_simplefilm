<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
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
            'message' => 'Registration Successfully!'
        );
        return redirect()->route('dashboard')->with($notification);
    }
}
