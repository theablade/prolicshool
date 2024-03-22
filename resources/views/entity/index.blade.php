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
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Lista de courses</h3>
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
      <!-- Adicione o botão de adicionar novo estudante aqui -->

      <div class="row">
        <div class="col-md-6 col-sm-6">
          <a href="{{ route('course.create') }}" class="btn btn-primary mb-3"> <i class="fas fa-fw fa-book"></i>+</a>

        </div>
        <div class="col-md-6 col-sm-6">
          <form action="{{ route('course.index') }}">
            <div class="input-group">
              <input type="search" id="searchInput" value="{{$searchcurso}}" class="form-control form-control-md"
                placeholder="Pesquisar..." name="searchcurso">
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
            @if ($courses->isEmpty())
            <div class="alert alert-info">
              Nenhum resultado encontrado para: {{ $searchcurso }}
            </div>
            @else
            <table id="students" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Matricula</th>
                  <th>Mensalidade</th>
                  <th>Acções</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($courses as $course)
                <tr>
                  <td>{{ $course->id }}</td>
                  <td>{{ $course->nome }}</td>
                  <td>{{ $course->descricao }}</td>
                  <td>{{ $course->price_enrollemnt }}</td>
                  <td>{{ $course->price_pfees }}</td>
                  <td>
                    <div class="actions">
                      <div>
                        <a href="{{ route('course.show', $course->id) }}">
                          <span class="btn btn-info material-symbols-outlined">
                            visibility
                          </span>
                        </a>
                      </div>
                      <div>
                        <a class="btn btn-success" href="{{ route('course.edit', $course->id) }}">
                          <span class="material-symbols-outlined">
                            edit
                          </span>
                        </a>
                      </div>
                      <div>
                        <form action="{{ route('course.destroy', $course ->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"
                            onclick="return confirm('Você tem certeza quer apagar este Curso?')">
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

            @if ($courses->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $courses->previousPageUrl() }}" rel="prev">&laquo;</a>
            </li>
            @endif


            @for ($i = 1; $i <= $courses->lastPage(); $i++)
              <li class="page-item {{ $i == $courses->currentPage() ? 'active' : '' }}"><a class="page-link"
                  href="{{ $courses->url($i) }}">{{ $i }}</a></li>
              @endfor


              @if ($courses->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $courses->nextPageUrl() }}" rel="next">&raquo;</a>
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
document.getElementById("searchInput").addEventListener("input", function() {

  var searchTerm = this.value.trim();
  window.location.href = "{{ route('course.index') }}?searchcourse=" + searchTerm;
});
</script>
@stop