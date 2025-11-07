<?php

namespace App\Http\Requests\Back\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePodcastVideoRequest extends FormRequest
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
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'required|string|max:255',
            'category' => 'required|string',
            'url' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'url',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'url.required' => 'Le lien audio est obligatoire.',
            'url.url' => 'Le lien doit être une URL valide.',
            'url.max' => 'Le lien ne peut pas dépasser 255 caractères.',
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'subtitle.required' => 'Le sous-titre est obligatoire.',
            'subtitle.max' => 'Le sous-titre ne peut pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est obligatoire.',
            'tags.required' => 'Les tags sont obligatoires.',
            'tags.max' => 'Les tags ne peuvent pas dépasser 255 caractères.',
            'category.required' => 'La catégorie est obligatoire.',
            'category.in' => 'La catégorie sélectionnée n\'est pas valide.',
            'status.required' => 'Le statut est obligatoire.',
            'status.in' => 'Le statut sélectionné n\'est pas valide.',
            'publish_date.required' => 'La date de publication est obligatoire.',
            'publish_date.date' => 'La date de publication doit être une date valide.',
            'type_media_id.string' => 'Le type de média doit être une chaîne de caractères.',
        ];
    }

    /**
     * Préparer les données avant validation (si nécessaire)
     */
    protected function prepareForValidation()
    {
        // après
    }
}
