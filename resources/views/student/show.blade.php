@extends('adminlte::page')

@section('title', 'Detalhes do Aluno')

@section('content_header')
<h1>Detalhes do Aluno</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">

    <h5>Nome: {{ $student->nome }}</h5>
    <p>Email: {{ $student->email }}</p>
    <p>Bairro: {{ $student->bairro }}</p>
    <p>Quarterão: {{ $student->quarterao }}</p>
    <p>Casa n: {{ $student->casanumero }}</p>
    <p>Distrito: {{ $student->distrito }}</p>
    <p>Provincia: {{ $student->provincia }}</p>
    <p>Contacto do engarregado: {{ $student->ntelefone }}</p>

  </div>
</div>
@stop