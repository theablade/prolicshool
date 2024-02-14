@extends('adminlte::page')

@section('title', 'Student')

@section('content_header')
@stop

@section('content')

<head>

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

  @if(session('msg'))
  <div class="row success-message"">
    <p class=" msg">{{session('msg')}}</p>
  </div>
  @endif

</div>
<div class="container-fluid">
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Lista de Estudantes</h3>
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
        <div class="col-md-6 col-sm-6">
          <a href="{{ route('student.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-book-reader"></i> +
          </a>
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
                    <td>{{ $student->endereco }}</td>
                    <td>{{ $student->ntelefone }}</td>
                    <td>{{ $student->tipodoc}}: {{$student->numerodoc}}</td>
                    <td>
                      <a href="{{ route('student.show', $student->id) }}">Ver</a>
                      <a href="{{ route('student.edit', $student->id) }}">Edit</a>
                      <form action="{{ route('student.destroy', $student ->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                      </form>
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