@extends('pagina.header')
@section('contenido')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.6.0/dist/Control.Geocoder.css"/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet-src.js"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder@1.6.0/dist/Control.Geocoder.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet'/>
  <script src="{{ asset('map/MiniMap/Control.MiniMap.js') }}" type="text/javascript"></script>
  <link href="{{ asset('map/MiniMap/Control.MiniMap.css') }}" rel='stylesheet'/>
  <link href="{{ asset('map/markerCluster/MarkerCluster.css') }}" rel='stylesheet'/>
  <link href="{{ asset('map/markerCluster/MarkerCluster.Default.css') }}" rel='stylesheet'/>
  <link href="{{ asset('map/awesome-markers/leaflet.awesome-markers.css') }}" rel='stylesheet'/>
  <script src="{{ asset('map/awesome-markers/leaflet.awesome-markers.js') }}" type="text/javascript"></script>
  <script src="{{ asset('map/markerCluster/leaflet.markercluster-src.js') }}" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <link href="{{ asset('map/neo-map/neo-map.css') }}" rel='stylesheet'/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-2 mb-2">
  <div class="row">
    <ol class="breadcrumb bg-light col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0px">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('conoce_lerma') }}">Pueblo con encantó</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ "Mapa" }}</li>
    </ol>
  </div>
</div>
<div class="container mt-2 mb-2 padding-xdn">
  <div class="row">
    <div class="col-sm-4">
      <div>
        <div class="card-header header-xdn">
          <h3>Pueblo con encantó</h3>
        </div>
        <div class="card-body background-xdn">
          <div class="content-file">
          </div>
          <div class="content-p-text mb-1 mt-1">
          	<textarea class="form-control p-xdn" rows="4" hidden="true"></textarea>
          </div>
          <div id="ver-mas" class="mb-1 mt-1" align="center">
          </div>
          <span>
            <div class="d-block d-sm-block d-md-none mb-1 mt-1" id="text-xdn">*Rotar pantalla en forma horizontal para visualizar mapa.</div>
          </span>
          <div class="col align-self-center">
          <div class="card-header header-xdn">
            <h4>Centros historicos</h4>
          </div>
          <div class="card-body mb-2 body-xdn">
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div id="add-map">
        <div id="map"></div>
      </div>
    </div>  
  </div>
</div>
<script>
  $(document).ready(function(){

    var json = @json($actividades);

    values();

    map(null);

    function datos(value){

      $(".content-file").empty();

      $(".p-xdn").html("");

      $(".p-xdn").removeAttr("hidden");

      if(json[value].video == null){

        $(".content-file").append('<img src="'+'{{ asset('foto_actividades') }}'+'/'+json[value].foto+'" class="frame-xdn">');

      }else{

        $(".content-file").append('<iframe class="frame-xdn" src="https://www.youtube.com/embed/'+json[value].video+'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');

      }

      $(".p-xdn").html(json[value].descripcion);


    }

    function values(){

      $(".body-xdn").empty();

      for (i=0; i < json.length; i++) { 

        $(".body-xdn").append('<button class="btn btn-info btn-sm mb-1 btn-xdn" style="width: 100%" name="'+json[i].xdn+'">'+json[i].nombre+'</button>');

      }

    }

    function color(){

      var colors = ['red', 'blue', 'green', 'purple', 'orange', 'darkred', 'lightred', 'beige', 'darkblue', 'darkgreen', 'cadetblue', 'darkpurple', /*'white',*/'pink', 'lightblue', 'lightgreen', 'gray', 'black', 'lightgray'];

      return colors[Math.floor(Math.random()*colors.length)];

    }

    function map(type){

          $("#map").remove();

          $("#add-map").append('<div id="map"></div>');

          var map =   new L.Map('map'),
                      geocoders = {
                              'Nominatim': L.Control.Geocoder.nominatim()
                      },
                      selector = L.DomUtil.get('geocode-selector'),
                      control = new L.Control.Geocoder({ geocoder: null }),
                      btn,
                      selection,
                      marker;

          var url ='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

          var contribucion = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>contributors';

          var configuracion = new L.TileLayer(url, {minZoom: 5, maxZoom: 18, attribution: contribucion, zoomInTitle:"Aumentar zoom",zoomOutTitle: "Reducir zoom"});

          map.addLayer(configuracion);

          map.setView(new L.LatLng(19.2872286,-99.5114821),15);

          map.scrollWheelZoom.disable();

          var configuracion2 = new L.TileLayer(url, {minZoom: 0, maxZoom: 13, attribution: contribucion });


          var miniMap = new L.Control.MiniMap(configuracion2,{ 
                toggleDisplay: true, minimized: true, 
                collapsedWidth: 30, collapsedHeight: 30})
                  .addTo(map);

          map.addControl(new L.Control.Fullscreen({
            title: {
              'false': 'Mostrar pantalla completa',
              'true': 'Salir de pantalla completa'
            }
          }));

          var markers = L.markerClusterGroup({ 
                    spiderfyOnMaxZoom: false, 
                    showCoverageOnHover: false, 
                    zoomToBoundsOnClick: false });

          control.addTo(map);

          var polygonPoints = [
                [19.286625743680574,  -99.5194856408849],   //1
                [19.286848865026464,  -99.51896033414937],  //2
                [19.28650230328372,   -99.51282676496355],  //3
                [19.289587570702235,  -99.51267818578158],  //4
                [19.289587570702235,  -99.51174956589436],  //5
                [19.28823777336071,   -99.51169384870113],  //6
                [19.287801895887437,  -99.5048782736514],   //7
                [19.286634473912198,  -99.50485618722385],  //8  
                [19.28580059597651,   -99.50227207520165],  //9
                [19.284862478222767,  -99.5024708530495],   //10
                [19.2848624781803,    -99.5024266800771],   //11
                [19.2848624781803,    -99.49705967818478],  //12
                [19.28429960494829,   -99.49699341890215],  //13
                [19.284237063358642,  -99.49765601172837],  //14
                [19.280984867783335,  -99.49708176461232],  //15
                [19.279859092730035,  -99.5069764841504],   //16
                [19.279838244970897,  -99.50940599117985],  //17
                [19.28092232492781,   -99.51446378308657],  //18
                [19.281631142558563,  -99.51450795594165],  //19
                [19.282881989717577,  -99.51846142647138],  //20
                [19.28638431093493,   -99.51819638934089]   //21
              ];

          var points = L.polygon(polygonPoints,{color: "#fd1d1d"}).addTo(map);

          if(type == null){

            for(i=0; i < json.length; i++){

            	if( json[i].fecha_inicio == null && json[i].fecha_fin_actividad == null ){

            		var m = L.marker([json[i].fx,json[i].fy],
                        {icon: L.AwesomeMarkers.icon({
                         icon:"fa-compass", 
                         prefix: 'fa', 
                         markerColor: color() }),
                         title: ""+json[i].nombre+"",draggable: true })
                        .bindPopup("<i><h6>"+json[i].nombre+"</h6><br>Horario:"+json[i].horario_detalle+"</br>Lugar: "+json[i].ubicacion+"<br><a href='"+"{{ url('conoce_lerma_actividades') }}"+"/"+json[i].nombre+"' target='_blank'>Ver más...</a></i>");

                	markers.addLayer(m);

            	}else{

            		var m = L.marker([json[i].fx,json[i].fy],
                        {icon: L.AwesomeMarkers.icon({
                         icon:"fa-compass", 
                         prefix: 'fa', 
                         markerColor: color() }),
                         title: ""+json[i].nombre+"",draggable: true })
                        .bindPopup("<i><h6>"+json[i].nombre+"</h6><br>Horario:"+json[i].horario_detalle+"<br>Fecha inicio: "+json[i].fecha_inicio+'<br>Fecha fin: '+json[i].fecha_fin_actividad+"</br>Lugar: "+json[i].ubicacion+"<br><a href='"+"{{ url('conoce_lerma_actividades') }}"+"/"+json[i].nombre+"' target='_blank'>Ver más...</a></i>");

                	markers.addLayer(m);

            	}

            }

            markers.on('clusterclick', function (a) {
              a.layer.spiderfy();
            });

            map.addLayer(markers);

          }else{

          	$("#ver-mas").empty();

          	$("#ver-mas").append("<button class='btn btn-success btn-sm link-xdn' style='width: 100%' xdn='"+"{{ url('conoce_lerma_actividades') }}"+"/"+json[type].nombre+"'>Ver más...</button>");

          	if(json[type].fecha_inicio == null && json[type].fecha_fin_actividad == null ){

          		var m = L.marker([json[type].fx,json[type].fy],
                        {icon: L.AwesomeMarkers.icon({
                         icon:"fa-compass", 
                         prefix: 'fa', 
                         markerColor: color() }),
                         title: ""+json[type].nombre+"",draggable: true })
                        .bindPopup("<i><h6>"+json[type].nombre+"</h6><br>Horario:"+json[type].horario_detalle+"</br>Lugar: "+json[type].ubicacion+"<br><a href='"+"{{ url('conoce_lerma_actividades') }}"+"/"+json[type].nombre+"' target='_blank'>Ver más...</a></i>");

                markers.addLayer(m);

          	}else{

          		var m = L.marker([json[type].fx,json[type].fy],
                        {icon: L.AwesomeMarkers.icon({
                         icon:"fa-compass", 
                         prefix: 'fa', 
                         markerColor: color() }),
                         title: ""+json[type].nombre+"",draggable: true })
                        .bindPopup("<i><h6>"+json[type].nombre+"</h6><br>Horario:"+json[type].horario_detalle+"<br>Fecha inicio: "+json[type].fecha_inicio+'<br>Fecha fin: '+json[type].fecha_fin_actividad+"</br>Lugar: "+json[type].ubicacion+"<br><a href='"+"{{ url('conoce_lerma_actividades') }}"+"/"+json[type].nombre+"' target='_blank'>Ver más...</a></i>");

                markers.addLayer(m);

          	}

            markers.on('clusterclick', function (a) {
              a.layer.spiderfy();
            });

            map.addLayer(markers);

          }

    }

    $(".btn-xdn").on("click",function(){

      var val = json.findIndex(element => element.xdn === parseInt($(this).attr("name")));

      map(val);

      datos(val);

    });

    $(document).on("click",'.link-xdn',function(){

    	var to = $(this).attr("xdn");

    	window.open(to, "_blank");

    });

  });
</script>
@endsection