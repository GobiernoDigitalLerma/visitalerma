<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>USUARIOS</title>
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

	<h1 align="center" style="font-family: 'Bree Serif', serif;">GESTIÓN DE USUARIOS</h1>
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
	<br>

	<div align="right">
	<a href="{{ route('usuariosalta') }}">
		<button  class="btn btn-success col-md-4">Nuevo usuario</button>
	</a>
	</div>
	<br>
<div class="table-responsive bs-example widget-shadow">
		<table id="reporte" class="usert table table-bordered ">
			<thead>
				<tr>
					<th>No. usuario</th>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Correo</th>
					<th>Telefono</th>
					<th>Avatar</th>
					<th>Tipo de usuario</th>
					<th>Operaciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($usuario as $usuarios)
			<tr>
				<td>{{$usuarios->id_usuario}}</td>
				<td>{{$usuarios->nombre}}</td>
				<td>{{$usuarios->ap}}</td>
				<td>{{$usuarios->am}}</td>
				<td>{{$usuarios->correo}}</td>
				<td>{{$usuarios->telefono}}</td>
				<td><img style="width:85px; height:85px; border-radius: 15px;" src="{{ asset('usuarios/'.$usuarios->avatar) }}"></td>
				<td>{{$usuarios->tipouser}}</td>
				<td>
					<div class="input-group">
						<a href="{{URL::action('UsuarioController@edit',['id'=>$usuarios->id_usuario])}}">
							<button class="btn-sm btn-warning" style="color: #fff;">Modificar</button>
						</a>
						&nbsp;
						{!! Form::open(['method' => 'DELETE', 'id' => 'formDelete', 'action' => ['UsuarioController@destroy', $usuarios->id_usuario]]) !!}

	                  	{!! Form::button( 'Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger elimina','id' =>  'btnelimina', 'data-id' => $usuarios->id_usuario ] ) !!}

	                  	{!! Form::close() !!}
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</table>
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
        url: '{{ url('/eliminaruser') }}' + '/' + id,
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
