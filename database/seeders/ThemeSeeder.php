<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'name' => 'Mémoires des apprenants',
                'description' => 'Travaux académiques des apprenants accessibles selon le profil autorisé.',
            ],
            [
                'name' => 'Articles publiés par les apprenants',
                'description' => 'Publications scientifiques produites par les apprenants.',
            ],
            [
                'name' => 'Consultations des apprenants',
                'description' => 'Articles externes consultés par les apprenants.',
            ],
            [
                'name' => 'Rapports',
                'description' => 'Rapports institutionnels et documents de référence.',
            ],
        ];

        foreach ($themes as $theme) {
            Theme::firstOrCreate(['name' => $theme['name']], $theme);
        }
    }
}
