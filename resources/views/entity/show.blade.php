@extends('adminlte::page')

@section('title', 'Detalhes do Courso')

@section('content_header')
<h1>Detalhes do Courso</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">

    <h5>Nome: {{ $course->nome }}</h5>
    <p>Descricao: {{ $course->descricao }}</p>
    <p>Duracao: {{ $course->duracao }}h</p>
    <p>Nivel: {{ $course->nivel }}</p>

  </div>
</div>
@stop