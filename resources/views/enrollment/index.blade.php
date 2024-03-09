@extends('adminlte::page')

@section('title', 'Matricula')

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

  @if(session('msg'))
  <div class="row success-message"">
    <p class=" msg">{{session('msg')}}</p>
  </div>
  @endif

</div>
<div class="container-fluid">
  <div class="card w-100 h-80">
    <div class="card-header">
      <h3 class="card-title">Lista de Inscrições</h3>
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
          <div class="row">
            <a href="{{ route('enrollment.create') }}" class="btn btn-primary mb-3">
              <i class="fas fa-book-reader"></i> +
            </a>
            <div class="col-md-2">

              @if ($searchresult)
              <a href="{{ route('enrollment.pdf', ['parametro' => $searchresult]) }}" target="_blank"><span
                  class="btn btn-secondary mb-3 material-symbols-outlined">
                  picture_as_pdf
                </span></a>
              @else
              <a href="{{ route('enrollments.pdf') }}" target="_blank"><span
                  class="btn btn-secondary mb-3 material-symbols-outlined">
                  picture_as_pdf
                </span></a>
              @endif


            </div>
          </div>

        </div>

        <div class="col-md-6 col-sm-6">
          <form action="{{ route('enrollment.index') }}">
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

            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Mensalidade</th>
                    <th>Inscrição</th>
                    <th>Status</th>
                    <th>Acções</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($enrollments as $enrollment)
                  <tr>
                    <td>{{ $enrollment->id }}</td>
                    <td setTimeout(function() { document.getElementById('success-message').style.display='none' ; },
                      3000);>{{ $enrollment->student }}</td>
                    <td>{{ $enrollment->course }}</td>
                    <td>{{ $enrollment->price_enrollemnt }}</td>
                    <td>{{ $enrollment->price_subscrab }}</td>
                    <td>

                      @if($enrollment->status =="Activo")
                      <span class="badge badge-primary p-2">
                        {{ $enrollment->status}}
                      </span>
                      @elseif($enrollment->status =="Pendente")
                      <span class="badge badge-info p-2">
                        {{ $enrollment->status}}
                      </span>
                      @else
                      <span class="badge badge-danger p-2">
                        {{ $enrollment->status}}
                      </span>
                      @endif
                    </td>
                    <td>
                      <div class="actions">
                        <div>
                          <a href="{{ route('enrollment.show', $enrollment->student_id) }}">
                            <span class="btn btn-info material-symbols-outlined">
                              visibility
                            </span>
                          </a>
                        </div>
                        <div>
                          <a href="{{ route('enrollment.pdfr', $enrollment->student_id) }}">
                            Recibo
                          </a>
                        </div>
                        <form action="{{ route('enrollment.destroy', $enrollment ->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          @if($enrollment->status =="Activo")
                          <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Você deseja cancelar a matricula?')">Cancelar</button>
                          @elseif($enrollment->status =="Cancelada")
                          <button type="submit" class="btn btn-success"
                            onclick="return confirm('Você deseja Activar a matricula?')">Activar</button>
                          @else
                          <button type="submit"
                            onclick="return confirm('Você deseja Activar a matricula?')">Activar</button>
                          @endif
                        </form>



                    </td>


                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">

              @if ($enrollments->onFirstPage())
              <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
              @else
              <li class="page-item"><a class="page-link" href="{{ $enrollments->previousPageUrl() }}"
                  rel="prev">&laquo;</a>
              </li>
              @endif


              @for ($i = 1; $i <= $enrollments->lastPage(); $i++)
                <li class="page-item {{ $i == $enrollments->currentPage() ? 'active' : '' }}"><a class="page-link"
                    href="{{ $enrollments->url($i) }}">{{ $i }}</a></li>
                @endfor


                @if ($enrollments->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $enrollments->nextPageUrl() }}"
                    rel="next">&raquo;</a>
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
  window.location.href = "{{ route('enrollment.index') }}?searchresult=" + searchTerm;
});
</script>
@stop