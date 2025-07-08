<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyChallenge;
use App\Models\Character;
use App\Models\Zone;
use App\Models\Mount;
use App\Models\Skill;
use App\Models\Quote;
use App\Models\Guess;
use Carbon\Carbon;

class GameController extends Controller
{
    public function show()
    {
        $today = Carbon::today();
        $user = Auth::user();
        $challenge = DailyChallenge::where('date', $today)->first();

        if (!$challenge) {
            return view('game.play', ['noChallenge' => true]);
        }

        $allCharacters = Character::orderBy('name')->get();
        $allZones = Zone::orderBy('name')->get();
        $allMounts = Mount::orderBy('name')->get();
        $allSkills = Skill::orderBy('name')->get();

        $allGuesses = Guess::where('user_id', $user->id)
            ->where('daily_challenge_id', $challenge->id)
            ->get();

        $getGuessesForType = function ($type) use ($allGuesses) {
            return $allGuesses->where('type', $type)->map(function ($guess) {
                if ($guess->type === 'quote') {
                    $modelClass = 'App\\Models\\Character';
                } else {
                    $modelClass = 'App\\Models\\' . ucfirst($guess->type);
                }
                if (class_exists($modelClass)) {
                    $guess->details = $modelClass::find($guess->guess_id);
                }
                return $guess;
            });
        };

        $guesses = [
            'character' => $getGuessesForType('character'),
            'zone' => $getGuessesForType('zone'),
            'mount' => $getGuessesForType('mount'),
            'skill' => $getGuessesForType('skill'),
            'quote' => $getGuessesForType('quote'),
        ];

        $hasGuessedCorrectly = [
            'character' => $guesses['character']->contains('is_correct', true),
            'zone' => $guesses['zone']->contains('is_correct', true),
            'mount' => $guesses['mount']->contains('is_correct', true),
            'skill' => $guesses['skill']->contains('is_correct', true),
            'quote' => $guesses['quote']->contains('is_correct', true),
        ];

        $guessedIds = [
            'character' => $guesses['character']->pluck('guess_id')->toArray(),
            'zone' => $guesses['zone']->pluck('guess_id')->toArray(),
            'mount' => $guesses['mount']->pluck('guess_id')->toArray(),
            'skill' => $guesses['skill']->pluck('guess_id')->toArray(),
            'quote' => $guesses['quote']->pluck('guess_id')->toArray(),
        ];

        return view('game.play', compact(
            'challenge', 'guesses', 'hasGuessedCorrectly', 'guessedIds',
            'allCharacters', 'allZones', 'allMounts', 'allSkills'
        ));
    }

    private function recordGuess($type, $guessId, $isCorrect)
    {
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        $user = Auth::user();

        $existingGuess = Guess::where('user_id', $user->id)
            ->where('daily_challenge_id', $challenge->id)
            ->where('type', $type)
            ->where('guess_id', $guessId)
            ->exists();
        
        if ($existingGuess) {
            return;
        }

        Guess::create([
            'user_id' => $user->id,
            'daily_challenge_id' => $challenge->id,
            'type' => $type,
            'guess_id' => $guessId,
            'is_correct' => $isCorrect,
        ]);
    }

    public function guessCharacter(Request $request)
    {
        $request->validate(['character_id' => 'required|exists:characters,id']);
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        $isCorrect = ($challenge->character_id == $request->character_id);
        $this->recordGuess('character', $request->character_id, $isCorrect);

        $feedback = [
            'type' => 'character',
            'status' => $isCorrect ? 'success' : 'error',
            'message' => $isCorrect ? 'Parabéns! Você acertou o personagem!' : 'Palpite incorreto.'
        ];
        return redirect(route('game.play') . '#character')->with('feedback', $feedback);
    }

    public function guessZone(Request $request)
    {
        $request->validate(['zone_id' => 'required|exists:zones,id']);
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        $isCorrect = ($challenge->zone_id == $request->zone_id);
        $this->recordGuess('zone', $request->zone_id, $isCorrect);

        $feedback = [
            'type' => 'zone',
            'status' => $isCorrect ? 'success' : 'error',
            'message' => $isCorrect ? 'Parabéns! Você acertou a zona!' : 'Palpite incorreto.'
        ];
        return redirect(route('game.play') . '#zone')->with('feedback', $feedback);
    }

    public function guessMount(Request $request)
    {
        $request->validate(['mount_id' => 'required|exists:mounts,id']);
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        $isCorrect = ($challenge->mount_id == $request->mount_id);
        $this->recordGuess('mount', $request->mount_id, $isCorrect);

        $feedback = [
            'type' => 'mount',
            'status' => $isCorrect ? 'success' : 'error',
            'message' => $isCorrect ? 'Parabéns! Você acertou a montaria!' : 'Palpite incorreto.'
        ];
        return redirect(route('game.play') . '#mount')->with('feedback', $feedback);
    }

    public function guessSkill(Request $request)
    {
        $request->validate(['skill_id' => 'required|exists:skills,id']);
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        $isCorrect = ($challenge->skill_id == $request->skill_id);
        $this->recordGuess('skill', $request->skill_id, $isCorrect);

        $feedback = [
            'type' => 'skill',
            'status' => $isCorrect ? 'success' : 'error',
            'message' => $isCorrect ? 'Parabéns! Você acertou a habilidade!' : 'Palpite incorreto.'
        ];
        return redirect(route('game.play') . '#skill')->with('feedback', $feedback);
    }

    public function guessQuote(Request $request)
    {
        $request->validate(['character_id' => 'required|exists:characters,id']);
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        $isCorrect = ($challenge->quote->character_id == $request->character_id);
        $this->recordGuess('quote', $request->character_id, $isCorrect);

        $feedback = [
            'type' => 'quote',
            'status' => $isCorrect ? 'success' : 'error',
            'message' => $isCorrect ? 'Parabéns! Você acertou quem disse a citação!' : 'Palpite incorreto.'
        ];
        return redirect(route('game.play') . '#quote')->with('feedback', $feedback);
    }
}
