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
    'genero' => 'required|in:Masculino,Feminino',
    'data_nascimento' => 'required|date',
    'tipodoc' => 'required|in:cedula,cartão de eleitor,bi',
    'numerodoc' => 'required|string|max:13',
    'email' => 'required|string|email|max:255|unique:students', 
    'dadname' => 'required|string|max:255',
    'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    'mothername' => 'required|string|max:255',
    'provincia' => 'required|string|max:255',
    'distrito' => 'required|string|max:255',
    'nacionalidade' => 'required|string|max:255',
    'bairro' => 'required|string|max:255',
    'quarterao' => 'required|string|max:255',
    'avenida' => 'required|string|max:255',
    'ntelefone' => 'required|string|max:255',
    
        ];
    }

    public function messages()
{
    return [
    'nome.required' => 'O campo nome é obrigatório.',
    'nome.string' => 'O campo nome deve ser um texto.',
    'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
    'nome.unique' => 'O nome já está registrado.',
    'genero.required' => 'O campo gênero é obrigatório.',
    'genero.in' => 'O gênero selecionado é inválido.',
    'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
    'data_nascimento.date' => 'O campo data de nascimento deve ser uma data válida.',
    'tipodoc.required' => 'O campo tipo de documento é obrigatório.',
    'tipodoc.in' => 'O tipo de documento selecionado é inválido.',
    'numerodoc.required' => 'O campo número de documento é obrigatório.',
    'numerodoc.string' => 'O campo número de documento deve ser um texto.',
    'numerodoc.max' => 'O campo número de documento deve ter no máximo 13 caracteres.',
    'dadname.required' => 'O campo nome do pai é obrigatório.',
    'dadname.string' => 'O campo nome do pai deve ser um texto.',
    'mothername.required' => 'O campo nome da mãe é obrigatório.',
    'mothername.string' => 'O campo nome da mãe deve ser um texto.',
    'provincia.required' => 'O campo província é obrigatório.',
    'distrito.required' => 'O campo distrito é obrigatório.',
    'nacionalidade.required' => 'O campo nacionalidade é obrigatório.',
    'nacionalidade.string' => 'O campo nacionalidade deve ser um texto.',
    'bairro.required' => 'O campo bairro é obrigatório.',
    'bairro.string' => 'O campo bairro deve ser um texto.',
    'quarterao.required' => 'O campo quarterão é obrigatório.',
    'quarterao.string' => 'O campo quarterão deve ser um texto.',
    'avenida.required' => 'O campo avenida é obrigatório.',
    'avenida.string' => 'O campo avenida deve ser um texto.',
    'resprovincia.required' => 'O campo província de residência é obrigatório.',
    'redistrito.required' => 'O campo distrito de residência é obrigatório.',
    'ntelefone.required' => 'O campo contacto do encarregado é obrigatório.',
    'ntelefone.numeric' => 'O campo contacto do encarregado deve ser numérico.',
    'ntelefone.minlength' => 'O campo contacto do encarregado deve ter pelo menos :min caracteres.',
    'email.required' => 'O campo email é obrigatório.',
    'email.email' => 'O campo email deve ser um endereço de email válido.',
    'email.unique' => 'O email já existe.',
    
    ];
}
}