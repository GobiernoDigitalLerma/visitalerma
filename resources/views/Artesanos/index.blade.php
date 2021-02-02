<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ARTESANOS</title>
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
	<h1 style="font-family:bree serif,serif; ">GESTIÓN DE Artesanos</h1>
</div>
<br>

<div align="right">
	<a href="{{route('altartesano')}}"><button class="btn btn-success col-md-4">Nuevo Artesano</button></a>
</div>
<br>
	<div class="table-responsive">
  <table class="table table-bordered" id="reporte">
			<thead>
				<th>No. Artesano</th>
        			<th>Nombre</th>
				<th>Direccion</th>
				<th>Telefono</th>
        <th>Correo</th>
        <th>Logros</th>
        <th>Historia</th>
				<th>Operaciones</th>
			</thead>
			<tbody>
	@foreach($artesano as $re)
	<tr>
	<td>{{$re->id_art}}</td>
        <td>{{$re->nombre}}</td>
	<td>{{$re->direccion}}</td>
        <td>{{$re->telefono}}</td>
        <td>{{$re->correo}}</td>
        <td>{{$re->logros}}</td>
        <td>{{$re->historias}}</td>
				<td>
					<div class="input-group">
	         			<a href="{{route('editarartesano',['re'=>$re->id_art])}}"> <button class="btn btn-warning">Modificar</button></a>
	         			&nbsp;
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