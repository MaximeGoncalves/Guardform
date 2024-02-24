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

        \App\Models\User::factory()->create([
            'name' => 'Maxime Goncalves',
            'email' => 'maxime.goncalves@sdis06.fr',
            'section' => 2,
            'is_admin' => true
        ]);


        foreach (Skills::cases() as $skill) {
            Skill::create(['name' => $skill->name()]);
        }

        Agent::create([
            'firstname' => 'Maxime',
            'name' => 'Goncalves',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 24
        ]);
        Agent::create([
            'firstname' => 'Cyril',
            'name' => 'Moschetti',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 24
        ]);
        Agent::create([
            'firstname' => 'Nicolas',
            'name' => 'Doyen',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 12
        ]);
        Agent::create([
            'firstname' => 'Partice',
            'name' => 'Bertron',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 24
        ]);
        Agent::create([
            'firstname' => 'Olivier',
            'name' => 'Ferrando',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 24
        ]);
        Agent::create([
            'firstname' => 'Phillipe',
            'name' => 'Basso',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 12
        ]);
        Agent::create([
            'firstname' => 'Cyril',
            'name' => 'Avakyan',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 12
        ]);
        Agent::create([
            'firstname' => 'John',
            'name' => 'Pons',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 24
        ]);
        Agent::create([
            'firstname' => 'Gregoire',
            'name' => 'Behem',
            'status' => 'SPP',
            'section' => 2,
            'cycle' => 12
        ]);

        $skills = Skill::all();
        Agent::all()->each(function ($agent) use ($skills) {
            $agent->skills()->attach($skills);
        });
    }
}
