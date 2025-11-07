<?php

namespace App\Http\Requests\Front\Event;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'organisation' => 'nullable|string|max:100',
            'nationalite' => 'required|string|max:100',
            'pays' => 'required|string|max:100',
            'ville' => 'required|string|max:100',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|max:20',
            'montant' => 'required|numeric|min:100',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'nationalite.required' => 'La nationalité est requise.',
            'pays.required' => 'Le pays est requis.',
            'ville.required' => 'La ville est requise.',
            'adresse.required' => 'L\'adresse est requise.',
            'code_postal.required' => 'Le code postal est requis.',
            'montant.required' => 'Le montant du don est obligatoire.',
            'montant.numeric' => 'Le montant doit être un nombre.',
            'montant.min' => 'Le montant minimum est de 100 FCFA.',
        ];
    }
}
