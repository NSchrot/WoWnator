<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Character;
use App\Models\Zone;
use App\Models\Mount;
use App\Models\Skill;
use App\Models\Quote;
use App\Models\DailyChallenge;
use Carbon\Carbon;

class CreateDailyChallenge extends Command
{

    protected $signature = 'app:create-daily-challenge {--force : Força a regeneração do desafio do dia, apagando o existente}';

    protected $description = 'Cria um novo desafio diário com alvos aleatórios';

    public function handle()
    {
        $today = Carbon::today();
        $force = $this->option('force');

        $existingChallenge = DailyChallenge::where('date', $today)->withTrashed()->first();

        if ($existingChallenge) {
            if ($force) {
                $this->warn('Um desafio para hoje já existe. A forçar a regeneração...');
                $existingChallenge->forceDelete(); 
                $this->info('Desafio anterior para hoje foi permanentemente apagado.');
            } else {
                $this->info('O desafio diário para hoje já existe. Use --force para regenerar.');
                return 0;
            }
        }

        try {
            $character = Character::inRandomOrder()->firstOrFail();
            $zone = Zone::inRandomOrder()->firstOrFail();
            $mount = Mount::inRandomOrder()->firstOrFail();
            $skill = Skill::inRandomOrder()->firstOrFail();
            $quote = Quote::inRandomOrder()->firstOrFail();

            DailyChallenge::create([
                'date' => $today,
                'character_id' => $character->id,
                'zone_id' => $zone->id,
                'mount_id' => $mount->id,
                'skill_id' => $skill->id,
                'quote_id' => $quote->id,
            ]);

            $this->info('Desafio diário criado com sucesso para ' . $today->format('d/m/Y'));
            return 1;
        } catch (\Exception $e) {
            $this->error('Falha ao criar o desafio diário: ' . $e->getMessage());
            return -1;
        }
    }
}
