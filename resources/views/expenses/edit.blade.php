@extends('adminlte::page')

@section('title', 'Dispesa')

@section('content_header')
@stop

@section('content')
<br><br>
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Criar Nova Despesa</h3>
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
          <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="tipo">Tipo</label>
              <select class="form-control" id="tipo" name="tipo" required>
                <option value="">Selecione o tipo de despesa</option>
                <option value="materiais" {{ $expense->tipo === 'materiais' ? 'selected' : '' }}>Materiais</option>
                <option value="pagamento professores"
                  {{ $expense->tipo === 'pagamento professores' ? 'selected' : '' }}>Pagamento de Professores</option>
                <option value="agua" {{ $expense->tipo === 'agua' ? 'selected' : '' }}>Pagamento de Água</option>
                <option value="energia" {{ $expense->tipo === 'energia' ? 'selected' : '' }}>Pagamento de Energia
                </option>
                <option value="aluguel" {{ $expense->tipo === 'aluguel' ? 'selected' : '' }}>Pagamento de Aluguel
                </option>
              </select>
            </div>


            <div class="form-group">
              <label for="tipo">Tipo de Transação</label>
              <select class="form-control" id="transacao" name="transacao" required>
                <option value="">Selecione o tipo de transação</option>
                <option value="Entrada" {{ $expense->transacao === 'Entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="Saida" {{ $expense->transacao === 'Saida' ? 'selected' : '' }}>Saída</option>
              </select>
            </div>

            <div class="form-group">
              <label for="valor">Valor</label>
              <input type="number" step="0.01" value="{{$expense->valor}}" class="form-control" id="valor" name="valor"
                required>
            </div>

            <div class="form-group">
              <label for="data">Data</label>
              <input type="date" class="form-control" id="data" value="{{$expense->data}}" name="data" required>
            </div>

            <div class="form-group">
              <label for="descricao">Descrição</label>
              <textarea class="form-control" id="descricao" name="descricao"
                rows="3">{{ $expense->descricao }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
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