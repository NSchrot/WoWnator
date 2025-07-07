<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Zone::truncate();

        $zones = [
            [
                'name' => 'Elwynn Forest',
                'continent' => 'Eastern Kingdoms',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/175163-elwynn-forest.jpg',
            ],
            [
                'name' => 'Stormwind City',
                'continent' => 'Eastern Kingdoms',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/1050440-stormwind-city.jpg',
            ],
            [
                'name' => 'Stranglethorn Vale',
                'continent' => 'Eastern Kingdoms',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/550887-stranglethorn-vale.jpg',
            ],
            [
                'name' => 'Durotar',
                'continent' => 'Kalimdor',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/179144-durotar.jpg',
            ],
            [
                'name' => 'Orgrimmar',
                'continent' => 'Kalimdor',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/386841-orgrimmar.jpg',
            ],
            [
                'name' => 'Teldrassil',
                'continent' => 'Kalimdor',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/153825-teldrassil-beautiful-angelic-forest-just-outside-dolanaar.jpg',
            ],
            [
                'name' => 'Nagrand',
                'continent' => 'Outland',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/1211054-nagrand-nagrand-wow-retail.jpg',
            ],
            [
                'name' => 'Icecrown',
                'continent' => 'Northrend',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/294542-icecrown.jpg',
            ],
        ];

        foreach ($zones as $zoneData) {
            Zone::create($zoneData);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
