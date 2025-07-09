<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\DailyChallenge;
use App\Models\Guess;
use App\Models\Mount;
use App\Models\Quote;
use App\Models\Skill;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GameController extends Controller
{
    public function show(): View
    {
        $today = Carbon::today();
        $user = Auth::user();
        $challenge = DailyChallenge::where('date', $today)->first();

        if (!$challenge) {
            return view('game.play', ['noChallenge' => true]);
        }

        $allCharacters = Character::orderBy('name')->get(['id', 'name', 'image_url']);
        $allZones = Zone::orderBy('name')->get(['id', 'name', 'image_url']);
        $allMounts = Mount::orderBy('name')->get(['id', 'name', 'image_url', 'icon_url']);
        $allSkills = Skill::orderBy('name')->get(['id', 'name', 'image_url']);

        $allGuesses = Guess::where('user_id', $user->id)
            ->where('daily_challenge_id', $challenge->id)
            ->get();

        $getGuessesForType = function ($type) use ($allGuesses) {
            return $allGuesses->where('type', '===', $type)->map(function ($guess) {
                
                $modelClass = $guess->type === 'quote' 
                    ? 'App\\Models\\Character' 
                    : 'App\\Models\\' . ucfirst($guess->type);
                
                if (class_exists($modelClass)) {
                    $guess->details = $modelClass::find($guess->guess_id);
                }
                return $guess;
            });
        };

        $guesses = [];
        $hasGuessedCorrectly = [];
        $guessedIds = [];
        $types = ['character', 'zone', 'mount', 'skill', 'quote'];

        foreach ($types as $type) {
            $guesses[$type] = $getGuessesForType($type);
            $hasGuessedCorrectly[$type] = $guesses[$type]->contains('is_correct', true);
            $guessedIds[$type] = $guesses[$type]->pluck('guess_id')->toArray();
        }

        return view('game.play', compact(
            'challenge', 'guesses', 'hasGuessedCorrectly', 'guessedIds',
            'allCharacters', 'allZones', 'allMounts', 'allSkills'
        ));
    }

    private function handleGuess(Request $request, string $type, string $guessField, string $relationship): RedirectResponse
            {
                $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
                $user = Auth::user();
        
                $existingGuesses = Guess::where('user_id', $user->id)
                    ->where('daily_challenge_id', $challenge->id)
                    ->where('type', $type)
                    ->get();
        
                if ($existingGuesses->contains('is_correct', true)) {
                    return back()->with('feedback', ['type' => $type, 'status' => 'error', 'message' => 'Você já acertou este desafio!']);
                }
                
                if ($existingGuesses->count() >= 15) {
                    return back()->with('feedback', ['type' => $type, 'status' => 'error', 'message' => 'Você já usou todas as suas 15 tentativas!']);
                }
        
                $guessedId = $request->input($guessField);
                $correctId = $challenge->$relationship->id;
                $isCorrect = ($guessedId == $correctId);
        
                Guess::create([
                    'user_id' => $user->id,
                    'daily_challenge_id' => $challenge->id,
                    'type' => $type,
                    'guess_id' => $guessedId,
                    'is_correct' => $isCorrect,
                ]);
        
                if ($isCorrect) {
                    $this->updateUserRating($user, $existingGuesses->count() + 1);
        
                    
                    $correctGuessesCount = Guess::where('user_id', $user->id)
                        ->where('daily_challenge_id', $challenge->id)
                        ->where('is_correct', true)
                        ->distinct('type')
                        ->count();
        
                    if ($correctGuessesCount >= 5) {
                        return redirect()->route('dashboard')->with('status', 'Parabéns! Você completou todos os desafios de hoje!');
                    }
                }
        
                $tab = $request->input('tab', $type);
                return back()->with('feedback', [
                    'type' => $type,
                    'status' => $isCorrect ? 'success' : 'error',
                    'message' => $isCorrect ? 'Correto!' : 'Incorreto, tente novamente.'
                ])->withFragment($tab);
            }
        
            public function guessQuote(Request $request): RedirectResponse
            {
                $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
                $user = Auth::user();
        
                $existingGuesses = Guess::where('user_id', $user->id)
                    ->where('daily_challenge_id', $challenge->id)
                    ->where('type', 'quote')
                    ->get();
        
                if ($existingGuesses->contains('is_correct', true)) {
                    return back()->with('feedback', ['type' => 'quote', 'status' => 'error', 'message' => 'Você já acertou este desafio!']);
                }
        
                if ($existingGuesses->count() >= 15) {
                    return back()->with('feedback', ['type' => 'quote', 'status' => 'error', 'message' => 'Você já usou todas as suas 15 tentativas!']);
                }
        
                $guessedId = $request->input('character_id');
                $correctId = $challenge->quote->character_id;
                $isCorrect = ($guessedId == $correctId);
        
                Guess::create([
                    'user_id' => $user->id,
                    'daily_challenge_id' => $challenge->id,
                    'type' => 'quote',
                    'guess_id' => $guessedId,
                    'is_correct' => $isCorrect,
                ]);
        
                if ($isCorrect) {
                    $this->updateUserRating($user, $existingGuesses->count() + 1);
        
                    
                    $correctGuessesCount = Guess::where('user_id', $user->id)
                        ->where('daily_challenge_id', $challenge->id)
                        ->where('is_correct', true)
                        ->distinct('type')
                        ->count();
        
                    if ($correctGuessesCount >= 5) {
                        return redirect()->route('dashboard')->with('status', 'Parabéns! Você completou todos os desafios de hoje!');
                    }
                }
                
                $tab = $request->input('tab', 'quote');
                return back()->with('feedback', [
                    'type' => 'quote',
                    'status' => $isCorrect ? 'success' : 'error',
                    'message' => $isCorrect ? 'Correto!' : 'Incorreto, tente novamente.'
                ])->withFragment($tab);
            }

    
    private function updateUserRating(User $user, int $attempts): void
    {
        $points = 100 + ((15 - $attempts) * 10);
        $user->increment('rating', $points);
    }

    
    public function guessCharacter(Request $request): RedirectResponse
    {
        return $this->handleGuess($request, 'character', 'character_id', 'character');
    }

    public function guessZone(Request $request): RedirectResponse
    {
        return $this->handleGuess($request, 'zone', 'zone_id', 'zone');
    }

    public function guessMount(Request $request): RedirectResponse
    {
        return $this->handleGuess($request, 'mount', 'mount_id', 'mount');
    }

    public function guessSkill(Request $request): RedirectResponse
    {
        return $this->handleGuess($request, 'skill', 'skill_id', 'skill');
    }
}