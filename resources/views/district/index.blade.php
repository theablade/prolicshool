@extends('adminlte::page')

@section('title', 'Disciplinas')

@section('content_header')
@stop

@section('content')
<br><br>
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Lista de discilinas</h3>
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
          <a href="{{ route('district.create') }}" class="btn btn-primary mb-3">+ Distrito <i
              class="far fa-map"></i></a>

        </div>
        <div class="col-md-6 col-sm-6">
          <form action="{{ route('district.index') }}">
            <div class="input-group">
              <input type="search" id="searchInput" value="{{$searchdistrict}}" class="form-control form-control-md"
                placeholder="Pesquisar..." name="searchdistrict">
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

            <table id="students" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>


                </tr>
              </thead>
              <tbody>
                @foreach ($districts as $district)
                <tr>
                  <td>{{ $district->id }}</td>
                  <td>{{ $district->nome }}</td>


                  <td>

                    <a href="{{ route('district.edit', $district->id) }}">Edit</a>
                    <form action="{{ route('district.destroy', $district ->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        onclick="return confirm('Você tem certeza que apagar essa provincia?')">Delete</button>
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

            @if ($districts->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $districts->previousPageUrl() }}" rel="prev">&laquo;</a>
            </li>
            @endif


            @for ($i = 1; $i <= $districts->lastPage(); $i++)
              <li class="page-item {{ $i == $districts->currentPage() ? 'active' : '' }}"><a class="page-link"
                  href="{{ $districts->url($i) }}">{{ $i }}</a></li>
              @endfor


              @if ($districts->hasMorePages())
              <li class="page-item"><a class="page-link" href="{{ $districts->nextPageUrl() }}" rel="next">&raquo;</a>
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
  window.location.href = "{{ route('district.index') }}?searchdistrict=" + searchTerm;
});
</script>
@stop