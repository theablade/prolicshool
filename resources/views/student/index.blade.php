@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')
@stop

@section('content')

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
<br><br>
<div class="container-fluid">

  @if(session('msg'))
  <div class="row success-message"">
    <p class=" msg">{{session('msg')}}</p>
  </div>
  @endif

</div>

<div class="container-fluid">
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Lista de alunos</h3>
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
    <div class="card-body">
      <div class="row">

        <div class="col-md-6 add-dowloand col-sm-6">
          <a href="{{ route('student.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-book-reader"></i> +
          </a>
          <div class="col-md-2 col-sm-6">
            @if ($searchresult)
            <a href="{{ route('student.pdf', ['parametro' => $searchresult]) }}"><span
                class="btn btn-secondary mb-3 material-symbols-outlined">
                picture_as_pdf
              </span></a>
            @else
            <a href="{{ route('students.pdf') }}"><span class="btn btn-secondary mb-3 material-symbols-outlined">
                picture_as_pdf
              </span></a>
            @endif

          </div>
        </div>



        <div class="col-md-6 col-sm-6">
          <form action="{{ route('student.index') }}">
            <div class="input-group">
              <input type="search" value="{{$searchresult}}" id="searchInput" class="form-control form-control-md"
                placeholder="Pesquisar..." name="search">
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
            @if ($students->isEmpty())
            <div class="alert alert-info">
              Nenhum resultado encontrado para: {{ $searchresult }}
            </div>
            @else
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Documento</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($students as $student)
                  <tr>
                    <td>{{ $student->id }}</td>
                    <td setTimeout(function() { document.getElementById('success-message').style.display='none' ; },
                      3000);>{{ $student->nome }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->avenida }}</td>
                    <td>{{ $student->ntelefone }}</td>
                    @if ($student->tipodoc == "bi")

                    <td>
                      BI:
                      {{$student->numerodoc}}
                    </td>

                    @elseif($student->tipodoc == "cedula")
                    <td>
                      Cedula:
                      {{$student->numerodoc}}

                    </td>
                    @else
                    <td>
                      Cartão de eleitor:
                      {{$student->numerodoc}}

                    </td>
                    @endif

                    <td>
                      <div class="actions">
                        <div>

                          <a class="btn btn-info" href="{{ route('student.show', $student->id) }}"><span
                              class="material-symbols-outlined">
                              visibility
                            </span></a>
                        </div>
                        <div>

                          <a class="btn btn-success" href="{{ route('student.edit', $student->id) }}"><span
                              class="material-symbols-outlined">
                              edit
                            </span></a>
                        </div>
                        <form action="{{ route('student.destroy', $student ->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tens certeza que queres apagar esse estudante?')">
                            <span class="material-symbols-outlined">
                              delete
                            </span>
                          </button>
                        </form>
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

              @if ($students->onFirstPage())
              <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
              @else
              <li class="page-item"><a class="page-link" href="{{ $students->previousPageUrl() }}"
                  rel="prev">&laquo;</a>
              </li>
              @endif


              @for ($i = 1; $i <= $students->lastPage(); $i++)
                <li class="page-item {{ $i == $students->currentPage() ? 'active' : '' }}"><a class="page-link"
                    href="{{ $students->url($i) }}">{{ $i }}</a></li>
                @endfor


                @if ($students->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $students->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
                @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
          </div>
        </div>

      </section>
    </div>
  </div>
</div>
@stop

@section('css')
<link rel=" stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script>
setTimeout(function() {
  document.getElementById('success-message').style.display = 'none';
}, 3000);
document.getElementById("searchInput").addEventListener("input", function() {
  var searchTerm = this.value.trim();
  window.location.href = "{{ route('student.index') }}?searchresult=" + searchTerm;
});
</script>
@stop