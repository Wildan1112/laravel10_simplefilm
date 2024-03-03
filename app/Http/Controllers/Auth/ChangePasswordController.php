<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('pages.profile.change-password');
    }

    public function update(Request $request)
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
