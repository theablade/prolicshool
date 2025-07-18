<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" charset="utf-8">
  <style type="text/css">
  #tabint {
    border-collapse: collapse;
    width: 100%;
  }

  tr {
    padding: 2rem;
  }

  th,
  td {
    border-bottom: 1px solid #ccc;
    border-top: 0px;
    border-right: 0px;
    border-left: 0px;
    text-align: left;
    padding: .5rem;
  }

  #tab {
    margin-top: 5px;
    margin-left: 808px;
    border-collapse: collapse;
  }

  tbody tr:nth-child(odd) {
    background: #eee;
    width: 100%;
  }

  figure {
    width: 20%;
    margin-top: -20px;
    margin-left: -25px;
    margin-bottom: -30px;
  }

  h3 {
    float: right;
    margin-top: 130px;
    margin-right: -50px;
  }

  #vd h3 {
    float: right;
    margin-right: 5px;
    margin-top: -10px;
    display: block;
  }

  #inf {
    font-size: 12px;
    padding-top: -20px;
    float: left;
  }

  #cli {
    font-size: 12px;
    float: right;
    border: .30px solid;
    margin-top: 25px;
    padding-left: 5px;
    width: 300px;
    margin-right: -120px;
    display: block;
  }

  i {
    float: right;
    margin-top: 0px;
  }

  #cli b {
    font-size: 14px;
    padding-left: 20px;
  }

  #cli label {
    padding-left: 20px;
  }

  #limp label {
    padding-left: 18px;
  }

  #limpinf label {
    padding-left: 15px;
  }

  #limp {
    clear: both;
    border: .30px solid;
    margin-top: 20px;
    margin-bottom: 10px;
  }

  #limpinf {
    margin-top: -5px;
    margin-bottom: 5px;
  }

  h4 {
    text-align: right;
    padding: 0px;
    margin: 0px;
  }
  </style>
  <title>Prolinc | Recibo</title>
</head>


<body>
  <i>Original</i>

  <h3> == ==</h3>

  <figure>
    <h1 style="margin-left: 1rem;">Fatura</h1>
  </figure>



  <div id="inf">
    <p></p>
    <p>Morada: </p>
    <p>Telefone: Fax:</p>
    <p>NUIT:</p>
    <p>E_mail: </p>
  </div>
  <div id="cli">
    @foreach ($enrollments as $key => $student)
    <p>Exmo. Sr.(a): </p>
    <b>{{ Strtoupper($student->student) }}</b>
    <p><label>Cell: {{ $student->ntelefone }}</label></p>
    <p><label>Av/Rua: {{ $student->avenida }} </label>
    </p>
  </div>

  <div id="limp" style="text-align: right; border:none;">
    <b><label>Data: <?php echo date("d-m-Y"); ?></label></b>

  </div>
  <div id="limpinf">

    <label>Tipo de pagamento</label>
    <label>{{$student->type_payment}}</label>
  </div>

  <hr>

  <table id="tabint">
    <thead style="background-color:#A9D0F5">
      <tr>

        <th style="text-align: left;">Curso</th>
        <th style="text-align: left;">Mensalidade</th>
        <th style="text-align: left;">Inscrição</th>
        <th style="text-align: left;">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align: left;">{{$student->course}}</td>
        <td style="text-align: left;">{{$student->price_enrollemnt}} Mts</td>
        <td style="text-align: left;">{{$student->price_subscrab}} Mts</td>
        <td style="text-align: left;">
          {{$student->price_enrollemnt}} Mts</td>
      </tr>
    </tbody>
  </table>
  <table id="tab">
    <tfoot>


      <tr>
        <th colspan="4" style="text-align: right; width: 111px;">TOTAL PAGO </th>
        <th style="background-color:#A9D0F5; width: 81px;">
          <h4>
            {{ $student->price_enrollemnt  + $student->price_subscrab }} Mts</h4>
        </th>

      </tr>
    </tfoot>
    @endforeach
  </table><br>
  <div style="text-align: center;">
    _____________________________________
    <br>(Assinatura do responsvel)<br>Responsável:
    {{ Auth::user()->name }}
  </div>
</body>

</html>