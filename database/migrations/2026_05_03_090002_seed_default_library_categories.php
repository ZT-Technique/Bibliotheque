<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
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

        foreach ($defaults as $theme) {
            $existing = DB::table('themes')->where('name', $theme['name'])->first();

            if ($existing) {
                DB::table('themes')->where('id', $existing->id)->update([
                    'description' => $existing->description ?: $theme['description'],
                    'updated_at' => now(),
                ]);
                continue;
            }

            DB::table('themes')->insert([
                'name' => $theme['name'],
                'description' => $theme['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('themes')->whereIn('name', [
            'Mémoires des apprenants',
            'Articles publiés par les apprenants',
            'Consultations des apprenants',
            'Rapports',
        ])->delete();
    }
};
