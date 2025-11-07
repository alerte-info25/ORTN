<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterRequest extends FormRequest
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
            'genre' => ['required'],
            'contact' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'confirmed', RulesPassword::min(8)],
            'localite' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne peut pas dépasser :max caractères.',
            'prenom.min' => 'Le prénom doit contenir au moins :min caractères.',
            'prenom.regex' => 'Le prénom contient des caractères non autorisés.',

            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser :max caractères.',
            'nom.min' => 'Le nom doit contenir au moins :min caractères.',
            'nom.regex' => 'Le nom contient des caractères non autorisés.',

            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.max' => 'L\'adresse email ne peut pas dépasser :max caractères.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',

            'genre.required' => 'Le genre est obligatoire.',

            'contact.regex' => 'Le format du numéro de téléphone est invalide.',

            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',

            'localite.max' => 'La localité ne peut pas dépasser :max caractères.',
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
        ]);
    }
}
