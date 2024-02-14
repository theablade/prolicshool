@extends('adminlte::page')

@section('title', 'Editar Matricula')

@section('content_header')

@stop

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title text-center text-2xl">Editar informações do Aluno</h3>
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
        <div class="card-body">
          <form action="{{ route('enrollent.update', $enrollent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" class="form-control" id="nome" name="nome" value="{{ $enrollent->nome }}">
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" id="email" name="email" value="{{ $enrollent->email }}">
                  <div class="form-group">
                    <label for="genero">Gênero</label>
                    <select name="genero" id="genero" class="form-control select2" style="width: 100%;" name="genero"
                      id="genero">

                      <option value="" disabled selected>Selecione um gênero</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">Feminino</option>
                    </select>


                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <label for="nome">Endereco:</label>
                <input type="text" class="form-control" id="endereco" name="endereco"
                  value="{{ $enrollent->endereco }}">
                <label for="nome">Telefone:</label>
                <input type="text" class="form-control" id="ntelefone" name="ntelefone"
                  value="{{ $enrollent->ntelefone }}">
                <label for="tipodoc">Tipo de doc:</label>
                <input type="text" class="form-control" id="tipodoc" name="tipodoc" value="{{ $enrollent->tipodoc }}">
                <label for="numerodoc">Numero do doc:</label>
                <input type="text" class="form-control" id="numerodoc" name="numerodoc"
                  value="{{ $enrollent->numerodoc }}">
              </div>
            </div>



            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop