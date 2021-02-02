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

	<style>
		.usert{
			z-index: 100%;
		}
	</style>
</head>
<body>
	@extends('Sistema.admin')
	@section('contenido')
				<center>
			<h1 style="font-family: 'Bree Serif',serif;">MODIFICACIÓN DE USUARIO</h1>
		   </center>

		<form class="needs-validation" novalidate enctype="multipart/form-data"   action="{{ route('updateusers') }}" method="POST">
			{{ csrf_field() }}
		<center>
	<div class="container" align="center">

			<table class="table" style="width: 50%;">
				<tr>
					<td><input type="text" name="id" class="form-control" value="{{$users[0]->id_usuario}}" readonly="" hidden="true"></td>
				</tr>
				<tr>
					<td style="text-align: right;">Nombre De Usuario:</td>
					<td>
					@foreach ($errors->all() as $error)
						<div class="alert alert-warning">
						{{ $error }}
						</div>
				    @endforeach
						<div>
							<input id="validationCustom01" type="text" name="name" class="form-control" required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" value="{{$users[0]->nombre}}">
						<div class="invalid-feedback">
                               Por favor ingresar un nombre(s) válido.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
	 			</tr>


	 			<tr>
					<td style="text-align: right;">Apellido Paterno:</td>
					<td>
						<div>
							<input id="validationCustom02" type="text" name="ap" class="form-control" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required="required" value="{{$users[0]->ap}}">
														<div class="invalid-feedback">
                               Por favor ingresar un apellido paterno válido.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
	 			</tr>


	 			<tr>
					<td style="text-align: right;">Apellido Materno:</td>
					<td>
						<div>
							<div>
								<input id="validationCustom03" type="text" name="am" class="form-control" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required="required" value="{{$users[0]->am}}">
														<div class="invalid-feedback">
                               Por favor ingresar un apellido materno válido.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
	 			</tr>


	 			<tr>
					<td style="text-align: right;">Correo:</td>
					<td>
						<div>
							<input id="validationCustom04" type="email" name="correo" pattern="[\da-z_\-.]+)@([\da-z\-.]+)\.([a-z\-.]{1,}" class="form-control" required="required" value="{{$users[0]->correo}}">
													<div class="invalid-feedback">
                               Por favor ingresar un correo válido.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
	 			</tr>


	 			<tr>
					<td style="text-align: right;">Telefono:</td>
					<td>
						<div>
							<input id="validationCustom05" type="text" name="telefono" class="form-control" pattern="[0-9]{10}" required="required" value="{{$users[0]->telefono}}">
													<div class="invalid-feedback">
                               Por favor ingresar un telefono válido.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
	 			</tr>


	 			<tr>
					<td style="text-align: right;">Tipo de Usuario:</td>
					<td>
						<div>
							<select id="SearchSelect" name="tipo_user" class="form-control" required="required">
							<option disabled="" value="">--Seleccionar tipo usuario--</option>
							@foreach($tipousuario as $tipouser)
							<option value="{{ $tipouser->id_tipo_usuario }}" @if( $tipouser->id_tipo_usuario === $users[0]->id_tipo_usuario )selected='selected' @endif>{{ $tipouser->nombre }}</option>
							@endforeach
						</select>
						<div class="invalid-feedback">
                               Por favor seleccionar tipo usuario.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
	 			</tr>


	 			<tr>
	 				<td></td>
	 				<td align="center"><a class="btn btn-primary" onclick="change()" style="color: #fff;">Cambiar Imagen</a></td>
	 			</tr>

	 			<input type="text" name="avatar2"  value="{{$users[0]->avatar}}" hidden="">
				<tr >
					<td class="invisible" id="limg" style="text-align: right;">Seleccionar imagen:</td>
					<td><div class="invisible" id="img">
							<input class="form-control-file " id="imagen" type="file" name="avatar">
						</div>
					</td>
				</tr>
     <tr>
	<td></td>
					<td align="center">
			<div id="imgoculta">
				<img style="width:85px; height:85px; border-radius: 15px;" src="{{ asset('usuarios/'.$users[0]->avatar) }}">
			</div>
			<div id="showimg"></div>
		</td>
	</tr>
			 <tr>
                       <td></td>
                       <td align="right">
                        <input type="submit" value="Guardar" class="btn btn-primary col-md-4">
                       </td>
                       </tr>
         </table>
     </div>
   </center>
</form>
	<script>
		function change() {
 			$("#img").removeClass("invisible");
 			$("#limg").removeClass("invisible");
}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		(function(){
			function filePreview(input){
				if(input.files && input.files[0]){
					var reader =new FileReader(); //clase que lee el archivo para mostrarla

					reader.onload=function(e){
						$('#showimg').html("<center><img src='"+e.target.result+"' style=width:85px; height:85;/></center>");
					}
					reader.readAsDataURL(input.files[0]);
				}
			}

			$('#imagen').change(function(){
				$("#imgoculta").remove();
				filePreview(this);
			});

			'use strict';
                             window.addEventListener('load', function() {
                                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                 var forms = document.getElementsByClassName('needs-validation');
                                 // Loop over them and prevent submission
                                 var validation = Array.prototype.filter.call(forms, function(form) {
                                     form.addEventListener('submit', function(event) {
                                          if (form.checkValidity() === false) {
                                              event.preventDefault();
                                             event.stopPropagation();
                                          }
                                         form.classList.add('was-validated');
                                      }, false);
                                 });
                              }, false);


		})();
	</script>
	@stop
</body>
</html>

