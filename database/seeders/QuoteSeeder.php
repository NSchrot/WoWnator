<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quote;
use Illuminate\Support\Facades\DB;

class QuoteSeeder extends Seeder
{

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Quote::truncate();
        $quotes = [
            ['text' => 'I\'m listening.', 'character_id' => 1],
            ['text' => 'My magic will tear you apart!', 'character_id' => 1],
            ['text' => 'For the Horde!', 'character_id' => 2],
            ['text' => 'The elements are my allies.', 'character_id' => 2],
            ['text' => 'What are we, if not slaves to this torment?', 'character_id' => 3],
            ['text' => 'The Horde is nothing!', 'character_id' => 3],
            ['text' => 'Frostmourne hungers.', 'character_id' => 5],
            ['text' => 'There is no peace, no respite. Only... darkness.', 'character_id' => 5],
            ['text' => 'You are not prepared!', 'character_id' => 6],
        ];

        foreach ($quotes as $quoteData) {
            Quote::create($quoteData);
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
