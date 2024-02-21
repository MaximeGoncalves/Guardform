<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AgentController
{
    public function index()
    {
        return inertia('Agent/Index', [
            'agents' => Agent::all(),
        ]);
    }

    public function create()
    {
        return inertia('Agent/Create', [
            'skills' => Skill::all()
        ]);
    }
    public function edit(Agent $agent)
    {
        return inertia('Agent/Edit', [
            'agent' => $agent->load('skills'),
            'skills' => Skill::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'firstname' => 'required',
            'status' => 'required',
            'cycle' => 'nullable',
            'section' => 'nullable',
            'skills' => 'array',
            'skills.*' => 'exists:skills,id'
        ]);

        $agent = Agent::create(Arr::except($validated, ['skills']));

        $agent->skills()->sync($validated['skills']);

        return redirect()->route('agents.index');

    }
    public function update(Request $request, Agent $agent)
    {
        $validated = $request->validate([
            'name' => 'required',
            'firstname' => 'required',
            'status' => 'required',
            'cycle' => 'nullable',
            'section' => 'nullable',
            'skills' => 'array',
            'skills.*' => 'exists:skills,id'
        ]);

        $agent->update(Arr::except($validated, ['skills']));

        $agent->skills()->sync($validated['skills']);

        return redirect()->route('agents.index');

    }
}
