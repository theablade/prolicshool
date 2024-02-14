@extends('adminlte::page')

@section('title', 'Detalhes do Estudante')

@section('content_header')
<h1>Detalhes do Estudante</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">

    <h5>Nome: {{ $student->nome }}</h5>
    <p>Email: {{ $student->email }}</p>
    <p>Endereço: {{ $student->endereco }}</p>
    <p>Telefone: {{ $student->ntelefone }}</p>
    <p>Gênero: {{ $student->genero }}</p>
    <p>Gênero: {{ $student->provincia }}</p>
  </div>
</div>
@stop