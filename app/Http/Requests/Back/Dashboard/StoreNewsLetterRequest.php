<?php

namespace App\Http\Requests\Back\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsLetterRequest extends FormRequest
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
            'subject' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre de la newsletter est obligatoire.',
            'subject.required' => 'L\'objet de l\'email est obligatoire.',
            'category.required' => 'Veuillez sélectionner une catégorie.',
            'category.in' => 'La catégorie sélectionnée est invalide.',
            'content.required' => 'Le contenu de la newsletter ne peut pas être vide.',
            'cover_image.image' => 'Le fichier doit être une image valide.',
            'cover_image.mimes' => 'Formats autorisés : jpeg, png, jpg, gif.',
            'cover_image.max' => 'L\'image ne doit pas dépasser 5 Mo.',
        ];
    }

    public function data(): array
    {
        return $this->validated();
    }
}
