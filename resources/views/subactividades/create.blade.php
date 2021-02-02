@extends('Sistema.admin')
@section('contenido')
<center><h1 style="font-family: 'Bree serif'">SUB-ACTIVIDADES</h1></center>
	<form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" action="{{ route('newSubactividad') }}" enctype="multipart/form-data">

		{{ csrf_field() }}
		<center>
		<div class="table-responsive">
			<table class="table" style="width: 50%;">
        <tr>
          <td style="text-align: right;">Nombre:</td>
          <td>
            <div>
            <input required class="form-control" id="validationCustom02" placeholder="Nombre" class="form-control" type="text" name="nombre">
          <div class="invalid-feedback">
                                 Porfavor ingresar un nombre de sub-actividades válido.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
        </tr>
        <tr>
          <td style="text-align: right;">Fecha:</td>
          <td>
            <div>
            <input required class="form-control" id="validationCustom03" placeholder="Fecha" class="form-control" type="date" name="fecha">
          <div class="invalid-feedback">
                                 Porfavor ingresar una fecha.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
        </tr>

        <tr>
          <td style="text-align: right;">
            Horario:</td>
          <td>
            <div>
            <textarea required class="form-control" id="validationCustom05" placeholder="Horario" name="horario" class="form-control" rows="3" style="resize: none;"></textarea>
          <div class="invalid-feedback">
                                 Porfavor ingresar un horario.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
        </tr>
        <tr>
          <td style="text-align: right;">
            Descripci&oacute;n:</td>
          <td>
            <div>
            <textarea required class="form-control" id="validationCustom05" placeholder="Descripci&oacute;n" name="descripcion" class="form-control" rows="3" style="resize: none;"></textarea>
          <div class="invalid-feedback">
                                 Porfavor ingresar una descripci&oacute;n.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
        </tr>
        <tr>
          <td style="text-align: right;">
            Link(s):</td>
          <td>
            <div>
              <input  class="form-control" id="validationCustom05" placeholder="Link" name="link">
          <div class="invalid-feedback">
                                 Porfavor ingresar un link.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
        </tr>
	<tr>
          <td style="text-align: right;">
            Costo: </td>
          <td>
            <div>
            <input  class="form-control" id="validationCustom05" placeholder="Costo" name="costo">
          <div class="invalid-feedback">
                                 Porfavor ingresar un costo.
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
						<select class="form-control" id="SearchSelect" required class="form-control" name="ida">
							<option selected="" disabled="" value="">--Seleccionar actividad--</option>
							@foreach($actividades as $i)
								<option value="{{ $i->id_actividad }}">{{ $i->nombre }}</option>
							@endforeach
						</select>
					<div class="invalid-feedback">
                                 Porfavor seleccionar una actividad.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
				</tr>
        

        <tr>
          <td style="text-align: right;">Ubicación:</td>
          <td>
            <div>
            <select required class="form-control" id="SearchSelect2" class="form-control" name="location">
              <option selected="" disabled="" value="">--Seleccionar ubicacón--</option>
              @foreach($locations as $i)
                <option value="{{ $i->id_ubicacion_actividad }}">{{ $i->nombre }}</option>
              @endforeach
            </select>
          <div class="invalid-feedback">
                                 Porfavor seleccionar una ubicación.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
        </tr>
				<tr>
					<td style="text-align: right;">Tipo de atividad:</td>
					<td>
						<div>
						<select required class="form-control" id="SearchSelect3" class="form-control" name="idta">
							<option selected="" disabled="" value="">--Seleccionar tipo de actividad--</option>
							@foreach($tipos as $i)
								<option value="{{ $i->id_tipo_actividad }}">{{ $i->nombre }}</option>
							@endforeach
						</select>
					<div class="invalid-feedback">
                                 Porfavor seleccionar un tipo de actividad.
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
	$(document).ready(function(){
			$('input[name=costo]').keypress(function(tecla) {
		        if((tecla.charCode < 48 || tecla.charCode > 57) && tecla.charCode != 46) return false;
		    });
		})    </script>
				
@endsection