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

  @if(session('msg'))
  <div class="row success-message"">
    <p class=" msg">{{session('msg')}}</p>
  </div>
  @endif

</div>
<div class="container-fluid">
  <!-- Adicione a classe mt-4 aqui -->
  <div class="card w-100 h-100">
    <div class="card-header">
      <h3 class="card-title">Mensalidade</h3>
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

        <div class="card-body">
          <div class="row">
            <div class="col-md-6">

              <div class="row">


                <div class="col-md-4">
                  <label for="student_id">Nome do estudante</label>
                  <p>

                    {{$student->student}}
                  </p>
                </div>


                <div class="col-md-4">
                  <label for="student_id">Curso</label>
                  <p>

                    {{$student->course}}
                  </p>
                </div>

                <div class="col-md-4">
                  <label>Contacto</label>
                  <p>

                    {{$student->ntelefone}}
                  </p>

                </div>

                <div class="row">
                  <div class="col-md-12">

                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Valor</th>
                            <th>Data de pagamento</th>
                            <th>Data limite</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($monthys as $monthy)
                          <tr>
                            <td>{{ $monthy->id }}</td>
                            <td setTimeout(function() { document.getElementById('success-message').style.display='none'
                              ; }, 3000);>
                              {{number_format($monthy->price_enrollemnt, 2, ',', '.' )}}</td>

                            <td>
                              @if ($monthy->payment_date =='')
                              dd/mm/aaaa
                              @else
                              {{date('d-m-Y', strtotime($monthy->payment_date))}}
                              @endif
                            </td>


                            <td> {{date('d-m-Y', strtotime($monthy->endDate))}}</td>
                            <td>
                              @if($monthy->payment_status =="Pago")
                              <span class="badge badge-success p-2">
                                {{ $monthy->payment_status }}
                              </span>
                              @elseif($monthy->payment_status =="Pendente")
                              <span class="badge badge-danger p-2">
                                {{ $monthy->payment_status }}
                              </span>
                              @else

                              @endif
                            </td>
                            <td>
                              @if($monthy->payment_status =="Pago")

                              <form action="{{ route('monthlypayment.destroy', $monthy ->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit"
                                  onclick="return confirm('Are you sure you want to delete this monthlypayment?')">Cancelar</button>
                              </form>
                              @elseif($monthy->payment_status =="Pendente")
                              <form action="{{ route('monthlypayment.update', $monthy ->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success btn-sm" type="submit"
                                  onclick="return confirm('Are you sure you want to delete this monthlypayment?')">Pagar</button>
                              </form>
                            </td>
                            @endif


                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>


                  </div>
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