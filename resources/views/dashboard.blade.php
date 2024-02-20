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
        <h3>{{$formattedTotalMonthly}} Mts</h3>
        <p>Mensalidades</p>
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
        <h3>53<sup style="font-size: 20px">%</sup></h3>
        <p>Bounce Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{$totalStudents}}</h3>
        <p>Alunos registados</p>
      </div>
      <div class="icon">
        <i class="fa fa-user-plus"></i>
      </div>
      <a href="student" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$totalenrollments}}</h3>
        <p>Matriculas</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="enrollment" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


</div>

<div class="row">

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')

<script>

</script>
@stop