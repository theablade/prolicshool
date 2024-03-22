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
<h1>User Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
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
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Matriculas Anuais</h3>
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
        <canvas id="donutChart2"
          style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 420px;"
          width="840" height="500" class="chartjs-render-monitor"></canvas>
      </div>

    </div>

  </div>
  <div class="col-md-6">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Matriculas por mês</h3>
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
        <canvas id="myChart2"></canvas>
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

$totalmonthys2 = '0';
$quantidades2 = '0';
$mesess2 = '0';
$totalyears = [];
$qyear = [];
$yearsx = [];


foreach ($year as $key => $value) {
    $totalyears[] = $value->total;
    $qyear[] = $value->total / $value->qtyears;
    $yearsx[] = $value->years;
}

if (!empty($totalyears)) {
    $totalYearsString = implode(', ', $totalyears);
}

if (!empty($qyear)) {
    $qYearString = implode(', ', $qyear);
}

if (!empty($yearsx)) {
    $yearsxString = "'" . implode("', '", $yearsx) . "'";
} else {
    $yearsxString = '[]'; 
}


foreach ($year2 as $key => $value) {
    $totalyear[] = $value->total;
    $qyear[] = $value->total / $value->qtyears;
    $years2[] = $value->years;
}

if (!empty($totalyears)) {
    $totalYearsString2 = implode(', ', $totalyears);
}

if (!empty($qyear)) {
    $qYearString = implode(', ', $qyear);
}

if (!empty($years2)) {
    $yearsxString2 = "'" . implode("', '", $years2) . "'";
} else {
    $yearsxString2 = '[]'; 
}


$totalmonthy = [];
$quantidade = [];
$meses = [];

foreach ($monty as $value) {
    $totalmonthy[] = $value->total;
    $quantidade[] = $value->qtmonty > 0 ? $value->total / $value->qtmonty : 0;

    $monthsArray = [
        '1' => 'Jan',
        '2' => 'Fev',
        '3' => 'Mar',
        '4' => 'Abr',
        '5' => 'Mai',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Ago',
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

$totalmonthys = implode(', ', $totalmonthy);
$quantidades = implode(', ', $quantidade);
$mesess = "'" . implode("', '", $meses) . "'";

foreach ($monty2 as $key => $value) {
    $totalmonth[] = $value->total;
    $quantidad[] = $value->total / $value->qtmontyEnroll;


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


    $monthAbbreviation = $monthsArray[$value->mesesenroll] ?? '';

    if ($monthAbbreviation !== '') {
        $meses1[] = $monthAbbreviation;
    }
}


if (!empty($totalmonth)) {
    $totalmonthys2 = implode(', ', $totalmonth);
}

if (!empty($quantidad)) {
    $quantidades2 = implode(', ', $quantidad);
}

if (!empty($meses1)) {
    $mesess2 = "'" . implode("', '", $meses1) . "'";
}

?>


var ctx1 = document.getElementById('donutChart').getContext('2d');


var dataDonut = {
  labels: [<?php echo $yearsxString; ?>],
  datasets: [{
    data: [<?php echo $totalYearsString; ?>],
    backgroundColor: ['blue', 'blue', 'yellow']
  }]
};

var optionsDonut = {
  responsive: false,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      labels: {
        font: {
          size: 16 // Defina o tamanho da fonte desejado aqui
        }
      }
    }
  }
};


var myDoughnutChart = new Chart(ctx1, {
  type: 'doughnut',
  data: dataDonut,
  options: optionsDonut
});


var ctx2 = document.getElementById('donutChart2').getContext('2d');


var dataDonut = {
  labels: [<?php echo $yearsxString2; ?>],
  datasets: [{
    data: [<?php echo $totalYearsString2; ?>],
    backgroundColor: ['gray', 'blue', 'yellow']
  }]
};

var optionsDonut = {
  responsive: false,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      labels: {
        font: {
          size: 16
        }
      }
    }
  }
};


var myDoughnutChart = new Chart(ctx2, {
  type: 'doughnut',
  data: dataDonut,
  options: optionsDonut
});



const bar = document.getElementById('myChart').getContext('2d');

const myline = new Chart(bar, {
  data: {
    datasets: [{
      type: 'bar',
      label: 'TOTAL ',
      data: [<?php echo $totalmonthys; ?>],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
      ],
      borderWidth: 1
    }, {
      type: 'line',
      label: 'MÉDIA ',
      data: [<?php echo $quantidades; ?>],
      backgroundColor: ['rgba(255, 99, 132, 0.2)', ],
      borderColor: ['rgba(255, 99, 132, 1)', ],
      borderWidth: 1
    }],
    labels: [<?php echo $mesess; ?>]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

const bar2 = document.getElementById('myChart2').getContext('2d');

const myline2 = new Chart(bar2, {
  data: {
    datasets: [{
      type: 'bar',
      label: 'TOTAL ',
      data: [<?php echo $totalmonthys2; ?>],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
      ],
      borderWidth: 1
    }, {
      type: 'line',
      label: 'MÉDIA ',
      data: [<?php echo $quantidades2; ?>],
      backgroundColor: ['rgba(255, 99, 132, 0.2)', ],
      borderColor: ['rgba(255, 99, 132, 1)', ],
      borderWidth: 1
    }],
    labels: [<?php echo $mesess2; ?>]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
@stop