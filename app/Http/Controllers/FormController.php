<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFormRequest;
use App\Models\Agent;
use App\Models\Form;

class FormController
{
    public function edit(Form $form)
    {
        $form = $form->load('agents.skills', 'garde');
        $form->agents->each(fn ($agent) => $agent->getStats($form));
        return inertia('Form/Edit', [
            'form' => $form,
            'agents' => Agent::query()->whereNotIn('id', $form->agents->pluck('id'))->get(),
        ]);
    }

    public function update(UpdateFormRequest $request, Form $form)
    {
        $form->update($request->validated());
        return redirect()->back()->with('success', 'Mis à jour avec succès');
    }
}
