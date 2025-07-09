<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guess; 
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderByDesc('rating')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    
    public function show(User $user)
    {
        
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

        return view('admin.users.show', compact('user', 'groupedGuesses'));
    }
}