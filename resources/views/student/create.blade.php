@extends('adminlte::page')

@section('title', 'Student')

@section('content_header')
@stop

@section('content')

<head>
  <style>
  .input-img-preview {
    width: 150px;
    height: 150px;
    display: inline-block;
    overflow: hidden;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #ccc;
  }

  .input-img-preview img {
    width: 100%;
    height: 100%;
  }
  </style>
</head>
<br><br>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Cadastrar novo estudante</h3>
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
        <div class="col-md-12">
          <form role="form" method="POST" action="{{ route('student.store') }}">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="img">Imagem</label>
                    <div class="input-group">
                      <input type="file" class="form-control" id="img" name="img" onchange="previewImage(event)"
                        required style="display: none;">
                      <label for="img" class="input-img-preview">
                        <img id="imagePreview" src="#" alt="Preview"
                          style="max-width: 100%; max-height: 200px; border-radius: 50%; object-fit: cover;">
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" value="{{old('nome')}}" class="form-control" id="nome" name="nome"
                        placeholder="Digite o nome" required>
                    </div>
                  </div>
                  <div class="input-group mb-3" bis_skin_checked="1">
                    <div class="input-group-prepend" bis_skin_checked="1">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" value="{{old('email')}}" class="form-control" id="email" name="email"
                      placeholder="Digite o e-mail" required>
                  </div>


                  <div class="form-group">
                    <label for="genero">Gênero</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="genero" id="genero">
                          <option value="" disabled selected>Selecione um gênero</option>
                          <option {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                          <option {{ old('genero') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                        </select>
                      </div>

                    </div>
                  </div>


                  <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <span id="ageMessage" style="color:red;"></span>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="tipodoc">Tipo de Documento:</label>
                    <select class="form-control select2" style="width: 100%;" name="tipodoc" id="tipodoc"
                      onchange="calculateExpiryDate(); checkExpiryDate(this.value)">

                      <option value="rg">RG</option>
                      <option value="cpf">CPF</option>
                      <option value="bi">BI</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div id="message" style="color:red;"></div>
                    <label for="data_emisao">Data de emissão:</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control" id="data_emisao" name="data_emisao"
                        onchange="calculateExpiryDate(); checkExpiryDate();" required>

                    </div>
                  </div>

                  <div class="form-group">
                    <label for="data_validade">Data de validade:</label>
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control" id="data_validade" name="data_validade"
                        onchange="checkExpiryDate()" required>

                    </div>
                  </div>

                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="provincia">Província</label>
                    <select class="form-control select2" style="width: 100%;" name="provincia" id="provinciaSelect">
                      <option value="" disabled selected>Selecione a Província</option>
                      @foreach ($provinces as $province)
                      <option value="{{$province->province_id}}">{{$province->nome}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="distrito">Distrito</label>
                    <select class="form-control select2" style="width: 100%;" name="distrito" id="distritoSelect">
                      <option value="" disabled selected>Selecione o distrito</option>
                      @foreach ($districts as $district)
                      <option value="{{$district->province_id}}">{{$district->nome}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="ntelefone">Número de telefone</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="number" class="form-control" value="{{old('ntelefone')}}" id="ntelefone"
                        name="ntelefone" placeholder="+258 " required minlength="9">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                      </div>
                      <input type="text" value="{{old('endereco')}}" class="form-control" id="endereco" name="endereco"
                        placeholder="Digite o endereço" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="nacionalidade">Nacionalidade</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                      </div>
                      <input type="text" value="{{old('nacionalidade')}}" class="form-control" id="nacionalidade"
                        name="nacionalidade" placeholder="Digite a nacionalidade" required>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>

        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>

  <!-- /.container-fluid -->
  @stop

  @section('css')

  <link rel="stylesheet" href="/css/admin_custom.css">
  @stop

  @section('js')
  <script>
  document.getElementById("data_nascimento").addEventListener("change", function() {
    var birthDate = new Date(this.value);
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }

    if (age <= 10) {
      document.getElementById("ageMessage").innerHTML = "O estudante deve ter pelo menos 10 anos de idade!";
    } else {
      document.getElementById("ageMessage").innerHTML = "";
    }
  });

  var calculatedTypeDocument;

  function calculateExpiryDate() {
    var typeDocument = document.getElementById('tipodoc').value;
    var emissionDateInput = document.getElementById('data_emisao');
    var expiryDateInput = document.getElementById('data_validade');
    var expiryMessage = document.getElementById('message');

    if (typeDocument === 'bi') {
      var emissionDate = new Date(emissionDateInput.value);
      var expiryDate = new Date(emissionDate);

      expiryDate.setFullYear(expiryDate.getFullYear() + 5);
      expiryDate.setDate(expiryDate.getDate() - 1);

      expiryDateInput.min = emissionDateInput.value;
      var formattedExpiryDate = expiryDate.toISOString().split('T')[0];
      expiryDateInput.value = formattedExpiryDate;
      calculatedTypeDocument = typeDocument;
    }
  }

  function checkExpiryDate() {
    var emissionDateInput = document.getElementById('data_emisao').value;
    var expiryDateInput = document.getElementById('data_validade').value;
    var expiryMessage = document.getElementById('message');

    if (emissionDateInput && expiryDateInput) {
      var emissionDate = new Date(emissionDateInput);
      var expiryDate = new Date(expiryDateInput);
      var today = new Date();
      var differenceInYears = expiryDate.getFullYear() - emissionDate.getFullYear();

      var minDifferenceYears = (calculatedTypeDocument === 'bi') ? 5 : 4; // 
      if (differenceInYears < minDifferenceYears) {
        expiryMessage.innerHTML =
          "A data de validade deve ser pelo menos " + minDifferenceYears + " anos após a data de emissão!";
      } else {
        expiryMessage.innerHTML = "";
      }
      if (expiryDate < today) {
        expiryMessage.innerHTML = "O documento expirou!";
      }
    }
  }


  function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var output = document.getElementById('imagePreview');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
  </script>
  @stop