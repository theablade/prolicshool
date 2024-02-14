@extends('adminlte::page')

@section('title', 'Professor')

@section('content_header')

@stop

@section('content')
<br><br>
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title text-center text-2xl">Editar informações do professor</h3>
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
          <form role="form" method="POST" action="{{ route('teacher.update', $teacher->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome"
                      value="{{$teacher->nome}}" required>
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail"
                      value="{{$teacher->email}}" required>
                  </div>

                  <div class="form-group">
                    <label for="genero">Gênero</label>
                    <select name="genero" value="{{$teacher->genero}}" id="genero">
                      <option value="" selected>Selecione um gênero</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">Feminino</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" value="{{$teacher->data_nascimento}}"
                      name="data_nascimento" required>
                  </div>
                  <div class="form-group">
                    <label for="tipodoc">Tipo de documento</label>
                    <select name="tipodoc" value="{{$teacher->tipodoc}}" id="tipodoc">
                      <option value="" selected>Selecione o tipo</option>
                      <option value="bi">B.I</option>
                      <option value="cartaoleitor">Cartão de Eleitor</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="numerodoc">Número do documento</label>
                    <input type="text" value="{{$teacher->numerodoc}}" class="form-control" id="numerodoc"
                      name="numerodoc" placeholder="Digite o número do documento" required>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" value="{{$teacher->endereco}}" class="form-control" id="endereco" name="endereco"
                      placeholder="Digite o endereço" required>
                  </div>
                  <div class="form-group">
                    <label for="telefone">Número de telefone</label>
                    <input type="tel" class="form-control" id="telefone" value="{{$teacher->telefone}}" name="telefone"
                      placeholder="+258 " required>
                  </div>
                  <div class="form-group">
                    <label for="disciplina">Disciplina</label>
                    <input type="tel" class="form-control" id="disciplina" name="disciplina" placeholder="+258 "
                      value="{{$teacher->disciplina}}" required>
                  </div>
                  <div class="form-group">
                    <label for="data_contratacao">Data da contratação </label>
                    <input type="date" class="form-control" id="data_contratacao" name="data_contratacao"
                      value="{{$teacher->data_contratacao}}" required>
                  </div>

                  <div class="form-group">
                    <label for="salario">Salario</label>
                    <input type="text" class="form-control" id="salario" name="salario" value="{{$teacher->salario}}"
                      placeholder="Digite o salario" required>
                  </div>



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