<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>RESEÑA ACTIVIDAD</title>
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
	</style>
</head> 
<body>
	@extends('Sistema.admin')
	@section('contenido')
	<div align="center">
	<h1 style="font-family:bree serif,serif; ">GESTIÓN DE RESEÑAS DE ACTIVIDADES</h1>
</div>
<br>

<div align="right">
	<a href="{{route('altaresena')}}"><button class="btn btn-success col-md-4">Nueva reseña de actividad</button></a>
</div>
<br>
	<div class="table-responsive">
  <table class="table table-bordered" id="reporte">
			<thead align="center">
       	<th>Nombre</th>
				<th>Detalle</th>
				<th>Evento</th>
				<th>Operaciones</th>
			</thead>
			<tbody align="center">
				@foreach($rese as $re)
				<tr>
        <td>{{$re->nombre}}</td>
				<td>{{$re->detalle}}</td>
				<td>{{$re->actividad}}</td>
				<td>
					<div class="input-group">
	         			<a href="{{route('modificaresena',['re'=>$re->id_resena_actividad])}}"> <button class="btn btn-warning">Modificar</button></a>
	         			&nbsp;
						{!! Form::open(['method' => 'DELETE', 'id' => 'formDelete', 'action' => ['ResenaActividadController@destroy', $re->id_resena_actividad]]) !!}
 
	                  	{!! Form::button( 'Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger elimina','id' =>  'btnelimina', 'data-id' => $re->id_resena_actividad ] ) !!}

	                  	{!! Form::close() !!}
	                  </div>
         		</td>
				</tr>
				@endforeach
			</tbody>

	</table>
</div>
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
        url: '{{ url('/eliminaresenaactividad') }}' + '/' + id,
        type: 'POST',
        data: inputData,
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