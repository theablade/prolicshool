@extends('adminlte::page')

@section('title', 'Mensalidade')

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
      <h3 class="card-title">Nova Mensalidade</h3>
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
          <form role="form" method="POST" action="{{ route('monthlypayment.store') }}">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 ">
                  <div class="col-md-2 card-footer p-4 float-right text-center text-bold "
                    style="font-size: 20px; text-transform: uppercase;">

                    Total: <span class=" total_price  ">0.00 </span><span class="text-gray"> Mts</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="payment_status">Status da mensalidade</label>
                    <select class="form-control select2" style="width: 100%;" name="payment_status" id="payment_status">
                      <option value="" disabled selected>Selecione o status</option>

                      <option value="Pago">Pago</option>
                      <option value="Pendente">Pendente</option>


                    </select>
                  </div>
                  <div class="form-group">
                    <label for="student_id">Estudantes</label>
                    <select class="form-control select2" style="width: 100%;" name="student_id" id="student_id">
                      <option value="" disabled selected>Selecione um estudante</option>
                      @foreach ($students as $student)
                      <option value="{{$student->id}}">{{$student->nome}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="course_id">Course</label>
                    <select class="form-control select2" style="width: 100%;" name="selectCourse" id="selectCourse">
                      <option value="" disabled selected>Selecione o curso</option>
                      @foreach ($courses as $course)
                      <option value="{{$course->id}}_{{$course->price_enrollemnt}}">
                        {{$course->nome}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="payment_status">Mensalidade de</label>
                    <div class="form-group">
                      <select class="form-control" id="month" name="month">
                        <option value="" disabled selected>Selecione o mês</option>
                        <option value="Janeiro">Janeiro</option>
                        <option value="Fevereiro">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                      </select>
                    </div>

                  </div>
                  <input type="text" hidden id="course_id" name="course_id">
                  <div class="form-group">
                    <label for="price_enrollemnt">Valor a ser pago:</label>
                    <input type="number" min="500" max="500" class="form-control" id="price_enrollemnt"
                      name="price_enrollemnt" required placeholder="Digite o valor a ser pago" readonly>
                  </div>

                  <div class=" form-group">
                    <label for="price_enrollemnt">Vencimento:</label>
                    <input type="date" class="form-control" value="{{$endDate->toDateString() }}" id="endDate"
                      name="endDate" readonly>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pagamento">Tipo de pagamento:</label>
                    <select id="type_payment" name="type_payment" class="form-control">
                      <option value="" selected disabled> Selecione o tipo de pagamento</option>
                      <option value="Dinheiro">Dinheiro</option>
                      <option value="Deposito">Deposito</option>
                      <option value="Trasferencia">Trasferencia</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="number_doc" id="label_doc">Numero do talão:</label>
                    <input type="number" class="form-control" id="number_doc" name="number_doc"
                      placeholder="Digite o Numero do talao">
                  </div>

                  <div class="form-group">
                    <label for="payment_history" id="label_doc">Observações:</label>
                    <input type="numbertext" class="form-control" id="payment_history" name="payment_history"
                      placeholder="Observações">
                  </div>

                  <div class="form-group">
                    <label for="payment_date">Data de pagamento:</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" </div>

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
  document.getElementById('type_payment').addEventListener('change', function() {
    var paymentType = this.value;
    var numberDocContainer = document.getElementById('number_doc');
    var labelHiden = document.getElementById('label_doc')

    if (paymentType === 'Dinheiro') {
      numberDocContainer.style.display = 'none';
      labelHiden.style.display = 'none';
    } else {
      numberDocContainer.style.display = 'block';
      labelHiden.style.display = 'block';
    }
  });
  $('#selectCourse').change(showprices);


  function showprices() {
    var prices = document.getElementById('selectCourse').value.split('_');
    var course_id = parseInt(prices[0]);
    var price_enrollemnt = parseFloat(prices[1]);

    $("#course_id").val(course_id);
    $("#price_enrollemnt").val(price_enrollemnt);


    var total = price_enrollemnt
    $(".total_price").text(total.toLocaleString('pt-BR', {
      style: 'decimal',
      minimumFractionDigits: 2
    }));
  }
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