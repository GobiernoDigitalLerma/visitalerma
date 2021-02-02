<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>USUARIOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
	<style>
		.usert{
			z-index: 100%;
		}
		@media screen and (min-width: 992px) {
 #tabla{
      height: 100%;
    }
  }
	</style>
</head>
<body>
	@extends('Sistema.admin')
	@section('contenido')
<center>
			<h1 style="font-family: 'Bree Serif',serif;">USUARIO</h1>
		   </center>
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



		<form class="needs-validation" novalidate enctype="multipart/form-data"  action="{{ route('creauser') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<center>
		   <div class="container" align="center">
			<table class="table col-md-7" >
				<tr>
				@foreach ($errors->all() as $error)
					<div class="alert alert-warning">
					{{ $error }}
					</div>
				@endforeach
					<td style="text-align: right;">Nombre</td>
					<td>
						<div>
						<input id="validationCustom01" placeholder="Nombre(s)" type="text" name="name" class="form-control" required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}">
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
							<input id="validationCustom02" placeholder="Apellido Paterno" type="text" name="ap" class="form-control" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required="required">
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
						<input id="validationCustom03" placeholder="Apellido Materno" type="text" name="am" class="form-control" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required="required">
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
						<input id="validationCustom04" placeholder="example@example.com" type="email" name="correo" pattern="[\da-z_\-.]+)@([\da-z\-.]+)\.([a-z\-.]{1,}" class="form-control" required="required">
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
					<td><div>
						<input id="validationCustom05" placeholder="(722) *** ****" type="text" name="telefono" class="form-control" pattern="[0-9]{10}" required="required">
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
					<td style="text-align: right;">Contraseña:</td>
					<td>
						<div>
						<input id="validationCustom06" type="password" name="password" class="form-control" required="required" onchange="form.contraseña2.pattern = this.value;" name="contraseña"  
           				title="Debes incluir mayusculas, minusculas y numeros" placeholder="Incluir mayusculas, minusculas y numeros">
           			<div class="invalid-feedback">
                               Por favor ingresar una contraseña valida.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
	 			</tr>
	 			<tr>
					<td style="text-align: right;">Confirmar Contraseña:</td>
					<td>
						<div>
							<input id="validationCustom07" type="password" class="form-control" name="contraseña2" pattern="" title=" las Contraseñas no coinciden" required="">
           			<div class="invalid-feedback">
                               Por favor revisar contraseña de confirmación.
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
							<select id="SearchSelect" name="tipo_user" class="form-control " required="required">
								<option value="" hidden="">--Seleccionar tipo usuario--</option>
								@foreach($tipousuario as $tipouser)
								<option value="{{$tipouser->id_tipo_usuario}}">{{$tipouser->nombre}}</option>
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
	 				<td style="text-align: right;">Avatar:</td>
	 				<td><div>
							<input class="form-control-file" type="file" name="avatar" id="validationCustom09" placeholder="Elije una imagen" required="">
						<div class="invalid-feedback">
                               Por favor inserta una imagen.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
			</tr>

			<tr>
				<td></td>
			<td>
	           <div id="imagePreview"></div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		(function(){
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




			function filePreview(input){
				if(input.files && input.files[0]){
					var reader =new FileReader(); //clase que lee el archivo para mostrarla

					reader.onload=function(e){
						$('#imagePreview').html("<center><img src='"+e.target.result+"' style=width:200px; height:200;/></center>");
					}
					reader.readAsDataURL(input.files[0]);
				}
			}

			$('#validationCustom09').change(function(){
				filePreview(this);
			});

		})();
	</script>
	@stop
</body>
</html>

