@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<head>
  <style>
  #calendar {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
  }
  </style>
</head>
<h1>Admin Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ number_format($yearsenrollment->total, 2, ',', '.') }}Mts</h3>

        <p>Mensalidades Ano</p>
      </div>
      <div class="icon">
        <i class="far fa-money-bill-alt"></i>
      </div>
      <a href="monthlypayment" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ number_format($montlyenrollment->total, 2, ',', '.') }}Mts</h3>

        <p>Mensalidades Mês</p>
      </div>
      <div class="icon">
        <i class="far fa-money-bill-alt"></i>
      </div>
      <a href="monthlypayment" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ number_format($yearEnrollment->total, 2, ',', '.') }}Mts</h3>
        <p>Matriculas Ano</p>
      </div>
      <div class="icon">
        <i class="fa fa-user-plus"></i>
      </div>
      <a href="enrollment" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ number_format($montlyEnrollment->total, 2, ',', '.') }}Mts</h3>

        <p>Matriculas Mês</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="enrollment" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


</div>

<div class="row">
  <div class="col-md-6">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Mensalidades Anuais</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chartjs-size-monitor">
          <div class="chartjs-size-monitor-expand">
            <div class=""></div>
          </div>
          <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
          </div>
        </div>
        <canvas id="donutChart"
          style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 420px;"
          width="840" height="500" class="chartjs-render-monitor"></canvas>
      </div>

    </div>

  </div>

  <div class="col-md-6">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Mensalidades</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chartjs-size-monitor">
          <div class="chartjs-size-monitor-expand">
            <div class=""></div>
          </div>
          <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
          </div>
        </div>
        <canvas id="myChart"></canvas>
      </div>

    </div>

  </div>

</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Ultimos registos</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>

      <div class="card-body p-0" style="display: block;">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="badge badge-success">Shipped</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                </td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td>
                  <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                </td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                <td>iPhone 6 Plus</td>
                <td><span class="badge badge-danger">Delivered</span></td>
                <td>
                  <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                </td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="badge badge-info">Processing</span></td>
                <td>
                  <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                </td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td>
                  <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                </td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                <td>iPhone 6 Plus</td>
                <td><span class="badge badge-danger">Delivered</span></td>
                <td>
                  <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                </td>
              </tr>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="badge badge-success">Shipped</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

      <div class="card-footer clearfix" style="display: block;">
        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
      </div>

    </div>
  </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

@stop
@section('footer')
<footer>
  <strong>Copyright © 2024 <a href="https://www.linkedin.com/in/fernandomuethea/" target="_blank">Muethea</a>.</strong>

  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b>1.0
  </div>
</footer>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
<?php

$totalmonthys = '0';
$quantidades = '0';
$mesess = '0';

$totalyears = [];
$qyear = [];
$yearsx = [];

// Popule as variáveis com os dados do banco de dados
foreach ($year as $key => $value) {
    $totalyears[] = $value->total;
    $qyear[] = $value->total / $value->qtyears;
    $yearsx[] = $value->years;
}

// Converta as variáveis em strings para uso no JavaScript
if (!empty($totalyears)) {
    $totalYearsString = implode(', ', $totalyears);
}

if (!empty($qyear)) {
    $qYearString = implode(', ', $qyear);
}

if (!empty($yearsx)) {
    $yearsxString = "'" . implode("', '", $yearsx) . "'";
} else {
    $yearsxString = '[]'; // Se não houver anos, defina como um array vazio
}

foreach ($monty as $key => $value) {
    $totalmonthy[] = $value->total;
    $quantidade[] = $value->total / $value->qtmonty;


    $monthsArray = [
        '1' => 'Jan',
        '2' => 'Fev',
        '3' => 'Mar',
        '4' => 'Abr',
        '5' => 'Mai',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Agos',
        '9' => 'Set',
        '10' => 'Out',
        '11' => 'Nov',
        '12' => 'Dez'
    ];


    $monthAbbreviation = $monthsArray[$value->meses] ?? '';

    if ($monthAbbreviation !== '') {
        $meses[] = $monthAbbreviation;
    }
}


if (!empty($totalmonthy)) {
    $totalmonthys = implode(', ', $totalmonthy);
}

if (!empty($quantidade)) {
    $quantidades = implode(', ', $quantidade);
}

if (!empty($meses)) {
    $mesess = "'" . implode("', '", $meses) . "'";
}


?>

// Obter o contexto do canvas
var ctx1 = document.getElementById('donutChart').getContext('2d');


var dataDonut = {
  labels: [<?php echo $yearsxString; ?>],
  datasets: [{
    data: [<?php echo $totalYearsString; ?>],
    backgroundColor: ['red', 'blue', 'yellow']
  }]
};

// Definir as opções do gráfico de rosca
var optionsDonut = {
  responsive: false,
  maintainAspectRatio: false
};

// Criar o gráfico de rosca
var myDoughnutChart = new Chart(ctx1, {
  type: 'doughnut',
  data: dataDonut,
  options: optionsDonut
});



const ctx = document.getElementById('myChart').getContext('2d');

// Crie o gráfico
const myChart = new Chart(ctx, {
  type: 'bar', // Defina o tipo de gráfico para barras
  data: {
    labels: [<?php echo $mesess; ?>],
    datasets: [{
      label: 'Valores',
      data: [<?php echo $totalmonthys; ?>],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',


      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',

      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


myChart.data.datasets.push({
  label: 'Médias',
  data: [<?php echo $quantidades; ?>],
  type: 'line',
  borderColor: ['rgba(255, 99, 132, 1)', ],
  backgroundColor: ['rgba(255, 99, 132, 0.2)', ],
  borderWidth: 2,
  yAxisID: 'y1'
});
</script>
@stop