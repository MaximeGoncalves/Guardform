<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class RemoveAgentFromFormController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Form $form)
    {
        $form->agents()->detach($request->agent);
        return redirect()->back();
    }
}
