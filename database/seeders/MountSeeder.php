<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mount;

class MountSeeder extends Seeder
{

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Mount::truncate();
        $mounts = [
            [
                'name' => 'Swift Gryphon',
                'type' => 'Flying',
                'faction' => 'Alliance',
                'xpac' => 'Classic',
                'source' => 'Vendor - Stormwind City',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Stormwind Steed',
                'type' => 'Ground',
                'faction' => 'Alliance',
                'xpac' => 'Classic',
                'source' => 'Vendor - Elwynn Forest',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Swift Wind Rider',
                'type' => 'Flying',
                'faction' => 'Horde',
                'xpac' => 'Classic',
                'source' => 'Vendor - Orgrimmar',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orgrimmar Wolf',
                'type' => 'Ground',
                'faction' => 'Horde',
                'xpac' => 'Classic',
                'source' => 'Vendor - Orgrimmar',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Ashes of Al\'ar',
                'type' => 'Flying',
                'faction' => 'Neutral',
                'xpac' => 'The Burning Crusade',
                'source' => 'Drop - Kael\'thas Sunstrider (Tempest Keep)',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Invincible',
                'type' => 'Flying',
                'faction' => 'Neutral',
                'xpac' => 'Wrath of the Lich King',
                'source' => 'Drop - The Lich King (Icecrown Citadel)',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Azure Drake',
                'type' => 'Flying',
                'faction' => 'Neutral',
                'xpac' => 'Wrath of the Lich King',
                'source' => 'Drop - Malygos (The Eye of Eternity)',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Obsidian Worldbreaker',
                'type' => 'Flying',
                'faction' => 'Neutral',
                'xpac' => 'Battle for Azeroth',
                'source' => 'WoW\'s 15th Anniversary event',
                'image_url' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ];

        foreach ($mounts as $mountData) {
            Mount::create($mountData);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
