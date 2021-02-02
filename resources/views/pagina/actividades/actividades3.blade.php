<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>Servicios</title>
    @laravelPWA
    <style media="screen">
    @media screen and (max-width: 800px) {
      .divfotoprincipal{
        height: 100px;
      }
    }
     </style>
</head>
<body>
@extends('pagina.header')
@section('contenido')


    <!--head image-->
  @foreach($actividad as $act)
  <section>
    <div class="container divfotoprincipal">
      <div class="col-12">
        @if ($act->extendida == 2)
         <div class="bg-img-head">
          <img src="/public/foto_actividades/demo1.jpg" width="100%" height="auto" class="principal">
        </div>
        @else
        <div class="bg-img-head">
          <img src="/public/foto_actividades/{{$act->foto}}" width="100%" height="auto" class="principal">
        </div>
        @endif
      </div>
    </div>
  </section>


    <!--breadcumbs-->
    <section class="container">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="https://visita.lerma.gob.mx">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('index_actividades')}}">Servicios</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$actividad[0]->nombre}}</li>
      </ol>
    </section>

    <!--description-->
    <section class="events">
        <div class="container my-md-5 mb-4">
          <div class="row">
            <div class="col-12 col-md-7">
              <div class="card-content">
                <h1>{{ $act->nombre }}</h1>
                <div >
              <hr class="float-left" style="
              content:'';left:1rem;top:4rem;margin:10px auto;width:25%;height:3px;background:#ed1a38">
            </div>
            <br>
                <p style="white-space:pre-line; text-align: justify;">{{ $act->descripcion }}</p>

              </div>
            </div>
            <div class="col-12 col-md-5">

              <div class="list-group">
                <li class="list-group-item bg-info text-white">
                  <h4 class="text-center">Servicios</h4>
                </li>
                @foreach($act3 as $quehacer)
                <a href="{{route('abrir',$quehacer->nombre)}}" class="list-group-item list-group-item-action bg-light">
                {{ $quehacer->nombre }}</a>
                @endforeach
              </div>

            </div>
          </div>
        </div>
    </section>
@endforeach
    <!--events-->

<?php
$bandera = 1;
?>

    <section class="events mb-5">
      @foreach($sub_actividad3 as $a)

      @if(($bandera % 2) == 0)

        <div class="card">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
                <div class="card-body">
                  <h3 class="card-title">{{$a->nombre}}</h3>
                  <p class="card-text" ALIGN="justify" style="white-space:pre-line; text-align: justify;">{{$a->descripcion}}</p>
                  <a href="{{route('index_actividades4',$a->nombre)}}" class="btn btn-info btn-sm">Ver más</a>
                </div>
            </div>
           <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$a->foto) }});">
            </div>
          </div>
        </div>
      </div>

      @else


      <div class="card bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$a->foto) }});">
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$a->nombre}}</h3>
                <p class="card-text" ALIGN="justify" style="white-space:pre-line; text-align: justify;">{{$a->descripcion}}</p>
                <a href="{{route('index_actividades4',$a->nombre)}}" class="btn btn-info btn-sm">Ver más</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      <?php
      $bandera = $bandera + 1;
      ?>

      @endforeach
    </section>

<section class="events bg-light">
  <div class="container">
    <div class="row justify-content-between">
     <div class="col-12 col-md-6">
      <div class="card-content">
         <h3> Reseñas</h3>
        <div class="review">
        @foreach($resena as $resenas)
         <p style="white-space:pre-line; text-align: justify;">"{{$resenas->detalle}}"</p>
         <h6 class="bmv">{{$resenas->nombre}}</h6>
        @endforeach
        <hr>
        </div>
      </div>
    </div>
   </div>
 </div>
</section>


@stop
</body>
</html>
