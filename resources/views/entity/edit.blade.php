@extends('adminlte::page')

@section('title', 'Curso')

@section('content_header')
@stop

@section('content')
<br><br>
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Cadastrar um curso</h3>
      <div class="card-tools">
        <!-- Botão Fechar -->
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
        <!-- Botão Minimizar -->
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <!-- Botão Maximizar -->
        <button type="button" class="btn btn-tool" data-card-widget="maximize">
          <i class="fas fa-expand"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form role="form" method="POST" action="{{ route('course.update', $course->id )}}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="code_course">Codigo do curso:</label>
                    <input type="text" class="form-control" id="code_course" name="code_course" required
                      placeholder="Digite o codigo do curso" value="{{$course->code_course}}">
                  </div>
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required
                      value="{{$course->nome}}">
                  </div>
                  <div class="form-group">
                    <label for="nivel">Nível do Curso:</label>
                    <select id="nivel" name="nivel" value="{{$course->nivel}}" class="form-control">
                      <option selected disabled> Selecione um nivel</option>
                      <option value="Básico">Básico</option>
                      <option value="Intermediário">Intermediário</option>
                      <option value="Avançado">Avançado</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="descricao" class="form-control" id="descricao" name="descricao"
                      value="{{$course->descricao}}" placeholder="Digite a descrição" required>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="price_enrollemnt">Preço da matricula:</label>
                    <input type="number" min="500" max="500" class="form-control" id="price_enrollemnt"
                      name="price_enrollemnt" required placeholder="Digite o preço da Matricula"
                      value="{{$course->price_enrollemnt}}">
                  </div>
                  <div class="form-group">
                    <label for="price_enrollemnt">Preço da Inscrição:</label>
                    <input type="number" min="100" max="250" class="form-control" id="price_subscrab"
                      name="price_subscrab" required placeholder="Digite o preço da Inscrição"
                      value="{{$course->price_subscrab}}">
                  </div>
                  <div class=" form-group">
                    <label for="price_pfees">Preço da Mensalidade:</label>
                    <input type="number" min="1000" max="1000" class="form-control" id="price_pfees" name="price_pfees"
                      required placeholder="Digite o preço da Mensalidade" value="{{$course->price_pfees}}">
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
          </form>

        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.container-fluid -->
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
console.log('Hi!');
</script>
@stop