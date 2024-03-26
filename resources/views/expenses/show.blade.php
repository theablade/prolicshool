@extends('adminlte::page')

@section('title', 'Detalhes da Dispesa')

@section('content_header')
<h1>Detalhes da Dispesa</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">

    <h5>Tipo: {{ $expense->tipo }}</h5>
    <p>Descricao: {{ $expense->descricao }}</p>
    <p>Valor: {{ $expense->valor }} Mts</p>
    <p>Data: {{ $expense->data }}</p>

  </div>
</div>
@stop