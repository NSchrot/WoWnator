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
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932309/jaina_face_awtapq.png',
                'splash_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932329/jaina_splash_yyfexl.png',
            ],
            [
                'name' => 'Thrall',
                'gender' => 'Male',
                'class' => 'Shaman',
                'race' => 'Orc',
                'faction' => 'Horde',
                'realm' => 'Durotar',
                'xpac' => 'Classic',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932317/thrall_face_sg2ll2.png',
                'splash_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932366/thrall_splash_luzlua.png',
            ],
            [
                'name' => 'Sylvanas Windrunner',
                'gender' => 'Female',
                'class' => 'Hunter',
                'race' => 'Undead (High Elf)',
                'faction' => 'Horde',
                'realm' => 'Undercity',
                'xpac' => 'Classic',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932314/sylvanas_face_u7ggmd.png',
                'splash_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932312/sylvanas_splash_jkikp6.png',
            ],
            [
                'name' => 'Anduin Wrynn',
                'gender' => 'Male',
                'class' => 'Priest',
                'race' => 'Human',
                'faction' => 'Alliance',
                'realm' => 'Stormwind',
                'xpac' => 'Mists of Pandaria',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751925596/anduin_face.png',
                'splash_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751925659/anduin_splash.png',
            ],
            [
                'name' => 'Arthas Menethil (The Lich King)',
                'gender' => 'Male',
                'class' => 'Death Knight',
                'race' => 'Human (Undead)',
                'faction' => 'Scourge',
                'realm' => 'Icecrown Citadel',
                'xpac' => 'Wrath of the Lich King',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932314/arthas_face_w360jw.png',
                'splash_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932339/arthas_splash_gjbdbq.png',
            ],
            [
                'name' => 'Illidan Stormrage',
                'gender' => 'Male',
                'class' => 'Demon Hunter',
                'race' => 'Night Elf (Demon)',
                'faction' => 'Illidari',
                'realm' => 'Black Temple',
                'xpac' => 'The Burning Crusade',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932322/illidan_face_hxdqvk.png',
                'splash_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932317/illidan_splash_oha17u.png',
            ],
        ];

        foreach ($characters as $characterData) {
            Character::create($characterData);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
