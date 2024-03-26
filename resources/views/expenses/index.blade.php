@extends('adminlte::page')

@section('title', 'Despesas')

@section('content_header')
@stop

<head>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
  .success-message {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: .25rem;
  }

  .add-dowloand {
    display: flex;
    gap: 1rem;

  }

  .actions {
    display: flex;
    justify-content: space-evenly;
  }



  button {
    background: none;
    border: none;
  }
  </style>
</head>



@section('content')
<br><br>
<div class="container-fluid">
  @if(session('success'))
  <div class="row success-message"">
    <p class=" success">{{session('success')}}</p>
  </div>
  @endif
  <div class="card  h-80">
    <div class="card-header">
      <h3 class="card-title">Lista de Despesas</h3>
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
        <div class="col-md-6 col-sm-6">
          <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3"> <i class="fas fa-fw fa-book"></i>+</a>

        </div>
        <div class="col-md-6 col-sm-6">
          <form action="{{ route('expenses.index') }}">
            <div class="input-group">

              <input type="search" value="{{$searchresult}}" id="searchInput" class="form-control form-control-md"
                placeholder="Pesquisar..." name="search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-md btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </div>
          </form>
        </div>
      </div>

      <section class="content col-md-12 col-sm-6">
        <div class="card">
          <div class="card-body">
            @if ($expenses->isEmpty())
            <div class="alert alert-info">
              Nenhum resultado encontrado para: {{ $searchresult }}
            </div>
            @else

            <div class="table-responsive">
              <table id="students" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Tipo transação</th>
                    <th>Descrição</th>
                    <th>valor</th>
                    <th>Data</th>
                    <th>Acções</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($expenses as $expense)
                  <tr>
                    <td>{{ $expense->id }}</td>
                    <td>{{ $expense->tipo }}</td>
                    <td>{{$expense->transacao}}</td>
                    <td>{{ $expense->descricao }}</td>
                    <td>{{ $expense->valor }}</td>
                    <td>


                      {{ \Carbon\Carbon::parse($expense->data)->format('d-m-Y') }}</td>

                    <td>
                      <div class="actions">
                        <div>
                          <a href="{{ route('expenses.show', $expense->id) }}">
                            <span class="btn btn-info material-symbols-outlined">
                              visibility
                            </span>
                          </a>
                        </div>
                        <div>
                          <a class="btn btn-success" href="{{ route('expenses.edit', $expense->id) }}">
                            <span class="material-symbols-outlined">
                              edit
                            </span>
                          </a>
                        </div>
                        <div>
                          @can('accessAdmin')


                          <form action="{{ route('expenses.destroy', $expense ->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"
                              onclick="return confirm('Você tem certeza quer apagar esta despesa?')">
                              <span class="material-symbols-outlined">
                                delete
                              </span></button>

                          </form>
                          @endcan
                        </div>
                      </div>


                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endif
            </div>
          </div>
        </div>
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">

            @if ($expenses->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $expenses->previousPageUrl() }}" rel="prev">&laquo;</a>
            </li>
            @endif


            @for ($i = 1; $i <= $expenses->lastPage(); $i++)
              <li class="page-item {{ $i == $expenses->currentPage() ? 'active' : '' }}"><a class="page-link"
                  href="{{ $expenses->url($i) }}">{{ $i }}</a></li>
              @endfor


              @if ($expenses->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $expenses->nextPageUrl() }}" rel="next">&raquo;</a>
              </li>
              @else
              <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
              @endif
          </ul>
        </div>
      </section>


    </div>
    <!-- /.card-body -->
  </div>

</div>


<!-- /.container-fluid -->
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
document.getElementById("searchInput").addEventListener("input", function() {

  var searchTerm = this.value.trim();
  window.location.href = "{{ route('expenses.index') }}?searchresult=" + searchTerm;
});
</script>
@stop