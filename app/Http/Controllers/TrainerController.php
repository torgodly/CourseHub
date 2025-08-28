<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function submitApplication(Request $request)
    {
        $data = $request->validate([
            'qualification' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'resume' => 'required|file|mimes:pdf|max:2048',
            'avatar' => 'required|file|image|max:2048',
        ]);

        // For now, just dump the validated data\
        //update user and user type to trainer
        $user = $request->user();
        $user->qualification = $data['qualification'];
        $user->profession = $data['profession'];
        $user->type = 'trainer';
        if ($request->hasFile('resume')) {
            $user->resume = $request->file('resume')->store('resumes', 'public');
        }
        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }
        $user->save();
        return redirect('trainer')->with('status', 'application-submitted');
    }

    public function showForm()
    {
        // This method is for showing a dedicated application form page, which is not what the user asked for.
        // The user wants a modal on the profile page.
        // I will leave this empty for now.
    }
}
