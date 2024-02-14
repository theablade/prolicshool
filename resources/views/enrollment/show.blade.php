@extends('adminlte::page')

@section('title', 'Detalhes da Matricula')

@section('content_header')
<h1>Detalhes da Matricula</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">

    @foreach ($enrollments as $enrollment)
    <h5>Nome do estudante: {{ $enrollment->student }}</h5>
    <p>Curso: {{ $enrollment->course }}</p>
    <p>Preço da matricula: {{ $enrollment->price_enrollemnt }}</p>
    <p>Preço da inscrição: {{ $enrollment->price_subscrab }}</p>
    <p>Status : {{ $enrollment->status }}</p>

    @endforeach
  </div>
</div>
@stop