<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>TIPO USUARIO</title>
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

<!--Inicio Boron de Altas-->
	<h1 align="center" style="font-family: 'Bree Serif', serif;"> GESTIÓN DE TIPO DE USUARIOS</h1>
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
	<div align="right"><a href="{{URL::to('/tipo_usuarios')}}" class="btn btn-success col-md-4">Nuevo Tipo de Usuario</a></div><br>


		<div class="table-responsive bs-example widget-shadow">
		<table class="usert table table-bordered " id="reporte">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</tr> 
			</thead>
			<tbody>
				@foreach($consul as $c)
				<tr>
					<th scope="row">{{$c->clave}}</th>
					<td>{{$c->nombre}}</td> 

					<td>
						<div class="input-group">
							<a href="{{URL::action('TipoUsuarioController@edita_tusuariosvista',['id_tipo_usuario'=>$c->clave])}}"  class="btn btn-warning">
							Modificar
						    </a>

              @if($c->activo==0)
          
              
              <a href="{{URL::action('TipoUsuarioController@reactivartusuario',['id_tipo_actividad'=>$c->clave])}}"  class="btn btn-success" name="Activar" value="Activar">
              Activar
                </a>


               @else 

							&nbsp;
							{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteProduct', 'action' => ['TipoUsuarioController@destroy', $c->clave]]) !!}

		                  	{!! Form::button( 'Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger deleteProduct','id' =>  'btnDeleteProduct', 'data-id' => $c->clave ] ) !!}

		                  	{!! Form::close() !!}
              @endif
					    </div> 
					   
    				</td>

				</tr>
			@endforeach

			</tbody> 
		</table> 
	</div>

<script>

$('.deleteProduct').on('click', function(e) {
    var inputData = $('#formDeleteProduct').serialize();


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
        url: '{{ url('/eliminartusuario') }}' + '/' + id,
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