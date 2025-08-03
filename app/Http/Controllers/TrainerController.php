<?php

namespace App\Http\Controllers;

use Cassandra\Type\UserType;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    /**
     * Show the trainer application form.
     */
    public function showForm()
    {
        return view('trainer.apply');
    }

    /**
     * Handle trainer application submission.
     */
    public function submitApplication(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048',
            'qualification' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:4096',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $data['type'] = 'trainer';

        $user->update($data);

        return redirect()->route(Filament::getPanel('trainer')->getUrl());
    }
}
