<?php

namespace App\Http\Requests\Back\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgrammeRequest extends FormRequest
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
            'programme' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'animateur' => 'nullable|string|max:255',
            'jours' => 'required|array|min:1',
            'jours.*' => 'in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',

            'heure_debut1' => 'required|date_format:H:i|before:heure_fin1',
            'heure_fin1' => 'required|date_format:H:i',
            'heure_debut2' => 'required|date_format:H:i|before:heure_fin2',
            'heure_fin2' => 'required|date_format:H:i',
            'heure_debut3' => 'nullable|date_format:H:i|before:heure_fin3',
            'heure_fin3' => 'nullable|date_format:H:i',
            'heure_debut4' => 'nullable|date_format:H:i|before:heure_fin4',
            'heure_fin4' => 'nullable|date_format:H:i',
        ];
    }
}
