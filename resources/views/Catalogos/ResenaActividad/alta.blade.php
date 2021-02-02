@extends('Sistema.admin')
	@section('contenido')
	<center>
			<h1 style="font-family:bree serif,serif;">RESEÑA DE ACTIVIDAD</h1>
	</center>
	<form class="needs-validation" novalidate enctype="multipart/form-data" action="{{route('guardaresena')}}" method="post">
		@csrf
		<center>
		<div style="align-content: center;">
		<table class="table" style="width: 50%;">
		<tr>

			<td style="text-align: right;">Nombre:</td>
			<td>
			<div>
				<input type="text" name="nombre" class="form-control " id="validationCustom01"  required placeholder="Nombre">
            <div class="invalid-feedback">
            Por favor ingresa un nombre de reseña válido.
            </div>
            <div class="valid-feedback">
            Campo listo!
            </div>
            </div>
            </td>
		</tr>

		<tr>
			<td style="text-align: right;">Reseña:</td>
			<td>
			<div>
			<textarea name="detalle" class="form-control " style="width: all;" id="validationCustom02" required placeholder="Reseña"></textarea>
            <div class="invalid-feedback">
            Por favor ingresa una reseña.
            </div>
            <div class="valid-feedback">
            Campo listo!
            </div>
            </div>
            </td>
		</tr>
		   <tr>
			<td style="text-align: right;">Actividad:</td>
			<td>
			<div>
				<select name="id_actividad" class="form-control" id="SearchSelect" required>
					<option selected="" disabled="" value="">--Seleccionar actividad--</option>
					 @foreach($date as $act)
					 <option value="{{$act->id_actividad}}">{{$act->nombre}}</option>
						 @endforeach 
				</select>
			<div class="invalid-feedback">
            Por favor selecciona una actividad.
            </div>
            <div class="valid-feedback">
            Campo listo!
            </div>
            </div>
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
                         // Example starter JavaScript for disabling form submissions if there are invalid fields
       (function() {
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
	@endsection 