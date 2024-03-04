@extends('adminlte::page')

@section('title', 'Disciplinas')

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

  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Lista de discilinas</h3>
      <div class="card-tools">

        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>

        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>

        <button type="button" class="btn btn-tool" data-card-widget="maximize">
          <i class="fas fa-expand"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <a href="{{ route('discipline.create') }}" class="btn btn-primary mb-3"> <i
              class="fas fa-fw fa-book"></i>+</a>

        </div>
        <div class="col-md-6 col-sm-6">
          <form action="{{ route('discipline.index') }}">
            <div class="input-group">
              <input type="search" id="searchInput" value="{{$searchdiscipline}}" class="form-control form-control-md"
                placeholder="Pesquisar..." name="searchdiscipline">
              <div class="input-group-append">
                <button type="submit" class="btn btn-md btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <section class="content">
        <div class="card">
          <div class="card-body">
            @if ($disciplines->isEmpty())
            <div class="alert alert-info">
              Nenhum resultado encontrado para: {{ $searchdiscipline }}
            </div>
            @else
            <table id="students" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Descricao</th>
                  <th>Acções</th>



                </tr>
              </thead>
              <tbody>
                @foreach ($disciplines as $discipline)
                <tr>
                  <td>{{ $discipline->id }}</td>
                  <td>{{ $discipline->nome }}</td>
                  <td>{{ $discipline->descricao }}</td>

                  <td>
                    <div class="actions">
                      <div>
                        <a href="{{ route('discipline.show', $discipline->id) }}">
                          <span class="btn btn-info material-symbols-outlined">
                            visibility
                          </span>
                        </a>
                      </div>
                      <div>
                        <a class="btn btn-success" href="{{ route('discipline.edit', $discipline->id) }}">
                          <span class="material-symbols-outlined">
                            edit
                          </span>
                        </a>
                      </div>
                      <div>
                        <form action="{{ route('discipline.destroy', $discipline ->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"
                            onclick="return confirm('Você tem certeza quer apagar esta disciplina?')">
                            <span class="material-symbols-outlined">
                              delete
                            </span></button>

                        </form>
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
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <!-- Previous Page Link -->
            @if ($disciplines->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $disciplines->previousPageUrl() }}"
                rel="prev">&laquo;</a></li>
            @endif

            <!-- Pagination Elements (Numeros de pagina) -->
            @for ($i = 1; $i <= $disciplines->lastPage(); $i++)
              <li class="page-item {{ $i == $disciplines->currentPage() ? 'active' : '' }}"><a class="page-link"
                  href="{{ $disciplines->url($i) }}">{{ $i }}</a></li>
              @endfor

              <!-- Next Page Link -->
              @if ($disciplines->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $disciplines->nextPageUrl() }}" rel="next">&raquo;</a>
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
<!-- /.card-body -->
</div>

<!-- 



<!-- /.card -->
</div>
<!-- /.container-fluid -->
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
// Aguarda o evento de digitação no campo de pesquisa
document.getElementById("searchInput").addEventListener("input", function() {

  var searchTerm = this.value.trim();
  window.location.href = "{{ route('discipline.index') }}?searchdiscipline=" + searchTerm;
});
</script>
@stop