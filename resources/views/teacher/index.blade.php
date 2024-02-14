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
      <h3 class="card-title">Lista de Professores</h3>
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
        <div class="col-md-6">
          <a href="{{ route('teacher.create') }}" class="btn btn-primary mb-3 ">
            <i class="fas fa-chalkboard-teacher"></i>
            +
          </a>
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
                  <th>Endereço</th>
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
                  <td>{{ $teacher->endereco }}</td>
                  <td>{{ $teacher->telefone }}</td>
                  <td>{{ $teacher->tipodoc }} : {{ $teacher->numerodoc }}</td>
                  <td>
                    <a href="{{ route('teacher.show', $teacher->id) }}">Ver</a>
                    <a href="{{ route('teacher.edit', $teacher->id) }}">Edit</a>
                    <form action="{{ route('teacher.destroy', $teacher ->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @endif
          </div>
          {{ $teachers->links() }}
        </div>
      </section>

    </div>
    <!-- /.card-body -->
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
document.getElementById("searchInput").addEventListener("input", function() {
  var searchTerm = this.value.trim();
  window.location.href = "{{ route('teacher.index') }}?searchresult=" + searchTerm;
});
</script>
@stop