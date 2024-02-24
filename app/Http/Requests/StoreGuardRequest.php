<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGuardRequest extends FormRequest
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
            'date' => ['required', 'date', Rule::unique('guards')],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['date' => Carbon::make($this->date)->format('Y-m-d')]);
    }

    public function messages()
    {
        return [
            'date.unique' => 'Une garde est déjà créer pour cette date.',
        ];
    }
}
