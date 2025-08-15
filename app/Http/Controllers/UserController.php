<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        $request->user()->update($data);

        return redirect()->route('profile.show')->with('success', __('Profile updated successfully.'));
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($data['current_password'], $request->user()->password)) {
            return back()->withErrors(['current_password' => __('Current password is incorrect.')]);
        }

        $request->user()->update([
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('profile.show')->with('success', __('Password updated successfully.'));
    }
}
