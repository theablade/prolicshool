@extends('adminlte::page')

@section('title', 'Editar Estudante')

@section('content_header')

@stop

@section('content')
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <br>
  <div class="card w-80 h-80">

    <div class="row">

      <div class="col-md-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center text-2xl">Editar informações do Aluno</h3>
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
          <div class="card-body">
            <form action="{{ route('student.update', $student->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="img">Imagem</label>
                    <div class="input-group text-center">
                      <input type="file" class="form-control" id="img" name="img" onchange="previewImage(event)"
                        required style="display: none;">
                      <label for="img" class="input-img-preview">
                        @if($student->img_path)
                        <img src="{{ asset($student->img_path) }}" alt="Foto do Aluno"
                          style="max-width: 100%; max-height: 200px; border-radius: 50%; object-fit: cover;">
                        @else
                        <span>Imagem não encontrada</span>
                        @endif
                      </label>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <h4 class="text-bold">Dados pessoais</h4>
                  <div class="form-group">
                    <div class="form-group">
                      <label for="nome">Nome do aluno</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" value="{{ $student->nome }}" class="form-control" id="nome" name="nome"
                          placeholder="Digite o nome" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nome">Filho(a) de</label>
                      <div class="input-group" bis_skin_checked="1">
                        <div class="input-group-prepend" bis_skin_checked="1">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>

                        </div>
                        <input type="text" value="{{ $student->dadname }}" class="form-control" id="dadname"
                          name="dadname" placeholder="Digite o nome" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nome">E de</label>
                      <div class="input-group mb-3" bis_skin_checked="1">
                        <div class="input-group-prepend" bis_skin_checked="1">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" value="{{ $student->mothername }}" class="form-control" id="mothername"
                          name="mothername" placeholder="Digite o nome" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="provincia">Natural de </label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-flag"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="provincia" id="provinciaSelect">
                          <option value="" disabled selected>Selecione a Província</option>
                          @foreach ($provinces as $province)
                          <option value="{{ $province->province_id }}">
                            {{ $province->nome }}
                          </option>
                          @endforeach
                        </select>
                      </div>

                    </div>

                    <div class="form-group">
                      <label for="distrito">Distrito</label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-flag"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="distrito" id="distritoSelect">
                          <option value="" disabled>Selecione o distrito</option>
                          @foreach ($districts as $district)
                          <option value="{{ $district->id }}" data-provincia="{{$district->province_id}}">
                            {{ $district->nome }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="genero">Gênero</label>
                      <select name="genero" id="genero" class="form-control select2" style="width: 100%;">
                        <option value="" disabled>Selecione um gênero</option>
                        <option value="Masculino" {{ $student->genero === 'Masculino' ? 'selected' : '' }}>Masculino
                        </option>
                        <option value="Feminino" {{ $student->genero === 'Feminino' ? 'selected' : '' }}>Feminino
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="data_nascimento">Data de nascimento</label>
                      <span id="ageMessage" style="color:red;"></span>
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" id="data_nascimento"
                          value="{{ $student->data_nascimento }}" name="data_nascimento" required>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="tipodoc">Tipo de Documento:</label>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        <select class="form-control select2" style="width: 100%;" name="tipodoc" id="tipodoc"
                          onchange="calculateExpiryDate(); checkExpiryDate(this.value)">
                          <option value="" disabled>Selecione o tipo de documento</option>
                          <option value="cedula" data-icon="fas fa-id-card"
                            {{ $student->tipodoc === 'cedula' ? 'selected' : '' }}>Cedula</option>
                          <option value="cartão de eleitor" data-icon="far fa-address-card"
                            {{ $student->tipodoc === 'cartão de eleitor' ? 'selected' : '' }}>Cartão de eleitor
                          </option>
                          <option value="bi" data-icon="far fa-id-card"
                            {{ $student->tipodoc === 'bi' ? 'selected' : '' }}>BI</option>
                        </select>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="tipodoc">Numero documento:</label>
                      <div class="input-group mb-3" bis_skin_checked="1">
                        <div class="input-group-prepend" bis_skin_checked="1">
                          <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                        </div>
                        <input type="text" value="{{$student->numerodoc}}" class="form-control" id="numerodoc"
                          name="numerodoc" placeholder="Digite o numero do documento" required>
                      </div>
                    </div>

                  </div>

                </div>
                <div class="col-md-4">
                  <h4 class="text-bold"> Dados de residência </h4>
                  <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                      </div>
                      <input type="text" value="{{ $student->bairro }}" class="form-control" id="bairro" name="bairro"
                        placeholder="Digite o endereço" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="quarterao">Quarterão</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                      </div>
                      <input type="text" value="{{ $student->quarterao }}" class="form-control" id="quarterao"
                        name="quarterao" placeholder="Digite o endereço" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="avenida">Avenida</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                      </div>
                      <input type="text" value="{{ $student->avenida }}" class="form-control" id="avenida"
                        name="avenida" placeholder="Digite o endereço" required>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="provincia">Provincia </label>
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="far fa-flag"></i></span>
                      <select class="form-control select2" style="width: 100%;" name="provincia" id="provinciaSelect2">
                        <option value="" disabled selected>Selecione a Província</option>
                        @foreach ($provinces as $province)
                        <option value="{{$province->province_id}}">{{$province->nome}}</option>
                        @endforeach
                      </select>
                    </div>

                  </div>

                  <div class="form-group">
                    <label for="redistrito">Distrito</label>
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


                  <div class="form-group">
                    <label for="ntelefone">Contacto do encarregado</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="number" class="form-control" value="{{ $student->ntelefone }}" id="ntelefone"
                        name="ntelefone" placeholder="+258 " required minlength="9">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="email" class="form-control" value="{{ $student->email }}" id="email" name="email"
                        placeholder="estudandt@exemplo.com ">
                    </div>
                  </div>
                  <hr>

                  <h4 class="text-bold">Horários </h4>
                  <div class="form-group">
                    <label for="horario">Horário das Aulas:</label>
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-clock"></i></span>
                      <select class="form-control" name="horario" id="horario">
                        <option value="" selected disabled>Selecione o horário das aulas</option>
                        <option value="07:00-08:30" {{ $student->horario == '07:00-08:30' ? 'selected' : '' }}>07:00 -
                          08:30</option>
                        <option value="08:30-10:00" {{ $student->horario == '08:30-10:00' ? 'selected' : '' }}>08:30 -
                          10:00</option>
                        <option value="10:00-11:30" {{ $student->horario == '10:00-11:30' ? 'selected' : '' }}>10:00 -
                          11:30</option>
                        <option value="12:30-14:00" {{ $student->horario == '12:30-14:00' ? 'selected' : '' }}>12:30 -
                          14:00</option>
                        <option value="14:00-15:30" {{ $student->horario == '14:00-15:30' ? 'selected' : '' }}>14:00 -
                          15:30</option>
                        <option value="15:30-17:00" {{ $student->horario == '15:30-17:00' ? 'selected' : '' }}>15:30 -
                          17:00</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
              <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@stop

@section('js')
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
    document.getElementById("ageMessage").innerHTML = "O estudante deve ter pelo menos 10 anos de idade!";
  } else {
    document.getElementById("ageMessage").innerHTML = "";
  }
});

var calculatedTypeDocument;

var emissao = document.getElementById('emissao');
emissao.style.display = 'none'

function calculateExpiryDate() {
  var typeDocument = document.getElementById('tipodoc').value;
  var emissionDateInput = document.getElementById('data_emisao');
  var expiryDateInput = document.getElementById('data_validade');
  var emissao = document.getElementById('emissao');
  var expiryMessage = document.getElementById('message');
  if (typeDocument === 'bi') {
    emissao.style.display = 'block';
    var emissionDate = new Date(emissionDateInput.value);
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