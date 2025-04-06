<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSubcategoryRequest extends FormRequest
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
        $rules =  [
            'category_id' => 'required',
            'name' => [
                'required',
                'min:3',
                'max:255'
            ],
            'description' => 'required'
        ];

        // condição que irá verificar se a requisição é para edição onde não é necessário o campo category_id
        if($this->method() === 'PATCH') {
            $rules['category_id'] = 'nullable';
        }

        return $rules;
    }
}
