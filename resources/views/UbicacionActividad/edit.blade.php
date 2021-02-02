@extends('Sistema.admin')
@section('contenido')

  <!--Core-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@latest/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@latest/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet@latest/dist/leaflet-src.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder@latest/dist/Control.Geocoder.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet'/>
    <script src='{{asset('map/MiniMap/Control.MiniMap.js')}}' type="text/javascript"></script>
    <link href='{{asset('map/MiniMap/Control.MiniMap.css')}}' rel='stylesheet'/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
      #map {
        height: 300px;
        width: 400px;
        position: relative;
        box-shadow: 5px 5px 5px #888;
      }
    </style>
    <!--Fin Core-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  @if($errors->any())
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error}}</li>
    @endforeach
  </ul>
  @endif
  <div align="center">
    <h1 style="font-family:bree serif,serif;">MODIFICACIÓN UBICACIÓN ACTIVIDADES</h1>
  </div>
  <div class="row">
  <div class="col-6">
    <table class="table table-borderd">
      <tbody align="right">
        <tr>
          <th hidden="true"><label>ID:</label></th>
          <td hidden="true"><input type="text" name="id" id="id" class="form-control"  value="{{ $ubicacion->id_ubicacion_actividad }}" disabled="true" required></td>
        </tr>
        <tr>
                <th><label>Región:</label></th>
                <td>
                  <select name="region" id="region" class="form-control" required>
                      <option value="0" @if ($ubicacion->region == 0) {{ 'selected' }} @endif>
                        Selecciona región
                      </option>
                      <option value="1" @if ($ubicacion->region == 1) {{ 'selected' }} @endif>
                        I Huitzizilapan
                      </option>
                      <option value="2" @if ($ubicacion->region == 2) {{ 'selected' }} @endif>
                        II Tlalmimilolpan
                      </option>
                      <option value="3" @if ($ubicacion->region == 3) {{ 'selected' }} @endif>
                        III Atarasquillo
                      </option>
                      <option value="4" @if ($ubicacion->region == 4) {{ 'selected' }} @endif>
                        IV Ameyalco
                      </option>
                      <option value="5" @if ($ubicacion->region == 5) {{ 'selected' }} @endif>
                        V Lerma
                      </option>
                      <option value="6" @if ($ubicacion->region == 6) {{ 'selected' }} @endif>
                        VI Tultepec
                      </option>
                      <option value="7" @if ($ubicacion->region == 7) {{ 'selected' }} @endif>
                        VII Peralta- Xochicuautla- Analco
                      </option>
                      <option value="8" @if ($ubicacion->region == 8) {{ 'selected' }} @endif>
                        VIII Partidas-Parque Industrial
                      </option>
                      <option value="9" @if ($ubicacion->region == 9) {{ 'selected' }} @endif>
                        No aplica / Ubicación externa a lerma
                      </option>
                  </select>
                </td>
              </tr>
        <tr>
          <th hidden="true"><label>ID:</label></th>
          <td hidden="true"><input type="text" name="id" id="id" class="form-control"  value="{{ $ubicacion->id_ubicacion_actividad }}" disabled="true" required></td>
        </tr>
        <tr>
          <th><label>Nombre:</label></th>
          <td><input type="text" name="nombre" id="nombre" class="form-control" value="{{ $ubicacion->nombre }}" required></td>
        </tr>
        <tr>
          <th><label>Latitud:</label></th>
          <td><input type="text" name="fx" id="fx" class="form-control" disabled="true" value="{{ $ubicacion->fx }}" required></td>
        </tr>
        <tr>
          <th><label>Longitud:</label></th>
          <td>
            <input type="text" name="fy" id="fy" class="form-control" disabled="true" value="{{ $ubicacion->fy }}" required>
          </td>
        </tr>
      </tbody>
    </table>
    <div align="right" ><button class="btn btn-primary" id="form">Guardar</button></div>
  </div>
  <div class="col-6">
    <table class="table table-borderd">
      <tbody>
        <tr>
          <th>
            <td>
               <div id="map-add">
                  <div id="map"></div>
                </div>
               <div id="geocode-selector" hidden="true"></div>
            </td>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
<script>
  $(document).ready(function() {

        function coordenadas(dato1, dato2){
          $("input[name=fx]").val("");
          $("input[name=fy]").val("");
          $("input[name=fx]").val(dato1);
          $("input[name=fy]").val(dato2);
        } 

        modificacion();

        function modificacion(){

          var x = parseFloat("{{ $ubicacion->fx }}");

          var y = parseFloat("{{ $ubicacion->fy }}");

          var co = regionRegistro(parseInt("{{ $ubicacion->region }}"));

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

            var contribucion='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

            var configuracion = new L.TileLayer(url, {minZoom: 5, maxZoom: 18, attribution: contribucion, zoomInTitle:"Aumentar zoom",zoomOutTitle: "Reducir zoom"});

            map.addLayer(configuracion);

            map.setView(new L.LatLng(co[0],co[1]),co[2]);

            var configuracion2 = new L.TileLayer(url, {minZoom: 0, maxZoom: 13, attribution: contribucion });

            var miniMap = new L.Control.MiniMap(configuracion2, { toggleDisplay: true, minimized: true, collapsedWidth: 30, collapsedHeight: 30 }).addTo(map);

            map.addControl(new L.Control.Fullscreen({
              title: {
                'false': 'Mostrar pantalla completa',
                'true': 'Salir de pantalla completa'
              }
            }));

            control.addTo(map);

            L.marker([x,y],{draggable: true, title: "Ubicación registro"})
            .bindPopup("<i>Está es la ubicación de tu registro</i>").addTo(map);

            var iconMarker = L.icon({
                //iconUrl: "{{ asset('map/logo.png') }}",
                iconSize: [32, 32],
            });

            map.doubleClickZoom.disable();

            map.on('dblclick', e => {
              var latLng = map.mouseEventToLatLng(e.originalEvent);
              coordenadas(latLng.lat,latLng.lng);
              L.marker([latLng.lat, latLng.lng], { icon: iconMarker }).addTo(map);
            });

            $(".leaflet-marker-icon").on('mouseup',function(e){
              var latLng = map.mouseEventToLatLng(e.originalEvent);
              coordenadas(latLng.lat,latLng.lng);
            });
        }

        function regionRegistro(valor){
          switch (valor) {
              case 1:
                  var coord = new Array(19.397511,-99.4502421,14.0);
                  return coord;
              break;
              case 2:
                  var coord = new Array(19.3904982,-99.4819231,14.0);
                  return coord;
              break;
              case 3:
                  var coord = new Array(19.3271021,-99.4728312,14.0);
                  return coord;
              break;
              case 4:
                  var coord = new Array(19.3088483,-99.454571,14.0);
                  return coord;
              break;
              case 5:
                  var coord = new Array(19.289761,-99.5150536,14.0);
                  return coord;
              break;
              case 6:
                  var coord = new Array(19.2715538,-99.509878,14.0);
                  return coord;
              break;
              case 7:
                  var coord = new Array(19.3562699,-99.477172,14.0);
                  return coord;
              break;
              case 8:
                  var coord = new Array(19.306233,-99.5445111,14.0);
                  return coord;
              break;
              default:
                  var coord = new Array(19.289761,-99.5150536,12.0);
                  return coord;
              break;
        }
        }

        $("#region").on('change',function(){
            region(parseInt($(this).val()));
        });   

        function region(valor){
          switch (valor) {
              case 1:
                renderMap(19.397511,-99.4502421,14);
              break;
              case 2:
              renderMap(19.3904982,-99.4819231,14);
              break;
              case 3:
                renderMap(19.3271021,-99.4728312,14);
              break;
              case 4:
                renderMap(19.3088483,-99.454571,14);
              break;
              case 5:
                renderMap(19.289761,-99.5150536,14);
              break;
              case 6:
                renderMap(19.2715538,-99.509878,14);
              break;
              case 7:
                renderMap(19.3562699,-99.477172,14);
              break;
              case 8:
                renderMap(19.306233,-99.5445111,14);
              break;
              default:
                renderMap(19.289761,-99.5150536,12);
              break;
        }
      }

      function renderMap(fx,fy,fl){

      var x = parseFloat(fx);

      var y = parseFloat(fy);

      var l = parseFloat(fl);

      var afterX = parseFloat("{{ $ubicacion->fx }}");

      var afterY = parseFloat("{{ $ubicacion->fy }}");

      $("#map").remove();

      $("#map-add").append("<div id='map'></div>");

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

      var contribucion='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

      var configuracion = new L.TileLayer(url, {minZoom: 5, maxZoom: 18, attribution: contribucion, zoomInTitle:"Aumentar zoom",zoomOutTitle: "Reducir zoom"});

      map.addLayer(configuracion);

      map.setView(new L.LatLng(x,y),l);

      var configuracion2 = new L.TileLayer(url, {minZoom: 0, maxZoom: 13, attribution: contribucion });

      var miniMap = new L.Control.MiniMap(configuracion2, { toggleDisplay: true, minimized: true, collapsedWidth: 30, collapsedHeight: 30 }).addTo(map);

      map.addControl(new L.Control.Fullscreen({
        title: {
          'false': 'Mostrar pantalla completa',
          'true': 'Salir de pantalla completa'
        }
      }));

      control.addTo(map);

      L.marker([x,y],{draggable: true, title: "Asignar nueva ubicacion."})
            .bindPopup("<i>Asignar nueva ubicacion.</i>").addTo(map);

      //L.marker([afterX,afterY],{draggable: true, title: "Ubicación registro"}).bindPopup("<i>Está es la ubicación de tu registro</i>").addTo(map);

      var iconMarker = L.icon({
                //iconUrl: "{{ asset('map/logo.png') }}",
                iconSize: [32, 32],
      });

      map.doubleClickZoom.disable();

      map.on('dblclick', e => {
        var latLng = map.mouseEventToLatLng(e.originalEvent);
        coordenadas(latLng.lat,latLng.lng);
        L.marker([latLng.lat, latLng.lng], { icon: iconMarker }).addTo(map);
      });

      $(".leaflet-marker-icon").on('mouseup',function(e){
        var latLng = map.mouseEventToLatLng(e.originalEvent);
        coordenadas(latLng.lat,latLng.lng);
      });
  }
    $("#form").on('click', function() {
              let id_ubicacion_actividad = $("#id").val();
              let nombre =  $("#nombre").val();
              let fx =    $("#fx").val();
              let fy =    $("#fy").val();
              let region =    $("#region").val();

            if(nombre != "" && fx != "" && fy != "" && region != "0"){

                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: '{{ url('update-ubicacion-actividad') }}'+"/"+id_ubicacion_actividad,
                    type: 'POST',
                    data: { nombre:nombre,
                            fx:fx,
                            fy:fy,
                            region:region},
                    success: function (data) {
                      alert(data.success);
                      window.location.replace("{{ url('ubicaciones-actividad') }}");
                    }
                });

            }else{

                alert("Ingresa todos los datos");

            }

          });

  });
</script>
  @endsection

