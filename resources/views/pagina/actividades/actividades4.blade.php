<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Servicios</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


<!-- para las estrellas -->
<link href="{{asset('css/starrr.css')}}" rel=stylesheet />

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

@section('title')
<title>Servicios</title>
@endsection

@section('link')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

<!-- para las estrellas -->
<link href="{{asset('css/starrr.css')}}" rel=stylesheet />

@endsection



@section('contenido')

<!--head image-->
<section>
  <div class="container divfotoprincipal">
    <div class="col-12">
      <div class="bg-img-head">
			<img src="{{ asset('foto_actividades/'.$foto_extendida[0]->foto) }}"  width="100%" height="auto" class="principal" alt="">
    </div>
  </div>
</div>
</section>
<!--breadcumbs-->
<section class="container">
  <ol class="breadcrumb bg-white">
    <li class="breadcrumb-item"><a href="{!!URL::to('/')!!}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{!!URL::to('index_actividades')!!}">Servicios</a></li>
    <li class="breadcrumb-item"><a href="{{route('abrir',$sub_actividad[0]->actividad)}}">{{$sub_actividad[0]->actividad}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$sub_actividad[0]->nombre}}</li>
  </ol>
</section>
<!--event-->
<section class="events">
  <div class="container my-md-5 mb-4">
    <div class="row">
      <!-- description-->
      <div class="col-12 col-md-7">
        <div class="card-content">
          <h1>{{$sub_actividad[0]->nombre}}</h1>
          <div >
              <hr class="float-left" style="
              content:'';left:1rem;top:4rem;margin:10px auto;width:25%;height:3px;background:#ed1a38">
            </div>
          <br>
          <!-- PARA LAS ESTRELLAS DE CALIFICACION -->
          <div class="classification">
            <span class="badge badge-info">{{$sub_actividad[0]->nombre}}</span>
            <div class='starrr' id='star2'></div>
            <input hidden="" value="{{$sub_actividad[0]->id_subactividad}}" id="id_sub_actividad">
            <input hidden="" type="text" id="token" value="{{ csrf_token() }}">
            <!-- input para el promedio de las estrellas -->
            <input type='text' name='rating' value='{{$promedioCalificacion[0]->calificacion}}' id='star2_input' hidden />
          </div>



          <div class="content">
            <p style="white-space:pre-line; text-align: justify;">{{$sub_actividad[0]->descripcion}}.</p>
              @if($video[0]->video === null)
              @else
                <!--Videos del nivel 4-->
                <div class="row">
                  <!--<div class="lg-auto">-->
                  <?php
                  function id_youtube($url) {
                  $patron = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/";
                  $array = preg_match($patron, $url, $parte);
                  if (false !== $array) {
                  return $parte[1];
                  }
                  return false;
                  }
                  $variable = id_youtube($video[0]->video);
                  ?>
                    <div class="embed-responsive embed-responsive-21by9">
                    <pre>
                      <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $variable }}" frameborder="0" allowfullscreen="allowfullscreen" class="embed-responsive-item" ></iframe>
                    </pre>
                    </div>
                  <!--</div>-->
                </div>
                <!--Fin videos del nivel 4-->
              @endif
          </div>
          <br>
          <br>
          <h6 class="sharer">
            Comparte este evento
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
          </h6>
        </div>
      </div>
      <!-- information-->
      <div class="col-12 col-md-5">
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
            Hora / <strong>{{$foto_sub[0]->horario}}.</strong>
          </li>
          <li class="list-group-item bg-light">
            <i class="far fa-money-bill-alt"></i>
            Costo /
            <strong>
             @if($foto_sub[0]->costo!=0)
             {{ $foto_sub[0]->costo }}
             @else
             GRATIS
             @endif

           </strong>
         </li>
         @if (!empty($foto_sub[0]->link))
					<li class="list-group-item">
						<i class="fas fa-link"></i>
						Link(s) / <strong><a href="{{$foto_sub[0]->link}}" target="_blank">{{$foto_sub[0]->link}}</a></strong>
					</li>
					@endif
         <li class="list-group-item">
          <i class="far fa-compass"></i>
          Direccion / <strong id="direccion"></strong>
        </li>
        <li id="mapid" class="list-group-item map">

        </li>
      </div>
    </div>
  </div>
</div>
</section>
<section class="events bg-light">
  <div class="container">
    <div class="row justify-content-between">
      <!-- reviews-->
      <div class="col-12 col-md-6">
        <div class="card-content">
          <h3> Reseñas</h3>
          @foreach($resena as $r)
          <div class="review">
            <p style="white-space:pre-line; text-align: justify;">"{{$r->detalle}}"</p>
            <h6 class="bmv">{{$r->autor}}</h6>
            <hr>
          </div>
          @endforeach
        </div>
      </div>
      <!-- related content-->
      <div class="col-12 col-md-5 ">
        <div class="card-content">
          <h3> Te puede interesar </h3><br>
          <ul class="list-unstyled">

            @foreach($interes as $in)
            <li class="media my-3">
              <a href="{{ route('index_actividades4',$in->nombre) }}">
                <img width="120" height="120" src="{{ asset('foto_actividades/'.$in->foto) }}" class="mr-3 shadow" alt="...">
              </a>
              <div class="media-body">
                <h5 class="mt-0 mb-1">{{$in->nombre}}</h5>
                <span id="interes{{$in->posicion}}"></span>
              </div>
            </li>
            @endforeach
            <div hidden="">
             @if($totalinteres[0]->totalinteres===1)
             <input type="" id="fx1" value="{{ $interes[0]->fx}}">
             <input type="" id="fy1" value="{{ $interes[0]->fy}}">
             @endif
             @if($totalinteres[0]->totalinteres===2)
             <input type="" id="fx1" value="{{ $interes[0]->fx}}">
             <input type="" id="fy1" value="{{ $interes[0]->fy}}">
             <input type="" id="fx2" value="{{ $interes[1]->fx}}">
             <input type="" id="fy2" value="{{ $interes[1]->fy}}">
             @endif
             @if($totalinteres[0]->totalinteres===3)
             <input type="" id="fx1" value="{{ $interes[0]->fx}}">
             <input type="" id="fy1" value="{{ $interes[0]->fy}}">
             <input type="" id="fx2" value="{{ $interes[1]->fx}}">
             <input type="" id="fy2" value="{{ $interes[1]->fy}}">
             <input type="" id="fx3" value="{{ $interes[2]->fx}}">
             <input type="" id="fy3" value="{{ $interes[2]->fy}}">
             @endif
           </div>

         </ul>
       </div>
     </div>
   </div>
 </div>
</section>


@stop

@section('script')

<!-- Calificacion -->
<script src="{{asset('js/starrr.js')}}"></script>
<script>
  // Insertar Estrellas dinamicamente
  var $s2input = $('#star2_input');
  $('#star2').starrr({
    max: 5,
    rating: $s2input.val(),
    change: function(e, value) {
      let numero = (value);
      $s2input.val(numero);
    }
  });
  //Save de Calificacion con Ajax
  $('.calificacion').click(function() {
    toastr.success('Gracias por calificar')
    var calf = $(this).data('value');
    var id_sub_actividad = $('#id_sub_actividad').val();
    var route = "/calificacionsub";
    var token = $('#token').val();
    $.ajax({
      url: route,
      headers: {
        'X-CSRF-TOKEN': token
      },
      type: 'post',
      datatype: 'json',
      data: {
        calf: calf,
        id_sub: id_sub_actividad
      },
      success: function(data) {
        location.reload();
      }
    });
  });
</script>

<script>
 let ubicacionMapa = "{{$ubicacion[0]->nombre}}";

 let fx = "{{$ubicacion[0]->fx}}";

 let fy = "{{$ubicacion[0]->fy}}";

 var map = L.map('mapid').setView([fx,fy], 16);

 L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

 L.marker([fx,fy]).addTo(map)
 .bindPopup(ubicacionMapa)
 .openPopup();
</script>
<script>
 $(document).ready(function(){

  direccionSubactividad();
  direccionSubactividadinteres1();
  direccionSubactividadinteres2();
  direccionSubactividadinteres3();
});

 function mostrarDireccion(response) {
  $('#direccion').text(response.features[0].properties.display_name);
}
function convertirGpsADireccion(fx, fy, callback) {
  $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat="+fx+"&lon="+fy+"",callback);
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
  $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat="+fx1+"&lon="+fy1+"",callback);
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
  $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat="+fx2+"&lon="+fy2+"",callback);
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
  $.getJSON("https://nominatim.openstreetmap.org/reverse?format=geojson&lat="+fx3+"&lon="+fy3+"",callback);
}
function direccionSubactividadinteres3() {

  var fx3 = $('#fx3').val();
  var fy3 = $('#fy3').val();
  convertirGpsADireccioninteres3(fx3, fy3, mostrarDireccioninteres3);
}


/*=====  End of interes3  ======*/


</script>


@stop
</body>
</html>
