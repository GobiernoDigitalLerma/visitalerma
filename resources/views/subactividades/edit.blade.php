@extends('Sistema.admin')
@section('contenido')
<center><h1 style="font-family: 'Bree serif'">MODIFICACIÓN DE SUB-ACTIVIDADES</h1></center>
	<form class="needs-validation" novalidate enctype="multipart/form-data"  method="POST" action="{{ route('updateSubactividad',$sub->id_sub_actividad) }}" enctype="multipart/form-data">
		
		{{ csrf_field() }}

		@method('PUT')
		<center>
		<div style="align-content:center; ">
			<table class="table" style="width: 50%;">
				<tr>
					<td style="text-align: right;">Nombre:</td>
					<td>
						<div>
						<input required id="validationCustom02" placeholder="Nombre" class="form-control" type="text" name="nombre" value="{{ $sub->nombre }}">
					<div class="invalid-feedback">
                                 Por favor ingresar un nombre de sub-actividades válido.
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
						<input required class="form-control" id="validationCustom03" type="date" name="fecha" value="{{ $sub->fecha }}">
										<div class="invalid-feedback">
                                 Por favor ingresar una fecha.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
					</td>
				</tr>
				<tr>
					<td style="text-align: right;">Horario:</td>

					<td><div>
						<textarea name="horario" required class="form-control" id="validationCustom05" style="resize: none;">{{ $sub->horario }}</textarea>
											<div class="invalid-feedback">
                                 Por favor ingresar un horario.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
			</tr>
			<tr>
					<td style="text-align: right;">Descripci&oacute;n:</td>

					<td><div>
						<textarea name="descripcion" required class="form-control" id="validationCustom05" style="resize: none;">{{ $sub->descripcion }}</textarea>
											<div class="invalid-feedback">
                                 Por favor ingresar una horario.
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
                <input  class="form-control" id="validationCustom05" placeholder="Link" name="link" value="{{ $sub->link }}">
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
					<td style="text-align: right;">Costo:</td>

					<td><div>
						<input name="costo"  pattern="^[0-9]\d*(\.\d+)?$" class="form-control" id="validationCustom05" value="{{ $sub->costo }}">
											<div class="invalid-feedback">
                                 Por favor ingresar un costo.
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
						<select required id="SearchSelect" class="form-control" name="ida">
							<option disabled="" value="">--Seleccionar actividad--</option>
							@foreach($actividades as $i)
								<option value="{{ $i->id_actividad }}" @if( $i->id_actividad === $sub->id_actividad )selected='selected' @endif>{{ $i->nombre }}</option>
							@endforeach
						</select>
											<div class="invalid-feedback">
                                 Por favor seleccionar una actividad.
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
							<select class="form-control" id="SearchSelect2" name="location" required="">
							<option disabled="" value="">--Seleccionar ubicación--</option>
							@foreach($locations as $i)
								<option value="{{ $i->id_ubicacion_actividad }}" @if( $i->id_ubicacion_actividad === $sub->id_ubicacion_actividad )selected='selected' @endif>{{ $i->nombre }}</option>
							@endforeach
						</select>
					<div class="invalid-feedback">
                                 Por favor seleccionar una ubicación.
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
						<select required class="form-control" id="SearchSelect3" name="idta">
							<option disabled="" value="">--Seleccionar tipo de actividad--</option>
							@foreach($tipos as $i)
								<option value="{{ $i->id_tipo_actividad }}" @if( $i->id_tipo_actividad === $sub->id_tipo_actividad )selected='selected' @endif>{{ $i->nombre }}</option>
							@endforeach
						</select>
											<div class="invalid-feedback">
                                 Por favor seleccionar un tipo de actividad.
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