<?php

namespace App\Http\Requests\Back\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CommuniqueRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'min:10'],
            'subtitle' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:50'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:5120'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'titre du communiqué',
            'subtitle' => 'sous-titre du communiqué',
            'content' => 'contenu du communiqué',
            'images.*' => 'image',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le :attribute est obligatoire.',
            'title.min' => 'Le :attribute doit contenir au moins :min caractères.',
            'title.max' => 'Le :attribute ne peut pas dépasser :max caractères.',
            
            'subtitle.required' => 'Le :attribute est obligatoire.',
            'subtitle.max' => 'Le :attribute ne peut pas dépasser :max caractères.',
            
            'content.required' => 'Le :attribute est obligatoire.',
            'content.min' => 'Le :attribute doit contenir au moins :min caractères.',
            
            'images.*.image' => 'Le fichier doit être une image.',
            'images.*.mimes' => 'L\'image doit être au format : jpg, jpeg, png ou gif.',
            'images.*.max' => 'L\'image ne peut pas dépasser 5 Mo.',
        ];
    }
}