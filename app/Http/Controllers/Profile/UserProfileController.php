<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Guess;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);
        
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('photo')) {
            if ($user->profile_photo_path) {
                
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('photo')->store('profile-photos', 'public');
        }

        $user->save();

        return back()->with('status', 'profile-updated');
    }

    public function history()
    {
        $user = Auth::user();
        $guesses = Guess::where('user_id', $user->id)
            ->with([
                'dailyChallenge.character', 
                'dailyChallenge.zone', 
                'dailyChallenge.mount', 
                'dailyChallenge.skill', 
                'dailyChallenge.quote.character'
            ])
            ->orderByDesc('created_at')
            ->get();

        $guesses->each(function ($guess) {
            $modelClass = match($guess->type) {
                'quote' => \App\Models\Character::class,
                'character' => \App\Models\Character::class,
                'zone' => \App\Models\Zone::class,
                'mount' => \App\Models\Mount::class,
                'skill' => \App\Models\Skill::class,
                default => null,
            };
            if ($modelClass && class_exists($modelClass)) {
                $guess->details = $modelClass::find($guess->guess_id);
            }
        });

        $groupedGuesses = $guesses->filter(function ($guess) {
            return $guess->dailyChallenge !== null;
        })->groupBy(function ($guess) {
            return $guess->dailyChallenge->date->format('Y-m-d');
        })->sortKeysDesc();

        return view('profile.history', [
            'groupedGuesses' => $groupedGuesses
        ]);
    }
}