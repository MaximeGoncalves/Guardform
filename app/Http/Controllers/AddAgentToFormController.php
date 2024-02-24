<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class AddAgentToFormController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Form $form)
    {
        $form->agents()->attach($request->agents);

        return redirect()->back();
    }
}
