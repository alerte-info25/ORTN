<?php

namespace App\Http\Requests\Back\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class sondageStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'option1' => 'required|string|max:255',
            'option2' => 'required|string|max:255',
            'option3' => 'nullable|string|max:255',
            'option4' => 'nullable|string|max:255',
            'option5' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }

    public function messages () : array
    {
        return [
            'title.required' => 'Le titre du sondage est obligatoire.',
            'option1.required' => 'L\'option 1 est obligatoire.',
            'option2.required' => 'L\'option 2 est obligatoire.',
            'option3.string' => 'L\'option 3 doit être une chaîne de caractères.',
            'option4.string' => 'L\'option 4 doit être une chaîne de caractères.',
            'option5.string' => 'L\'option 5 doit être une chaîne de caractères.',
            'end_date.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];
    }
}
