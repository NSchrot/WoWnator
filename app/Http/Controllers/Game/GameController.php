<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\DailyChallenge;
use App\Models\Guess;
use App\Models\Mount;
use App\Models\Skill;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GameController extends Controller
{
    private const MAX_ATTEMPTS = 15;
    private const BASE_POINTS = 100;
    private const BONUS_PER_REMAINING_ATTEMPT = 10;
    private const TOTAL_CHALLENGE_TYPES = 5;

    private const GUESS_TYPES = ['character', 'zone', 'mount', 'skill', 'quote'];

    private const MODEL_MAP = [
        'character' => Character::class,
        'zone'      => Zone::class,
        'mount'     => Mount::class,
        'skill'     => Skill::class,
        'quote'     => Character::class,
    ];

    public function show(): View
    {
        $challenge = $this->getTodayChallenge();

        if (!$challenge) {
            return view('game.play', ['noChallenge' => true]);
        }

        $user = Auth::user();
        $allGuesses = $this->getUserGuessesForChallenge($user, $challenge);

        [$guesses, $hasGuessedCorrectly, $guessedIds] = $this->organizeGuessesByType($allGuesses);

        return view('game.play', [
            'challenge'           => $challenge,
            'guesses'             => $guesses,
            'hasGuessedCorrectly' => $hasGuessedCorrectly,
            'guessedIds'          => $guessedIds,
            'allCharacters'       => Character::orderBy('name')->get(['id', 'name', 'image_url']),
            'allZones'            => Zone::orderBy('name')->get(['id', 'name', 'image_url']),
            'allMounts'           => Mount::orderBy('name')->get(['id', 'name', 'image_url', 'icon_url']),
            'allSkills'           => Skill::orderBy('name')->get(['id', 'name', 'image_url']),
        ]);
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

    public function guessQuote(Request $request): RedirectResponse
    {
        return $this->handleGuess($request, 'quote', 'character_id', 'quote');
    }

    private function handleGuess(Request $request, string $type, string $guessField, string $relationship): RedirectResponse
    {
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        $user = Auth::user();
        $existingGuesses = $this->getUserGuessesForType($user, $challenge, $type);

        if ($existingGuesses->contains('is_correct', true)) {
            return $this->feedbackRedirect($type, 'error', 'Você já acertou este desafio!');
        }

        if ($existingGuesses->count() >= self::MAX_ATTEMPTS) {
            return $this->feedbackRedirect($type, 'error', 'Você já usou todas as suas ' . self::MAX_ATTEMPTS . ' tentativas!');
        }

        // Compara o chute do player com a resposta do desafio de hoje
        $guessedId = $request->input($guessField);
        $correctId = $this->getCorrectAnswerId($challenge, $type, $relationship);
        $isCorrect = ($guessedId == $correctId);

        $this->storeGuess($user, $challenge, $type, $guessedId, $isCorrect);

        if ($isCorrect) {
            // Quanto menos tentativas usou, mais pontos o player ganha
            $this->updateUserRating($user, $existingGuesses->count() + 1);

            // Quando acerta todos os 5 tipos de desafio do dia, redireciona pra dashboard
            if ($this->hasCompletedAllChallenges($user, $challenge)) {
                return redirect()->route('dashboard')
                    ->with('status', 'Parabéns! Você completou todos os desafios de hoje!');
            }
        }

        $tab     = $request->input('tab', $type);
        $status  = $isCorrect ? 'success' : 'error';
        $message = $isCorrect ? 'Correto!' : 'Incorreto, tente novamente.';

        return $this->feedbackRedirect($type, $status, $message, $tab);
    }

    private function getTodayChallenge(): ?DailyChallenge
    {
        return DailyChallenge::where('date', Carbon::today())->first();
    }

    private function getUserGuessesForChallenge(User $user, DailyChallenge $challenge): Collection
    {
        return Guess::where('user_id', $user->id)
            ->where('daily_challenge_id', $challenge->id)
            ->get();
    }

    private function getUserGuessesForType(User $user, DailyChallenge $challenge, string $type): Collection
    {
        return Guess::where('user_id', $user->id)
            ->where('daily_challenge_id', $challenge->id)
            ->where('type', $type)
            ->get();
    }

    /* Separa todos os palpites do jogador por tipo (character, zone, etc.) 
       e monta 3 arrays: os palpites em si, quais tipos já acertou, e os IDs já tentados */
    private function organizeGuessesByType(Collection $allGuesses): array
    {
        $guesses = [];
        $hasGuessedCorrectly = [];
        $guessedIds = [];

        foreach (self::GUESS_TYPES as $type) {
            // Filtra os palpites especificos do tipo e anexa os dados completos do item (nome, imagem, e afins)
            $filtered = $allGuesses
                ->where('type', '===', $type)
                ->map(fn (Guess $guess) => $this->attachDetails($guess));

            $guesses[$type]             = $filtered;
            $hasGuessedCorrectly[$type] = $filtered->contains('is_correct', true);
            $guessedIds[$type]          = $filtered->pluck('guess_id')->toArray();
        }

        return [$guesses, $hasGuessedCorrectly, $guessedIds];
    }

    // Procura o model certo pelo tipo do palpite e anexa os dados ao guess
    private function attachDetails(Guess $guess): Guess
    {
        $modelClass = self::MODEL_MAP[$guess->type] ?? null;
        $guess->details = $modelClass ? $modelClass::find($guess->guess_id) : null;

        return $guess;
    }

    private function getCorrectAnswerId(DailyChallenge $challenge, string $type, string $relationship): int
    {
        if ($type === 'quote') {
            return $challenge->quote->character_id;
        }

        return $challenge->$relationship->id;
    }

    private function storeGuess(User $user, DailyChallenge $challenge, string $type, int $guessedId, bool $isCorrect): void
    {
        Guess::create([
            'user_id'            => $user->id,
            'daily_challenge_id' => $challenge->id,
            'type'               => $type,
            'guess_id'           => $guessedId,
            'is_correct'         => $isCorrect,
        ]);
    }

    private function updateUserRating(User $user, int $attempts): void
    {
        $points = self::BASE_POINTS + ((self::MAX_ATTEMPTS - $attempts) * self::BONUS_PER_REMAINING_ATTEMPT);
        $user->increment('rating', $points);
    }

    private function hasCompletedAllChallenges(User $user, DailyChallenge $challenge): bool
    {
        $distinctCorrectTypes = Guess::where('user_id', $user->id)
            ->where('daily_challenge_id', $challenge->id)
            ->where('is_correct', true)
            ->distinct('type')
            ->count();

        return $distinctCorrectTypes >= self::TOTAL_CHALLENGE_TYPES;
    }

    private function feedbackRedirect(string $type, string $status, string $message, ?string $tab = null): RedirectResponse
    {
        $redirect = back()->with('feedback', [
            'type'    => $type,
            'status'  => $status,
            'message' => $message,
        ]);

        return $tab ? $redirect->withFragment($tab) : $redirect;
    }
}