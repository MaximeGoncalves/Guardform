<?php

namespace Database\Seeders;

use App\Enums\Skills;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Skills::cases() as $skill) {
            Skill::query()->firstOrCreate(['name' => $skill->name()]);
        }
    }
}
