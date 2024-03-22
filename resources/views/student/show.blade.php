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

  .img {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;

    height: 100%;

  }

  .imgs {
    text-align: center;
  }

  #preview {
    clip-path: circle();
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
    <div class="col-md-3">
      <div class="card-body">

        <div class="row imgs">
          <div class="img" style="display: flex; justify-content: center; align-items: center;">
            <img id="preview" src="{{ old('img') ? asset(old('img')) : asset('storage/img/'.$student->img) }}"
              class="img-fluid img-thumbnail preview-image" onclick="openPopup(this.src);">
            <div class="info">

              <p>{{ $student->nome }}</p>
              <smal>{{ $student->email }}</smal>
            </div>
          </div>



        </div>
      </div>
    </div>
    <div class="col-md-6">


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
            <p class="subtitle"> {{ $province->nome }}</p>
          </div>
          <div class="horario">
            Distrito
            <p class="subtitle"> {{ $district->nome }}</p>
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

  </div>

</div>
@stop

<script>
function openPopup(imageSrc) {
  window.open(imageSrc, 'popup', 'width=600,height=400');
}
</script>