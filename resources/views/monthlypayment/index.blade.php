@extends('adminlte::page')

@section('title', 'Mensalidades')

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
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Lista de Mensalidades</h3>
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
          <form action="{{ route('monthlypayment.index') }}">
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
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($monthlypayments as $monthlypayment)
                  <tr>
                    <td>{{ $monthlypayment->id }}</td>
                    <td setTimeout(function() { document.getElementById('success-message').style.display='none' ; },
                      3000);>{{ $monthlypayment->student }}
                    </td>

                    <td>{{ $monthlypayment->course }}</td>
                    </td>
                    <td>
                      <a href="{{ route('monthlypayment.show', $monthlypayment->id) }}">Ver</a>
                      <a href="{{ route('monthlypayment.edit', $monthlypayment->id) }}">Edit</a>

                    </td>


                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
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
  window.location.href = "{{ route('monthlypayment.index') }}?searchresult=" + searchTerm;
});
</script>
@stop