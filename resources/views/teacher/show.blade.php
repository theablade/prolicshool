@extends('adminlte::page')

@section('title', 'Detalhes do Professor')

@section('content_header')
<h1>Detalhes do Professor</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">

    <td>{{ $teacher->id }}</td>
    <td>{{ $teacher->nome }}</td>
    <td>{{ $teacher->email }}</td>
    <td>{{ $teacher->endereco }}</td>
    <td>{{ $teacher->telefone }}</td>
    <td>{{ $teacher->tipodoc }} : {{ $teacher->numerodoc }}</td>
    <td>
      ]
  </div>
</div>
@stop