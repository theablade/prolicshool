@extends('adminlte::page')

@section('title', 'Detalhes do Aluno')

@section('content_header')


<h1>Detalhes do Aluno</h1>
@stop

@section('content')

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

<div class="card">
  <div class="row">

    <div class="col-md-9">


      <div class="card-body">


        <h5 class="text-bold">{{ $student->nome }}</h5>
        <p class="subtitle">{{ $student->id }}</p>
        <!-- Curso -->

        <div class=" flex-group">
          <div>
            Ingresso
            <p class="subtitulo">{{ \Carbon\Carbon::parse($student->data_inscricao)->format('Y-m') }}</p>
          </div>
          <div class="horario">
            Horário
            <p class="subtitulo"> {{ $student->horario }}</p>
          </div>

        </div>
        <div class=" flex-group">
          <div>
            Situação
            <p class="subtitulo"> {{ $student->status }}</p>
          </div>
          <div class="horario">

          </div>

        </div>
        <hr>
        <h5 class="text-bold">Outras informações</h5>
        <div class=" flex-group">
          <div>
            Nome do Pai
            <p class="subtitle"> {{ $student->dadname }}</p>
          </div>
          <div class="horario">
            Nome da Mãe
            <p class="subtitle"> {{ $student->quarterao }}</p>
          </div>

        </div>

        <div class=" flex-group">
          <div>
            Natural de
            <p class="subtitle"> {{ $student->provincia }}</p>
          </div>
          <div class="horario">
            Distrito
            <p class="subtitle"> {{ $student->distrito }}</p>
          </div>

        </div>
        <div class=" flex-group">
          <div>
            Bairro
            <p class="subtitle"> {{ $student->bairro }}</p>
          </div>
          <div class="horario">
            Quarterão
            <p class="subtitle"> {{ $student->quarterao }}</p>
          </div>

        </div>
        <div class=" flex-group">
          <div>
            Contacto
            <p class="subtitle"> {{ $student->ntelefone }}</p>
          </div>
          <div class="horario">
            Nacionalidade
            <p class="subtitle"> {{ $student->nacionalidade }}</p>
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

            <p>{{ $student->nome }}</p>
            <smal>{{ $student->email }}</smal>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@stop