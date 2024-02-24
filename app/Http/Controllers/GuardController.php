<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Guard;

class GuardController
{
    public function index()
    {
        return inertia('Guard/Index', ['guards' => Guard::with('forms')->orderBy('date')->get()]);
    }

    public function store()
    {
        $validated = request()->validate([
            'date' => 'required|date|unique:guards',
        ]);

        $guard = Guard::create($validated);

        $dayform = $guard->forms()->create(); // Jour
        $nightform =$guard->forms()->create([
            'is_night' => true
        ]); // Nuit

        $dayform->agents()->sync(Agent::query()->where('section', auth()->user()->section)->pluck('id')); // Jour()

        return redirect()->back();
    }
}
