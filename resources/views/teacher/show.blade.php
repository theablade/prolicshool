@extends('adminlte::page')

@section('title', 'Detalhes do Professor')

@section('content_header')
<h1 class="text-center">Perfil do Professor</h1>
@stop

<head>
  <style>
  .subtitulo {
    color: #007bff;
  }

  .flex-group {
    display: flex;
    justify-content: space-between;
    width: 18rem;
  }

  .subtitle {

    color: #A3A3A3;
  }
  </style>
</head>
@section('content')

<div class="card">
  <div class="row">

    <div class="col-md-9">


      <div class="card-body">


        <h5 class="text-bold">{{ $teacher->nome }}</h5>
        <p class="subtitle">{{ $teacher->id }}</p>
        <!-- Curso -->

        <div class=" flex-group">
          <div>
            Ingresso
            <p class="subtitulo">{{ \Carbon\Carbon::parse($teacher->data_inscricao)->format('Y-m') }}</p>
          </div>
          <div class="horario">
            Horário
            <p class="subtitulo"> {{ $teacher->horario }}</p>
          </div>

        </div>

        <hr>
        <h5 class="text-bold">Outras informações</h5>
        <div class=" flex-group">
          <div>
            Tipo de Documento
            <p class="subtitle"> {{ $teacher->tipodoc }}</p>
          </div>
          <div class="horario">
            Número do Documento
            <p class="subtitle"> {{ $teacher->numerodoc }}</p>
          </div>

        </div>

        <div class=" flex-group">
          <div>
            Natural de
            <p class="subtitle"> {{ $teacher->provincia }}</p>
          </div>
          <div class="horario">
            Distrito
            <p class="subtitle"> {{ $teacher->distrito }}</p>
          </div>

        </div>
        <div class=" flex-group">
          <div>
            Bairro
            <p class="subtitle"> {{ $teacher->bairro }}</p>
          </div>
          <div class="horario">
            Quarterão
            <p class="subtitle"> {{ $teacher->quarterao }}</p>
          </div>

        </div>
        <div class=" flex-group">
          <div>
            Contacto
            <p class="subtitle"> {{ $teacher->ntelefone }}</p>
          </div>
          <div class="horario">
            Nacionalidade
            <p class="subtitle"> {{ $teacher->nacionalidade }}</p>
          </div>

        </div>



      </div>
    </div>
    <div class="col-md-3">
      <div class="card-body">

        <div class="row">
          <div class="img">

            <img src="" alt="" width="100px" height="100px">
          </div>
          <div class="info">

            <p>{{ $teacher->nome }}</p>
            <smal>{{ $teacher->email }}</smal>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@stop