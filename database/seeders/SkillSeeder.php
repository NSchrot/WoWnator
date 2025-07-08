<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Skill::truncate();

        $skills = [
            [
                'name' => 'Fireball',
                'type' => 'Active',
                'race' => 'Any',
                'class' => 'Mage',
                'description' => 'Hurls a fiery ball that causes Fire damage.',
                'xpac' => 'Classic',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932482/Spell_Fire_FlameBolt_m8bo31.png',
            ],
            [
                'name' => 'Blink',
                'type' => 'Active',
                'race' => 'Any',
                'class' => 'Mage',
                'description' => 'Teleports the caster 20 yards forward, unless something is in the way.',
                'xpac' => 'Classic',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932482/Spell_Arcane_Blink_b97piq.png',
            ],
            [
                'name' => 'Charge',
                'type' => 'Active',
                'race' => 'Any',
                'class' => 'Warrior',
                'description' => 'Charge to an enemy, stunning it for 1 sec.',
                'xpac' => 'Classic',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932482/Ability_Warrior_Charge_zdg1e1.png',
            ],
            [
                'name' => 'Stealth',
                'type' => 'Active',
                'race' => 'Any',
                'class' => 'Rogue',
                'description' => 'Conceals you in the shadows, reducing the chance for enemies to detect your presence.',
                'xpac' => 'Classic',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932482/Ability_Stealth_fgvx1u.png',
            ],
            [
                'name' => 'Chain Lightning',
                'type' => 'Active',
                'race' => 'Any',
                'class' => 'Shaman',
                'description' => 'Hurls a lightning bolt at the enemy, dealing Nature damage and then jumping to additional nearby enemies.',
                'xpac' => 'Classic',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932483/Spell_Nature_ChainLightning_wygudz.png',
            ],
            [
                'name' => 'Death Grip',
                'type' => 'Active',
                'race' => 'Any',
                'class' => 'Death Knight',
                'description' => 'Harnesses the energy that surrounds and binds all matter, drawing the target toward the Death Knight.',
                'xpac' => 'Wrath of the Lich King',
                'image_url' => 'https://res.cloudinary.com/dpebql3aj/image/upload/v1751932482/Spell_DeathKnight_Strangulate_lesrdl.png',
            ],
        ];

        foreach ($skills as $skillData) {
            Skill::create($skillData);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
