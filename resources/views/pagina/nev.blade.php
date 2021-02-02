@extends('pagina.header')
@section('contenido')

<!-- Bootstrap core CSS -->
    <link href="{{ asset('../../cuarto/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            width: 500;
        height: 500;
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('../../cuarto/css/carousel.css') }}" rel="stylesheet">
    <!-- Modal de las imagenes -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Fin del modal -->
    <!--Mapa-->
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/leaflet@latest/dist/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/leaflet-control-geocoder@latest/dist/Control.Geocoder.css') }}" />
    <script src="{{ asset('https://unpkg.com/leaflet@latest/dist/leaflet-src.js') }}"></script>
    <script src="{{ asset('https://unpkg.com/leaflet-control-geocoder@latest/dist/Control.Geocoder.js') }}"></script>
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
    <script src='{{ asset('https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js') }}'></script>
    <link href='{{ asset('https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css') }}' rel='stylesheet'/>
    <script src="{{asset('map/MiniMap/Control.MiniMap.js')}}" type="text/javascript"></script>
    <link href="{{asset('map/MiniMap/Control.MiniMap.css')}}" rel='stylesheet'/>
    <style>
      #map {
        height: 280px;
        width: auto;
        position: relative;
        box-shadow: 5px 5px 5px #888;
      }
    </style>
    <!--Fin Mapa-->

<div class="container">
    <ol class="breadcrumb bg-light col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0px">
        <li class="breadcrumb-item"><a href="{!!URL::to('/')!!}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Breadcumb</li>
    </ol>
    <br>
  
    <div class="form-group row mt-2">
	<div class="col-sm-8">
            <h2 class="titulossub"><strong>Nombre de la imagenes.</strong></h2>
            <p class="text-justify lead">Descripcion de la subactividad</p>
      <div class="card">
        <div class="card-header">
            <p class="text-justify lead"><strong>Rese&ntilde;a: Nombre del escritor.</strong></p>
        </div>
        <div class="card-body">
            <p class="card-text lead font-italic">" Detalle de rese&ntilde;a ".</p>
        </div>
      </div>
	  </div>
		<div class="col-sm-4 mt-2">
			<table class="table">
				<thead>
					<th class="text-center table-success" colspan="3" style="color: #050000"><strong>Horarios:</strong></th>
				</thead>
				<tbody>
	   			    <tr>
              			<td>
					<p class="lead">Dias y horarios</p>                            
              			</td>
            		</tr>		
				</tbody>
			</table>		
    </div>
</div>

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <center>          
            <img src=" " class="img-fluid" id="modalImagen">                
          </center>
        </div>        
      </div>
    </div>
  </div> 

  <div class="container marketing">
    <!-- START THE FEATURETTES -->

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="titulossub">Nombre de la foto.</h2>
        <p class="lead">Descripcion.</p>
      </div>
      <div class="col-md-5 ">
        <img src="https://www.elsoldetoluca.com.mx/incoming/lev6td-palacio-municipal-lerma.jpg/ALTERNATES/LANDSCAPE_1140/Palacio%20municipal%20lerma.jpg" class=" zoom bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid img-thumbnail mx-auto" data-toggle="modal" data-target="#exampleModalCenter">
      </div>
    </div>

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h3 class="featurette-heading">Nombre de la foto.</h3>
        <p class="lead">Descripcion.</p>
      </div>
      <div class="col-md-5 ">
        <img src="https://www.elsoldetoluca.com.mx/incoming/lev6td-palacio-municipal-lerma.jpg/ALTERNATES/LANDSCAPE_1140/Palacio%20municipal%20lerma.jpg" class=" zoom bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid img-thumbnail mx-auto" data-toggle="modal" data-target="#exampleModalCenter">
    </div>
    </div>
    <br>
    <!-- /END THE FEATURETTES -->
  </div><!-- /.container -->
   
<div class="row">
    <div class="col-md-12 text-center">
      <h2 class="titulossub"><strong>Ubicacion</strong></h2>
    </div>
  </div>
  <div class="form-group row mt-2">
		<div class="col-sm-6">
      <div class="text-center">
        <div id="map" class="text-center"></div>
      </div> 
	  </div>
		<div class="col-sm-6 mt-2">
			<p class="lead"><strong>Datos de la ubicacion</strong></p>
			<p class="lead">Dias y horarios</p>			
    </div>
  </div>

<br>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../cuarto/js/jquery.slim.min.js"><\/script>')</script>
<script src="../../cuarto/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
<!--Mapa js-->
<script type="text/javascript">
    $(document).ready(function(){
      // Iteración imagenes
      let iter = 0;
      $('.actividad').each(function(){
          if (iter === 0) {
            $(this).children('img').addClass('img-right');
            $(this).children('div').addClass('descripcion-left');
            iter = 1;
          }else{
            $(this).children('img').addClass('img-left'); 
            $(this).children('div').addClass('descripcion-right');
            iter = 0; 
          }
      });
      // Fin iteración
      
      // Zoom modal
      $(".zoom").click(function(){
        let imge = $(this).attr('src');
        $('#modalImagen').attr('src',imge);
      });

      $('.zoom').hover(function() {
        $(this).addClass('transition');
      }, function() {
        $(this).removeClass('transition');
      });
      // Fin zoom modal
      
    });
    
    // Script Mapa
//Coordenadas de la ubicacion

    let ubicacionMapa = "Ayuntamiento Lerma";

    let fx = "19.28663854584388";

    let fy = "-99.51237045228483";

    let map =   new L.Map('map'),
                  geocoders = {
                    'Nominatim': L.Control.Geocoder.nominatim()
                  },
                  selector = L.DomUtil.get('geocode-selector'),
                  control = new L.Control.Geocoder({ geocoder: null }),
                  btn,
                  selection,
                  marker;

    let url ='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

    let contribucion='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

    let configuracion = new L.TileLayer(url, {minZoom: 5, maxZoom: 18, attribution: contribucion, zoomInTitle:"Aumentar zoom",zoomOutTitle: "Reducir zoom"});

    map.addLayer(configuracion);

    map.setView(new L.LatLng(fx,fy),15);

    L.marker([fx,fy],{draggable: false, title: "Ubicación"})
            .bindPopup("<i>"+ubicacionMapa+"</i>").addTo(map);

    let configuracion2 = new L.TileLayer(url, {minZoom: 0, maxZoom: 13, attribution: contribucion });

    let miniMap = new L.Control.MiniMap(configuracion2, { toggleDisplay: true, minimized: true, collapsedWidth: 30, collapsedHeight: 30 }).addTo(map);

    map.addControl(new L.Control.Fullscreen({
      title: {
        'false': 'Mostrar pantalla completa',
        'true': 'Salir de pantalla completa'
      }
    }));

    control.addTo(map);

    function select(geocoder, el) {
        if (selection) {
          L.DomUtil.removeClass(selection, 'selected');
        }
          control.options.geocoder = geocoder;
          L.DomUtil.addClass(el, 'selected');
          selection = el;
    }

    for (let name in geocoders) {
      btn = L.DomUtil.create('button', '', selector);
      btn.innerHTML = name;
      (function(n) {
        L.DomEvent.addListener(btn, 'click', function() {
          select(geocoders[n], this);
        }, btn);
      })(name);
        if (!selection) {
          select(geocoders[name], btn);
        }
    } 
</script>
<!--Fin mapa js-->

@endsection
