@extends('adminlte::page')

@section('title', 'Detalhes do Disciplina')

@section('content_header')
<h1>Detalhes do Disciplina</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">

    <h5>Nome: {{ $discipline->nome }}</h5>
    <p>Descricao: {{ $discipline->descricao }}</p>

  </div>
</div>
@stop