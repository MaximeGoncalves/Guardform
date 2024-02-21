<?php

namespace App\Http\Controllers;

use App\Models\Form;

class FormController
{
    public function edit(Form $form)
    {
        return inertia('Form/Edit', [
            'form' => $form->load('agents'),
        ]);
    }
}
