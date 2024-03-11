<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuardRequest;
use App\Models\Agent;
use App\Models\Guard;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuardController
{
    public function index()
    {
        return inertia('Guard/Index', ['guards' => Guard::with('forms')->orderByDesc('date')->get()]);
    }

    public function store(StoreGuardRequest $request)
    {
        $guard = Guard::create($request->validated());

        $dayform = $guard->forms()->create(); // Jour
        $nightform = $guard->forms()->create([
            'is_night' => true
        ]); // Nuit

        $dayform->agents()->sync(Agent::query()->where('section', auth()->user()->section)->pluck('id')); // Jour()
        $nightform->agents()->attach(Agent::query()
            ->where('section', auth()->user()->section)
            ->where('cycle', 24)->pluck('id')
        );
        $nightform->agents()->attach(Agent::query()
            ->where('section', auth()->user()->section - 1 === 0 ? 4 : auth()->user()->section - 1)
            ->where('cycle', 12)->pluck('id')
        );

        return redirect()->back();
    }
}
