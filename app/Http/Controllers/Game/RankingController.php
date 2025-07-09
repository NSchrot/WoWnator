<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function show()
    {
        $factionScores = User::query()
            ->select('faction', DB::raw('SUM(rating) as total_score'))
            ->whereNotNull('faction')
            ->groupBy('faction')
            ->pluck('total_score', 'faction');

        $hordeScore = $factionScores->get('Horde', 0);
        $allianceScore = $factionScores->get('Alliance', 0);
        
        $totalScore = $hordeScore + $allianceScore;
        $hordePercentage = ($totalScore > 0) ? round(($hordeScore / $totalScore) * 100) : 50;
        $alliancePercentage = 100 - $hordePercentage;

        $hordePlayers = User::where('faction', 'Horde')
            ->orderByDesc('rating')
            ->take(10)
            ->get();

        $alliancePlayers = User::where('faction', 'Alliance')
            ->orderByDesc('rating')
            ->take(10)
            ->get();

        return view('game.ranking', [
            'hordeScore' => $hordeScore,
            'allianceScore' => $allianceScore,
            'hordePercentage' => $hordePercentage,
            'alliancePercentage' => $alliancePercentage,
            'hordePlayers' => $hordePlayers,
            'alliancePlayers' => $alliancePlayers,
        ]);
    }
}
