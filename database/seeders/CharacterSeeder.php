<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;
use Illuminate\Support\Facades\DB;


class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Character::truncate();
        $characters = [
            [
                'name' => 'Jaina Proudmoore',
                'gender' => 'Female',
                'class' => 'Mage',
                'race' => 'Human',
                'faction' => 'Alliance',
                'realm' => 'Kul Tiras',
                'xpac' => 'Classic',
                'image_url' => '',
            ],
            [
                'name' => 'Thrall',
                'gender' => 'Male',
                'class' => 'Shaman',
                'race' => 'Orc',
                'faction' => 'Horde',
                'realm' => 'Durotar',
                'xpac' => 'Classic',
                'image_url' => '',
            ],
            [
                'name' => 'Sylvanas Windrunner',
                'gender' => 'Female',
                'class' => 'Hunter',
                'race' => 'Undead (High Elf)',
                'faction' => 'Horde',
                'realm' => 'Undercity',
                'xpac' => 'Classic',
                'image_url' => '',
            ],
            [
                'name' => 'Anduin Wrynn',
                'gender' => 'Male',
                'class' => 'Priest',
                'race' => 'Human',
                'faction' => 'Alliance',
                'realm' => 'Stormwind',
                'xpac' => 'Mists of Pandaria',
                'image_url' => '',
            ],
            [
                'name' => 'Arthas Menethil (The Lich King)',
                'gender' => 'Male',
                'class' => 'Death Knight',
                'race' => 'Human (Undead)',
                'faction' => 'Scourge',
                'realm' => 'Icecrown Citadel',
                'xpac' => 'Wrath of the Lich King',
                'image_url' => '',
            ],
            [
                'name' => 'Illidan Stormrage',
                'gender' => 'Male',
                'class' => 'Demon Hunter',
                'race' => 'Night Elf (Demon)',
                'faction' => 'Illidari',
                'realm' => 'Black Temple',
                'xpac' => 'The Burning Crusade',
                'image_url' => '',
            ],
        ];

        foreach ($characters as $characterData) {
            Character::create($characterData);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
