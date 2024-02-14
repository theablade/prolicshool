<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

 
    public function rules(): array
    {
        return [
        'nome' => 'required|string|max:255|unique:students',
        'email' => 'required|string|email|max:255|unique:students',
        'telefone' => 'required|numeric|min:100000000',
        'nacionalidade' => 'required|string|alpha',
        
        ];
    }

    public function messages()
{
    return [
        'nome.required' => 'O campo nome é obrigatório.',
        'nome.string' => 'O campo nome deve ser uma string.',
        'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
        'nome.unique' => 'O nome já está sendo utilizado.',
        'email.required' => 'O campo email é obrigatório.',
    
    ];
}
}