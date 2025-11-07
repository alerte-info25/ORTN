<?php

namespace App\Http\Requests\Back\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RedacteurStoreRequest extends FormRequest
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
            'prenom' => ['required', 'string', 'max:50', 'min:2'],
            'nom' => ['required', 'string', 'max:50', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'genre' => ['required', 'in:homme,femme,autres'],
            'contact' => ['required', 'string', 'max:20'],
            'localite' => ['required', 'string', 'max:100'],
            'poste' => ['required', 'string', 'max:100'],
            'departement' => ['required', 'string', 'max:100'],
            'date_embauche' => ['required', 'date', 'before_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.min' => 'Le prénom doit contenir au moins :min caractères.',
            'nom.required' => 'Le nom est obligatoire.',
            'nom.min' => 'Le nom doit contenir au moins :min caractères.',
            'email.required' => 'L’adresse email est obligatoire.',
            'email.email' => 'Le format de l’email est invalide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'genre.required' => 'Le genre est obligatoire.',
            'genre.in' => 'Le genre doit être homme, femme ou autres.',
            'contact.required' => 'Le numéro de téléphone est obligatoire.',
            'localite.required' => 'La localité est obligatoire.',
            'poste.required' => 'Le poste est obligatoire.',
            'departement.required' => 'Le département est obligatoire.',
            'date_embauche.required' => 'La date d’embauche est obligatoire.',
            'date_embauche.date' => 'La date d’embauche doit être une date valide.',
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'prenom' => trim($this->prenom),
            'nom' => trim($this->nom),
            'email' => strtolower(trim($this->email)),
            'contact' => $this->contact ? trim($this->contact) : null,
            'localite' => $this->localite ? trim($this->localite) : null,
            'poste' => $this->poste ? trim($this->poste) : null,
            'departement' => $this->departement ? trim($this->departement) : null,
            'genre' => $this->genre ? strtolower(trim($this->genre)) : null,
        ]);
    }
}
