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
                'name' => 'Swift Blue Gryphon',
                'type' => 'Flying',
                'faction' => 'Alliance',
                'xpac' => 'The Burning Crusade',
                'source' => 'Vendor - Outland',
                'description' => 'The Horde had dragons, we had the gryphons. We won that war. - Ilsa Blusterbrew',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/115680-swift-blue-gryphon.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941763/Ability_Mount_Gryphon_01_pzyp7m.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Stormwind Steed',
                'type' => 'Ground',
                'faction' => 'Alliance',
                'xpac' => 'Wrath of the Lich King',
                'source' => 'Vendor - Icecrown',
                'description' => 'Although raised in Stormwind, this breed showed unusual aptitude for the cold weather in Icecrown.',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/131352-stormwind-steed.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941764/Ability_Mount_RidingHorse_na07ro.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Swift Red Wind Rider',
                'type' => 'Flying',
                'faction' => 'Horde',
                'xpac' => 'The Burning Crusade',
                'source' => 'Vendor - Outland',
                'description' => 'I still don\'t get why they fly faster when you put armor on them. -Drakma',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/160050-swift-red-wind-rider.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941764/Ability_Mount_SwiftRedWindRider_xhtzq8.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orgrimmar Wolf',
                'type' => 'Ground',
                'faction' => 'Horde',
                'xpac' => 'Wrath of the Lich King',
                'source' => 'Vendor - Icecrown',
                'description' => 'For a brief time, many orcs would declare themselves "hungry like an Orgrimmar wolf." Some blood elves still use the phrase ironically.',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/143772-lobo-de-orgrimmar.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941763/Ability_Mount_BlackDireWolf_q7fyyz.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Ashes of Al\'ar',
                'type' => 'Flying',
                'faction' => 'Neutral',
                'xpac' => 'The Burning Crusade',
                'source' => 'Drop - Kael\'thas Sunstrider (Tempest Keep)',
                'description' => 'Al\'ar was the beloved pet of Kael\'thas Sunstrider, who often boasted that death would never claim it. Perhaps he was right.',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/858108-cinzas-de-alar.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941767/Inv_Misc_SummerFest_BrazierOrange_h0jhgv.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Invincible',
                'type' => 'Flying',
                'faction' => 'Neutral',
                'xpac' => 'Wrath of the Lich King',
                'source' => 'Drop - The Lich King (Icecrown Citadel)',
                'description' => 'The famous steed of Arthas Menethil, who serves its master in life and in death. Riding him is truly a feat of strength.',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/1089424-invincibles-reins.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941763/ABILITY_MOUNT_PEGASUS_d3nnok.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Azure Drake',
                'type' => 'Flying',
                'faction' => 'Neutral',
                'xpac' => 'Wrath of the Lich King',
                'source' => 'Drop - Malygos (The Eye of Eternity)',
                'description' => 'Always speak politely to an enraged dragon.',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/702770-reins-of-the-azure-drake.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941763/Ability_Mount_Drake_Azure_ytfzua.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blue Qiraji Battle Tank',
                'type' => 'Ground',
                'faction' => 'Neutral',
                'xpac' => 'Classic',
                'source' => 'Drop - Temple of Ahn\'Qiraj',
                'description' => 'This (relatively) domesticated silithid is at home only in the desert sands of Ahn\'Qiraj.',
                'image_url' => 'https://wow.zamimg.com/uploads/screenshots/normal/284084-blue-qiraji-resonating-crystal.jpg',
                'icon_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751941764/INV_Misc_QirajiCrystal_04_cpuqq7.png',
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
