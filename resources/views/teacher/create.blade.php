@extends('adminlte::page')

@section('title', 'Professor')

@section('content_header')
@stop

@section('content')

<head>

  <style>
  .btns {
    display: flex;
    gap: 1rem;
  }

  .animated-button {
    position: relative;
    display: flex;
    align-items: center;
    gap: 2px;
    padding: 10px 26px;
    border: 4px solid;
    border-color: transparent;
    font-size: 16px;
    background-color: inherit;
    border-radius: 100px;
    font-weight: 600;
    color: #007bff;
    box-shadow: 0 0 0 2px #007bff;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button svg {
    position: absolute;
    width: 24px;
    fill: #007bff;
    z-index: 9;
    transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button .arr-1 {
    right: 16px;
  }

  .animated-button .arr-2 {
    left: -25%;
  }

  .animated-button .circle {
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    background-color: #007bff;
    border-radius: 50%;
    opacity: 0;
    transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button .text {
    position: relative;
    z-index: 1;
    transform: translateX(-12px);
    transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button:hover {
    box-shadow: 0 0 0 12px transparent;
    color: #212121;
    border-radius: 12px;
  }

  .animated-button:hover .arr-1 {
    right: -25%;
  }

  .animated-button:hover .arr-2 {
    left: 16px;
  }

  .animated-button:hover .text {
    transform: translateX(12px);
  }

  .animated-button:hover svg {
    fill: #212121;
  }

  .animated-button:active {
    scale: 0.95;
    box-shadow: 0 0 0 4px #007bff;
  }

  .animated-button:hover .circle {
    width: 220px;
    height: 220px;
    opacity: 1;
  }

  .input-img-preview {
    width: 150px;
    height: 150px;
    display: inline-block;
    overflow: hidden;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #ccc;
  }

  .input-img-preview {
    width: 150px;
    height: 150px;
    display: inline-flex;
    /* Alteração */
    justify-content: center;
    /* Adição */
    align-items: center;
    /* Adição */
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
<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0"
    aria-valuemax="100" style="width:40%" id="progress">

  </div>
</div>
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Inscrever um professor</h3>
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
          <form role="form" method="POST" action="{{ route('teacher.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

              <div id="step">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="img">Imagem</label>
                      <div class="input-group text-center">
                        <input type="file" class="form-control" id="img" name="img" onchange="previewImage(event)"
                          style="display: none;">
                        <label for="img" class="input-img-preview">
                          <img id="imagePreview" src="#" alt="Foto Professor"
                            style="max-width: 100%; max-height: 200px; border-radius: 50%; object-fit: cover;">
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <h4 class="text-bold">Dados pessoais</h4>
                    <div class="form-group">
                      <label for="nome">Nome do professor</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" value="{{old('nome')}}" class="form-control" id="nome" name="nome"
                          placeholder="Digite o nome" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email *</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email"
                          placeholder="estudandt@exemplo.com " required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="genero">Gênero *</label>


                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="genero" id="genero">
                          <option value="" disabled selected>Selecione um gênero</option>
                          <option {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                          <option {{ old('genero') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                        </select>
                      </div>


                    </div>


                    <div class="form-group">
                      <label for="data_nascimento">Data de nascimento *</label>
                      <span id="ageMessage" style="color:red;"></span>
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tipodoc">Tipo de Documento: </label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="tipodoc" id="tipodoc"
                          onchange="calculateExpiryDate(); checkExpiryDate(this.value)">
                          <option value="" selected disabled>Selecione o tipo de documento</option>
                          <option value="cedula" data-icon="fas fa-id-card">Cedula</option>
                          <option value="cartão de eleitor" data-icon="far fa-address-card">Cartão de eleitor</option>
                          <option value="bi" data-icon="far fa-id-card">BI</option>
                        </select>
                      </div>
                    </div>

                    <div id="emissao">
                      <div class="form-group">
                        <div id="message" style="color:red;"></div>
                        <label for="data_emisao">Data de emissão: </label>
                        <div class="input-group">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="date" class="form-control" id="data_emisao" name="data_emisao"
                            onchange="calculateExpiryDate(); checkExpiryDate();">

                        </div>
                      </div>

                      <div class="form-group">
                        <label for="data_validade">Data de validade: </label>
                        <div class="input-group">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="date" class="form-control" id="data_validade" name="data_validade"
                            onchange="checkExpiryDate()">

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mt-4">
                    <div class="form-group">
                      <label for="tipodoc">Numero documento: </label>
                      <div class="input-group mb-3" bis_skin_checked="1">
                        <div class="input-group-prepend" bis_skin_checked="1">
                          <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                        </div>
                        <input type="text" value="{{old('numerodoc')}}" class="form-control" id="numerodoc"
                          name="numerodoc" placeholder="Digite o numero do documento" required>
                      </div>


                    </div>
                    <div class="form-group">
                      <label for="provincia">Natural de </label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-flag"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="provincia" id="provinciaSelect">
                          <option value="" disabled selected>Selecione a Província</option>
                          @foreach ($provinces as $province)
                          <option value="{{$province->province_id}}">{{$province->nome}}</option>
                          @endforeach
                        </select>
                      </div>

                    </div>

                    <div class="form-group">
                      <label for="distrito">Distrito </label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-flag"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="distrito" id="distritoSelect">
                          <option value="" disabled selected>Selecione o distrito</option>
                          @foreach ($districts as $district)
                          <option value="{{$district->id}}" data-provincia="{{$district->province_id}}">
                            {{$district->nome}}
                          </option>
                          @endforeach
                        </select>
                      </div>

                    </div>



                    <div class="form-group">
                      <label for="nacionalidade">Nacionalidade </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-flag"></i></span>
                        </div>
                        <input type="text" value="{{old('nacionalidade')}}" class="form-control" id="nacionalidade"
                          name="nacionalidade" placeholder="Digite a nacionalidade" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="ntelefone">Contacto </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" value="{{old('ntelefone')}}" id="ntelefone"
                          name="ntelefone" placeholder="+258 " required minlength="9">
                      </div>
                    </div>
                  </div>
                </div>
              </div>





              <div id="step" style="display: none;">
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="text-bold"> Dados de residência </h4>
                    <div class="form-group">
                      <label for="bairro">Bairro </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" value="{{old('bairro')}}" class="form-control" id="bairro" name="bairro"
                          placeholder="Digite o endereço" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="quarterao">Quarterão </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" value="{{old('quarterao')}}" class="form-control" id="quarterao"
                          name="quarterao" placeholder="Digite o endereço" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="avenida">Avenida </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" value="{{old('avenida')}}" class="form-control" id="avenida" name="avenida"
                          placeholder="Digite o endereço" required>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="provincia">Provincia </label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-flag"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="provincia" id="provinciaSelect">
                          <option value="" disabled selected>Selecione a Província</option>
                          @foreach ($provinces as $province)
                          <option value="{{$province->province_id}}">{{$province->nome}}</option>
                          @endforeach
                        </select>
                      </div>

                    </div>

                    <div class="form-group">
                      <label for="redistrito">Distrito </label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-flag"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="distrito" id="distritoSelect2">
                          <option value="" disabled selected>Selecione o distrito</option>
                          @foreach ($districts as $district)
                          <option value="{{$district->id}}" data-provincia="{{$district->province_id}}">
                            {{$district->nome}}
                          </option>
                          @endforeach
                        </select>
                      </div>

                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">Casa numero </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <input type="number" class="form-control" value="{{old('numero_casa')}}" id="numero_casa"
                          name="numero_casa" placeholder="Digite o numero de casa">
                      </div>
                    </div>

                    <hr>

                    <h4 class="text-bold">Horários </h4>
                    <div class="form-group">

                      <label for="horario">Horário das Aulas: </label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                        <select class="form-control" name="horario" id="horario">
                          <option value="" selected disabled>Selecione o horário das aulas</option>
                          <option value="07:00-08:30">07:00 - 08:30</option>
                          <option value="08:30-10:00">08:30 - 10:00</option>
                          <option value="10:00-11:30">10:00 - 11:30</option>
                          <option value="12:30-14:00">12:30 - 14:00</option>
                          <option value="14:00-15:30">14:00 - 15:30</option>
                          <option value="15:30-17:00">15:30 - 17:00</option>
                        </select>
                      </div>

                    </div>
                    <div class="form-group">
                      <label for="data_inscricao">Data do contrato </label>
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input class="form-control" type="text" id="data_contratacao" name="data_contratacao"
                          value="{{ $currentDateTime->toDateTimeString() }}" readonly>


                      </div>
                    </div>
                    <div class="form-group">
                      <label for="salario">Salario </label>
                      <div class="input-group">
                        <div class="input-group-append">

                          <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                        </div>
                        <input class="form-control" type="number" id="salario" name="salario"
                          value="{{ old('salario') }}">


                      </div>
                    </div>
                  </div>



                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
              </div>




            </div>

            <div class="float-right btns">
              <button id="previousBtn" class="animated-button"><i class="fa fa-arrow-left"
                  aria-hidden="true"></i></button>
              <button id="nextBtn" class="animated-button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js">
  </script>
  <script>
  $(document).ready(function() {

    $('#provinciaSelect').change(function() {
      var selectedProvince = $(this).val();


      $('#distritoSelect option').hide();


      $('#distritoSelect option[data-provincia="' + selectedProvince + '"]').show();
    });
  });

  $(document).ready(function() {

    $('#provinciaSelect2').change(function() {
      var selectedProvince = $(this).val();


      $('#distritoSelect2 option').hide();


      $('#distritoSelect2 option[data-provincia="' + selectedProvince + '"]').show();
    });
  });

  document.getElementById("data_nascimento").addEventListener("change", function() {
    var birthDate = new Date(this.value);
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    if (age <= 10) {
      document.getElementById("ageMessage").innerHTML = "O professor deve ter pelo menos 18 anos de idade!";
    } else {
      document.getElementById("ageMessage").innerHTML = "";
    }
  });
  var calculatedTypeDocument;
  var
    emissao = document.getElementById('emissao');
  emissao.style.display = 'none'

  function calculateExpiryDate() {
    var
      typeDocument = document.getElementById('tipodoc').value;
    var emissionDateInput = document.getElementById('data_emisao');
    var expiryDateInput = document.getElementById('data_validade');
    var emissao = document.getElementById('emissao');
    var
      expiryMessage = document.getElementById('message');
    if (typeDocument === 'bi') {
      emissao.style.display = 'block';
      var
        emissionDate = new Date(emissionDateInput.value);
      var expiryDate = new Date(emissionDate);
      expiryDate.setFullYear(expiryDate.getFullYear() + 5);
      expiryDate.setDate(expiryDate.getDate() - 1);
      expiryDateInput.min = emissionDateInput.value;
      var formattedExpiryDate = expiryDate.toISOString().split('T')[0];
      expiryDateInput.value = formattedExpiryDate;
      calculatedTypeDocument = typeDocument;
    } else if (typeDocument === 'cedula') {
      expiryMessage.innerHTML = "";
      emissao.style.display = 'none';
    }
  }

  function checkExpiryDate() {
    var
      emissionDateInput = document.getElementById('data_emisao').value;
    var
      expiryDateInput = document.getElementById('data_validade').value;
    var
      expiryMessage = document.getElementById('message');
    if (emissionDateInput && expiryDateInput) {
      var emissionDate = new
      Date(emissionDateInput);
      var expiryDate = new Date(expiryDateInput);
      var today = new Date();
      var
        differenceInYears = expiryDate.getFullYear() - emissionDate.getFullYear();
      var
        minDifferenceYears = (calculatedTypeDocument === 'bi') ? 5 : 4; // if (differenceInYears < minDifferenceYears) {
      expiryMessage.innerHTML = "A data de validade deve ser pelo menos " + minDifferenceYears +
        " anos após a data de emissão!";
    } else {
      expiryMessage.innerHTML = "";
    }
    if (expiryDate < today) {
      expiryMessage.innerHTML = "O documento expirou!";
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
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('previousBtn').disabled = true;
    var currentStep = 1;
    var totalSteps = 2;

    function
    updateButtonVisibility() {
      if (currentStep === 1) {
        document.getElementById('previousBtn').disabled = true;
        document.querySelector('.progress-bar').style.width = '50%';
        document.getElementById('progress').innerHTML = '50% (Concluido)'
        document.getElementById('nextBtn').disabled = false;
      } else if (currentStep === totalSteps) {
        document.getElementById('previousBtn').disabled = false;
        document.getElementById('nextBtn').disabled = true;
        document.getElementById('progress').innerHTML = '100% (Concluido)'
        document.querySelector('.progress-bar').style.width = '100% ';
      } else {
        document.getElementById('previousBtn').disabled = false;
        document.getElementById('nextBtn').disabled = false;
        document.querySelector('.progress-bar').style.width = '50%';
      }
    }

    function nextStep() {
      currentStep++;
      updateButtonVisibility();
      updateStepDisplay();
    }

    function previousStep() {
      currentStep--;
      updateButtonVisibility();
      updateStepDisplay();
    }

    function updateStepDisplay() {
      var steps = document.querySelectorAll('#step');
      steps.forEach(function(step, index) {
        if (index + 1 === currentStep) {
          step.style.display = 'block';
        } else {
          step.style.display = 'none';
        }
      });
    }
    document.getElementById('previousBtn').addEventListener('click', previousStep);
    document.getElementById('nextBtn').addEventListener('click', nextStep);
    updateButtonVisibility();
  });
  </script>
  @stop