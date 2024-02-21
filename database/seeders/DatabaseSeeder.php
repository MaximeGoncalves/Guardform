<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Skills;
use App\Models\Agent;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Maxime Goncalves',
             'email' => 'maxime.goncalves@sdis06.fr',
             'section' => 2
         ]);

         Agent::factory(50)->create();

         foreach (Skills::cases() as $skill) {
             Skill::create(['name' => $skill->name()]);
         }
    }
}
