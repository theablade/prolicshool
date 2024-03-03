@extends('adminlte::page')

@section('title', 'Professor')

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
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Lista de professores</h3>
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
        <div class="col-md-6 add-dowloand">
          <a href="{{ route('teacher.create') }}" class="btn btn-primary mb-3 ">
            <i class="fas fa-chalkboard-teacher"></i>
            +
          </a>
          <div class="col-md-2 col-sm-6">
            @if ($searchresult)
            <a href="{{ route('teacher.pdf', ['parametro' => $searchresult]) }}"><span
                class="btn btn-secondary mb-3 material-symbols-outlined">
                picture_as_pdf
              </span></a>
            @else
            <a href="{{ route('teacher.pdf') }}"><span class="btn btn-secondary mb-3 material-symbols-outlined">
                picture_as_pdf
              </span></a>
            @endif

          </div>
        </div>
        <div class="col-md-6  col-sm-6 ">
          <form action="{{ route('teacher.index') }}">
            <div class="input-group">
              <input type="search" class="form-control form-control-md" id="searchInput" value="{{$searchresult}}"
                placeholder="Pesquisar..." name="searchresult">
              <div class="input-group-append">
                <button type="submit" class="btn btn-md  btn-default">
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
            @if ($teachers->isEmpty())
            <div class="alert alert-info">
              Nenhum resultado encontrado para: {{ $searchresult }}
            </div>
            @else
            <table id="students" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Email</th>

                  <th>Telefone</th>
                  <th>Documento</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($teachers as $teacher)
                <tr>
                  <td>{{ $teacher->id }}</td>
                  <td>{{ $teacher->nome }}</td>
                  <td>{{ $teacher->email }}</td>

                  <td>{{ $teacher->ntelefone }}</td>
                  <td>{{ $teacher->tipodoc }} : {{ $teacher->numerodoc }}</td>

                  <td>
                    <div class="actions">
                      <div>
                        <a href="{{ route('teacher.show', $teacher->id) }}">
                          <span class="btn btn-info material-symbols-outlined">
                            visibility
                          </span>
                        </a>
                      </div>
                      <div>
                        <a class="btn btn-success" href="{{ route('teacher.edit', $teacher->id) }}">
                          <span class="material-symbols-outlined">
                            edit
                          </span>
                        </a>
                      </div>
                      <div>
                        <form action="{{ route('teacher.destroy', $teacher ->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"
                            onclick="return confirm('Tem certeza que quer apagar as informações deste professor?')">
                            <span class="material-symbols-outlined">
                              delete
                            </span></button>
                      </div>

                      </form>
                    </div>



                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @endif
          </div>
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">

              @if ($teachers->onFirstPage())
              <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
              @else
              <li class="page-item"><a class="page-link" href="{{ $teachers->previousPageUrl() }}"
                  rel="prev">&laquo;</a>
              </li>
              @endif


              @for ($i = 1; $i <= $teachers->lastPage(); $i++)
                <li class="page-item {{ $i == $teachers->currentPage() ? 'active' : '' }}"><a class="page-link"
                    href="{{ $teachers->url($i) }}">{{ $i }}</a></li>
                @endfor


                @if ($teachers->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $teachers->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
                @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
          </div>
        </div>
    </div>
    </section>

  </div>

</div>
</div>

</div>

</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
document.getElementById("searchInput").addEventListener("input", function() {
  var searchTerm = this.value.trim();
  window.location.href = "{{ route('teacher.index') }}?searchresult=" + searchTerm;
});
</script>
@stop