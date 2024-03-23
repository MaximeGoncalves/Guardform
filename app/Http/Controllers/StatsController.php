<?php

namespace App\Http\Controllers;

use App\Models\Agent;

class StatsController
{
    public function index()
    {
        $agents = Agent::query()->where('section', auth()->user()->section)->orWhere('status', 'SPV')->get();

        $agents->each(function ($agent) {
            $agent->getGlobalStats();
        });

        return inertia('Stats/Index', [
            'agents' => $agents,
        ]);
    }
}
