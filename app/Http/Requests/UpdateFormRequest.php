<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ca_vsav1' => 'nullable|numeric',
            'cond_vsav1' => 'nullable|numeric',
            'eq_vsav1' => 'nullable|numeric',
            'ca_vsav2' => 'nullable|numeric',
            'cond_vsav2' => 'nullable|numeric',
            'eq_vsav2' => 'nullable|numeric',
            'ca_vsav3' => 'nullable|numeric',
            'cond_vsav3' => 'nullable|numeric',
            'eq_vsav3' => 'nullable|numeric',
            'ca_fptl' => 'nullable|numeric',
            'cond_fptl' => 'nullable|numeric',
            'ce1_fptl' => 'nullable|numeric',
            'ce2_fptl' => 'nullable|numeric',
            'eq1_fptl' => 'nullable|numeric',
            'eq2_fptl' => 'nullable|numeric',
            'ca_vtu' => 'nullable|numeric',
            'cond_vtu' => 'nullable|numeric',
            'eq_vtu' => 'nullable|numeric',
            'ca_vsr' => 'nullable|numeric',
            'cond_vsr' => 'nullable|numeric',
            'eq_vsr' => 'nullable|numeric',
            'vli' => 'nullable|numeric',
            'epa' => 'nullable|numeric',
            'secu' => 'nullable|numeric',
            'ca_fpt' => 'nullable|numeric',
            'pharmacie' => 'nullable|numeric',
            'remise' => 'nullable|numeric',
            'cuisine' => 'nullable|numeric',
            'officier' => 'nullable|numeric',
            'adjudant' => 'nullable|numeric',
            'planton' => 'nullable|numeric',
        ];
    }
}
