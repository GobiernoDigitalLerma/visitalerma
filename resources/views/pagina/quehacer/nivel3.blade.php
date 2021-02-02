<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>{{$actividad[0]->nombre}}</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

@PWACRIZPRZ
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
      <li class="breadcrumb-item"><a href="{{route('quehacer')}}">Qué hacer</a></li>
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

        <!--NUEVA SECCION -->
        <div class="col-12 col-md-5">

        <!--UBICACIÓN-->

        <div class="list-group">
        <li class="list-group-item bg-info text-white">
        <h4 class="text-center">Información del Evento</h4>
        </li>
        <li class="list-group-item bg-light">
            <i class="far fa-calendar-check"></i>
            Fecha / <strong>{{$fecha}}</strong>
        </li>
        <li class="list-group-item">
            <i class="far fa-clock"></i>
            Hora / <strong>{{$ubicacion[0]->horario_detalle}}.</strong>
          </li>

        <li class="list-group-item">
        <i class="far fa-compass"></i>
        Direccion / <strong id="direccion"></strong>
        </li>
        <li id="mapid" class="list-group-item map">

        </li>


        </div>
        <BR>
        <!--FIN DE UBICACIÓN-->

          <div class="list-group">
            <li class="list-group-item bg-info text-white">
              <h4 class="text-center">que hacer</h4>
            </li>
            @foreach($act_quehacer as $quehacer)
            <a href="{{route('quehacern3',$quehacer->nombre)}}" class="list-group-item list-group-item-action bg-light">
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

    <!--FOTOS DE LA ACTIVIDADES-->
     <section class="events mb-5">
      @if($mg1 != 'null')

      <div class="card bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$mg1->file) }});">
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$mg1->title}}</h3>
                <p class="card-text" ALIGN="justify">{{$mg1->description}}</p>

              </div>
            </div>
          </div>
        </div>
      </div>

      @else

      @endif

      @if($mg2 != 'null')
        <div class="card">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$mg2->title}}</h3>
                <p class="card-text" ALIGN="justify">{{$mg2->description}}</p>

              </div>
            </div>
            <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$mg2->file) }});">
            </div>
          </div>
        </div>
      </div>
      @else

      @endif

      @if($mg3 != 'null')
      <div class="card bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$mg3->file) }});">
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$mg3->title}}</h3>
                <p class="card-text" ALIGN="justify">{{$mg3->description}}</p>

              </div>
            </div>
          </div>
        </div>
      </div>
      @else

      @endif

      @if($mg4 != 'null')
       <div class="card">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$mg4->title}}</h3>
                <p class="card-text" ALIGN="justify">{{$mg4->description}}</p>

              </div>
            </div>
            <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$mg4->file) }});">
            </div>
          </div>
        </div>
      </div>
      @else

      @endif

      @if($mg5 != 'null')
        <div class="card bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$mg5->file) }});">
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$mg5->title}}</h3>
                <p class="card-text" ALIGN="justify">{{$mg5->description}}</p>

              </div>
            </div>
          </div>
        </div>
      </div>
      @else

      @endif

     </section>


    <section class="events mb-5">
      @foreach($sub_actividad as $a)

      @if(($bandera % 2) == 0)

      <div class="card">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$a->nombre}}</h3>
                <p class="card-text" ALIGN="justify">{{$a->descripcion}}</p>
                <a href="{{route('quehacern4',$a->nombre)}}" class="btn btn-info btn-sm">Ver más</a>
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
                <a href="{{route('quehacern4',$a->nombre)}}" class="btn btn-info btn-sm">Ver más</a>
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
         <p>"{{$resenas->detalle}}"</p>
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

@section('script')
  <script>
  let ubicacionMapa = "{{$ubicacion[0]->nombre}}";

  let fx = "{{$ubicacion[0]->fx}}";

  let fy = "{{$ubicacion[0]->fy}}";

  var map = L.map('mapid').setView([fx, fy], 16);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  L.marker([fx, fy]).addTo(map)
    .bindPopup(ubicacionMapa)
    .openPopup();
</script>
<script>
  $(document).ready(function() {

    direccionSubactividad();
    direccionSubactividadinteres1();
    direccionSubactividadinteres2();
    direccionSubactividadinteres3();
  });

  function mostrarDireccion(response) {
    $('#direccion').text(response.features[0].properties.display_name);
  }

  function convertirGpsADireccion(fx, fy, callback) {
    $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat=" + fx + "&lon=" + fy + "", callback);
  }

  function direccionSubactividad() {
  var fx = {!! json_encode($ubicacion[0]->fx) !!};
  var fy = {!! json_encode($ubicacion[0]->fy) !!};
  convertirGpsADireccion(fx, fy, mostrarDireccion);
}

  /*================================
  =            interes1            =
  ================================*/
  function mostrarDireccioninteres1(response) {
    var direccion = response.features[0].properties.display_name;
    $('#interes1').html(direccion);
  }

  function convertirGpsADireccioninteres1(fx1, fy1, callback) {
    $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat=" + fx1 + "&lon=" + fy1 + "", callback);
  }

  function direccionSubactividadinteres1() {
    var fx1 = $('#fx1').val();
    var fy1 = $('#fy1').val();
    convertirGpsADireccioninteres1(fx1, fy1, mostrarDireccioninteres1);
  }


  /*=====  End of interes1  ======*/
  /*================================
  =            interes2            =
  ================================*/
  function mostrarDireccioninteres2(response) {
    var direccion = response.features[0].properties.display_name;
    $('#interes2').html(direccion);
  }

  function convertirGpsADireccioninteres2(fx2, fy2, callback) {
    $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat=" + fx2 + "&lon=" + fy2 + "", callback);
  }

  function direccionSubactividadinteres2() {

    var fx2 = $('#fx2').val();
    var fy2 = $('#fy2').val();
    convertirGpsADireccioninteres2(fx2, fy2, mostrarDireccioninteres2);
  }


  /*=====  End of interes2  ======*/

  /*================================
  =            interes3            =
  ================================*/
  function mostrarDireccioninteres3(response) {
    var direccion = response.features[0].properties.display_name;
    $('#interes3').html(direccion);
  }

  function convertirGpsADireccioninteres3(fx3, fy3, callback) {
    $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat=" + fx3 + "&lon=" + fy3 + "", callback);
  }

  function direccionSubactividadinteres3() {

    var fx3 = $('#fx3').val();
    var fy3 = $('#fy3').val();
    convertirGpsADireccioninteres3(fx3, fy3, mostrarDireccioninteres3);
  }
</script>


    @stop
  </body>
  </html>
