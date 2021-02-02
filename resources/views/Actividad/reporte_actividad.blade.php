<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ACTIVIDAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <link rel="stylesheet" href="{{{ asset('sweetalert2/dist/sweetalert2.min.css')}}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.all.min.js')}}}"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.min.js')}}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	<style>
		.usert{
			z-index: 100%;
		}
    .box {
        border: 1px solid #333333;
        width: 150px;
        height: 100px;
        overflow: scroll;
        border-color: white;
        overflow-x: hidden;
      }

	</style>
</head>
<body>
	@extends('Sistema.admin')
	@section('contenido')

<center>
	<h1 style="font-family: 'Bree Serif',serif;">GESTION DE ACTIVIDAD</h1></center>
	<br>
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
		<div align="right">
			<a href="{{ URL::to('alta_actividad') }}"><button class="btn btn-success col-md-4">Nueva actividad</button></a>
		</div>
	<br>
	<div class="table-responsive">
	<table class="table table-bordered" id="reporte">
		<thead>
			<th>No Actividad</th>
			<th>Nombre Actividad</th>
			<th>Descripcion</th>
			<th>Artistas</th>
			<th>Fecha de Inicio</th>
      <th>Fecha de Fin</th>
			<th>Horarios</th>
			<th>Tipo de Actividad</th>
      <th>Ubicacion</th>
      <th>Seccion de Pagina</th>
			<th>Operaciones</th>
		</thead>
		<tbody>
			@foreach($a as $a)
				<tr>
					<td>{{ $a->id_actividad }}</td>
					<td>{{ $a->nombre }}</td>
					<td><div class="box">{{ $a->descripcion }}</div></td>
					<td><div class="box">{{ $a->artista }}</div></td>
					<td>{{ $a->fecha_inicio }}</td>
		 			<td>{{ $a->fecha_fin_actividad }}</td>
					<td>{{ $a->horario_detalle }}</td>
					<td>{{ $a->tipo }}</td>
          <td>{{ $a->idu }}</td>
          @if( $a->secciones  == 1)
          <td>¿Que hacer?</td> 
          @else
            @if($a->secciones==2)
            <td>¿Que sucede ahora?</td>
            @else
              @if($a->secciones==3)
              <td>Conoce lerma</td>
              @else
                @if($a->secciones==4)
                <td>Festivales y Cultura</td>
                @else
                  @if($a->secciones==5)
                  <td>Artesanias</td>
                  @else
                    @if($a->secciones==6)
                    <td>Actividades</td>
                    @else
                    <td>No hay seccion</td>
                    @endif
                  @endif
                @endif
              @endif
            @endif
          @endif
					<td>
						<div class="input-group">
							@if($a->activo==0)
							&nbsp;                                                    
							{!! Form::open(['method' => 'DELETE', 'id' => 'formDelete', 'action' => ['ActividadController@activa', $a->id_actividad]]) !!}

	                  		{!! Form::button( 'Activar', ['type' => 'submit', 'class' => 'btn btn-primary activa','id' =>  'btnactiva', 'data-id' => $a->id_actividad ] ) !!}

	                  		{!! Form::close() !!}
							@else
							&nbsp;                                                    
							{!! Form::open(['method' => 'DELETE', 'id' => 'formDelete', 'action' => ['ActividadController@desactiva', $a->id_actividad]]) !!}

	                  		{!! Form::button( 'Desactivar', ['type' => 'submit', 'class' => 'btn btn-primary desactiva','id' =>  'btndesactiva', 'data-id' => $a->id_actividad ] ) !!}

	                  		{!! Form::close() !!}
	                  		@endif
	                  		<br><br>
							<a href="{{ URL::action('ActividadController@modificar_actividad',['ida'=>$a->id_actividad]) }}"><button class="btn btn-warning">Modificar</button></a>
							<br>                                                    
							&nbsp;                                                    
              {!! Form::open(['method' => 'DELETE', 'id' => 'formDelete', 'action' => ['ActividadController@destroy', $a->id_actividad]]) !!}

                        {!! Form::button( 'Eliminar', ['type' => 'warning', 'class' => 'btn btn-danger elimina','id' =>  'btnelimina', 'data-id' => $a->id_actividad ] ) !!}

                        {!! Form::close() !!}
	                  		
                  		</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script>

$('.desactiva').on('click', function(e) {
    var inputData = $('#formDelete').serialize();


    var id = $(this).attr('data-id');
    var parent = $(this).parent();

    Swal.fire({
  title: 'Estas seguro?',
  text: "¡No podrás revertir esto!",

  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Desactivar!'
}).then((result) => {
  if (result.value) {

$.ajax({
        url: '{{ url('/desactivaractividad') }}' + '/' + id,
        type: 'POST',
        data: inputData,
        success: function( msg ) {
            if ( msg.status === 'success' ) {
              Swal.fire({

  icon: 'success',
  title: 'Registro desactivado con exito',
  showConfirmButton: false,
  timer: 1000
})	
              location.reload();

            }
        },
        error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('Cannot delete the category');
            }
        }
    });
  }
})

    return false;
});

</script>

<script>

$('.elimina').on('click', function(e) {
    var inputData = $('#formDelete').serialize();


    var id = $(this).attr('data-id');
    var parent = $(this).parent();

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
        url: '{{ url('/eliminaractividad') }}' + '/' + id,
        type: 'POST',
        data: inputData,
        success: function( msg ) {
            if ( msg.status === 'success' ) {
              Swal.fire({

  icon: 'success',
  title: 'Registro Eliminado con exito',
  showConfirmButton: false,
  timer: 1000
})  
              location.reload();

            }
        },
        error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('Cannot delete the category');
            }
        }
    });
  }
})

    return false;
});

</script>

<script>

$('.activa').on('click', function(e) {
    var inputData = $('#formDelete').serialize();


    var id = $(this).attr('data-id');
    var parent = $(this).parent();

    Swal.fire({
  title: 'Estas seguro?',
  text: "¡No podrás revertir esto!",

  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Activar!'
}).then((result) => {
  if (result.value) {

$.ajax({
        url: '{{ url('/activaractividad') }}' + '/' + id,
        type: 'POST',
        data: inputData,
        success: function( msg ) {
            if ( msg.status === 'success' ) {
              Swal.fire({

  icon: 'success',
  title: 'Registro activado con exito',
  showConfirmButton: false,
  timer: 1000
})
            location.reload();


            }
        },
        error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('Cannot delete the category');
            }
        }
    });
  }
})

    return false;
});

</script>
@stop
</body>
</html> 