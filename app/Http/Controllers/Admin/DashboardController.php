<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $challenge = DailyChallenge::where('date', $today)->first();

        $stats = [
            'users' => User::count(),
            'characters' => Character::count(),
            'mounts' => Mount::count(),
            'skills' => Skill::count(),
            'zones' => Zone::count(),
            'quotes' => Quote::count(),
        ];

        $chartData = [
            'labels' => [],
            'data' => [],
        ];

        if ($challenge) {
            $guessStats = Guess::where('daily_challenge_id', $challenge->id)
                ->select('type', DB::raw('count(*) as total'), DB::raw('count(case when is_correct = 1 then 1 else null end) as correct'))
                ->groupBy('type')
                ->get();

            $chartData['labels'] = $guessStats->pluck('type')->map(fn($type) => ucfirst($type));
            $chartData['data'] = $guessStats->map(function ($stat) {
                return $stat->total > 0 ? round(($stat->correct / $stat->total) * 100, 2) : 0;
            });
        }

        return view('admin.dashboard', [
            'stats' => $stats,
            'challenge' => $challenge,
            'chartData' => $chartData,
        ]);
    }

    public function rerollTarget(Request $request)
    {
        $request->validate(['type' => 'required|string|in:character,zone,mount,skill,quote']);

        $type = $request->input('type');
        $challenge = DailyChallenge::where('date', Carbon::today())->firstOrFail();
        
        $modelMapping = [
            'character' => Character::class,
            'zone' => Zone::class,
            'mount' => Mount::class,
            'skill' => Skill::class,
            'quote' => Quote::class,
        ];

        $model = $modelMapping[$type];
        $currentId = $challenge->{$type . '_id'};
        
        $newEntity = $model::where('id', '!=', $currentId)->inRandomOrder()->first();

        if ($newEntity) {
            $challenge->update([$type . '_id' => $newEntity->id]);
            
            if ($type === 'character') {
                $newQuote = Quote::where('character_id', $newEntity->id)->inRandomOrder()->first();
                if ($newQuote) {
                    $challenge->update(['quote_id' => $newQuote->id]);
                }
            }
        }

        return redirect()->route('admin.dashboard')->with('success', ucfirst($type) . ' do desafio diário foi alterado com sucesso!');
    }
}