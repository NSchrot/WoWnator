<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Guess;

class ProfileController extends Controller
{
    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        
        $user->fill($request->validated());

        
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function history(): View
    {
        $user = Auth::user();
        $guesses = Guess::where('user_id', $user->id)
            ->with(['dailyChallenge.character', 'dailyChallenge.zone', 'dailyChallenge.mount', 'dailyChallenge.skill', 'dailyChallenge.quote.character'])
            ->orderByDesc('created_at')
            ->get();
        
        $guesses->each(function ($guess) {
            $modelClass = match($guess->type) {
                'quote', 'character' => \App\Models\Character::class,
                'zone' => \App\Models\Zone::class,
                'mount' => \App\Models\Mount::class,
                'skill' => \App\Models\Skill::class,
                default => null,
            };
            if ($modelClass && class_exists($modelClass)) {
                $guess->details = $modelClass::find($guess->guess_id);
            }
        });

        $groupedGuesses = $guesses->filter(fn($guess) => $guess->dailyChallenge !== null)
            ->groupBy(fn($guess) => $guess->dailyChallenge->date->format('Y-m-d'))
            ->sortKeysDesc();

        return view('profile.history', ['groupedGuesses' => $groupedGuesses]);
    }
}

