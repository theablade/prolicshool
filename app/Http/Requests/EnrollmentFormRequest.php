<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentFormRequest extends FormRequest
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
          'number_doc' => 'required|max:15|unique:enrollment', 
        ];
    }

     public function messages()
{
    return [


    'number_doc.max' => 'O campo numero do talão deve ter no máximo 15 caracteres.',
    'number_doc.unique' => 'O numero do talão já está registrado.',
    
    
    ];
}
}