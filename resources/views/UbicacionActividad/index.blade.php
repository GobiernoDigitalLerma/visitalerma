@extends('Sistema.admin')
@section('contenido')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{{ asset('sweetalert2/dist/sweetalert2.min.css')}}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.all.min.js')}}}"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.min.js')}}}"></script>
    	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
	<div align="center">
	<h1 style="font-family:bree serif,serif;">GESTIÓN DE UBICACIONES DE ACTIVIDADES</h1>
	</div>
	<br>
	<div align="right">
	<a href="{{url('create-ubicacion-actividad')}}"><button class="btn btn-success">Añadir Ubicación</button></a>
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $("#content").fadeOut(1500);
            },3000);
 
            setTimeout(function() {
                $(".content2").fadeIn(1500);
            },6000);
        });
  </script>
	</div>
  @php
    {{
      function region($variable){

        switch ($variable) {
          case 1:
            return "I Huitzizilapan";
          break;
          case 2:
            return "II Tlalmimilolpan";
          break;
          case 3:
            return "III Atarasquillo";
          break;
          case 4:
            return "IV Ameyalco";
          break;
          case 5:
            return "V Lerma";
          break;
          case 6:
            return "VI Tultepec";
          break;
          case 7:
            return "VII Peralta- Xochicuautla- Analco";
          break;
          case 8:
            return "VIII Partidas-Parque Industrial";
          break;
          default:
            return "No aplica";
          break;
        }

      }
    }}
  @endphp
	<br>
	<table class="table table-borderd" id="reporte">
			<thead align="left">
				<th>Nombre</th>
				<th>Latitud</th>
				<th>Longitud</th>
        <th>Región</th>
				<th>Operaciones</th>
				<th></th>
			</thead>
			<tbody>
				@if($ubicaciones->count())
				@foreach($ubicaciones as $ubicacion)
				<tr>
				<td>{{$ubicacion->nombre}}</td>
				<td>{{$ubicacion->fx}}</td>
				<td>{{$ubicacion->fy}}</td>
        <td>{{region($ubicacion->region)}}</td>
				<td>
					<a class="btn btn-warning" href="{{action('UbicacionActividadController@edit', $ubicacion->id_ubicacion_actividad)}}" >Modificar</a>
         		</td>
         		<td>
                    <button class="btn btn-danger elimina" name="{{ $ubicacion->id_ubicacion_actividad }}">Eliminar</button>
         		</td>
				</tr>
				@endforeach
				@else
               	<tr>
                	<td>No hay registros...</td>
              	</tr>
              	@endif
			</tbody>
	</table>
<script type="text/javascript">

$('.elimina').on('click', function(e) {
    var id = $(this).attr('name');
    Swal.fire({
  		title: 'Estas seguro?',
  		text: "¡No podrás revertir esto!",
  		icon: 'warning',
  		showCancelButton: true,
  		confirmButtonColor: '#3085d6',
  		cancelButtonColor: '#d33',
  		confirmButtonText: 'Si, Eliminar!'
		}).then((result) => {

  		if (result.value) {

        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: '{{ url('eliminar-ubicacion-actividad-ajax') }}' + '/' + id,
          method: 'POST',
          success: function( msg ) {
              if ( msg.status === 'success' ) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Registro eliminado con exito',
                      showConfirmButton: false,
                      timer: 1000
               })
                      parent.slideUp(300, function () {
                      parent.closest("tr").remove();
                });
                 setInterval(function() {
                  
                 }, 5900);
            }
          },
          error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('No se puede eliminar este registro.');
            }
          }
        });

      }else if(!result.value){

        Swal.fire(
            'Cancelado',
            'El registro no ha sido eliminado.',
            'success'
        )

      }

  		window.location.reload();
	});

    //return false;
});
</script>
@endsection

