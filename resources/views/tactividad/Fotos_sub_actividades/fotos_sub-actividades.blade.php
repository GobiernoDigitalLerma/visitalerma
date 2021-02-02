@extends('Sistema.admin')
@section('contenido')

<center>
<h1 style="font-family: 'Bree Serif',serif;">FOTOS DE SUB-ACTIVIDADES</h1></center>
	<form action="{{route('guardar_foto_sub_act')}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
		{{csrf_field()}}
		<center>
		<div style="align-content: center;">
		<table class="table" style="width: 50%;">
			
			<tr>
				<td style="text-align: right;">Sub-actividad:<br></td>
				<td><div>
					<select  id="SearchSelect"  class="form-control" name="id_sub_actividad" required>
					<option selected="" disabled="" value="">--Seleccionar sub-actividad--</option>
	    @foreach($id_foto_actividad as $car)
	    <option value="{{$car->id_sub_actividad}}">{{$car->nombre}}</option>
	    @endforeach 
       	</select>
       	 <div class="invalid-feedback">
                                 Por favor seleccionar una sub-actividad.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
			</tr>
			<tr>
				<td style="text-align: right;">Comentario:<br></td>
				<td>
					<div>
					<textarea placeholder="Comentario" class="form-control" name="detalle"   id="validationCustom02" required></textarea><div class="invalid-feedback">
                                 Por favor ingresar un comentario válido.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
			</tr>
			<tr>
				<td style="text-align: right;">Agregue link del video:<br></td>
				<td><div>
					<input placeholder="Link" class="form-control" type = 'text' name= 'video'>
					<div class="valid-feedback">
                                 Agrega link siempre y cuando  requiera.
                      </div>
                  </div>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;">Imagen:
				</td>
				<td>
					<div>
					<input class="form-control-file" type = 'file' name= 'foto' id="validationCustom03"required> 
				<div class="invalid-feedback">
                               Por favor insertar una imagen.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
			</tr>
			<tr>
				<td style="text-align: right;">Tipo de Imagen:
				</td>
				<td>
					<div>
					<input type = 'radio' name= 'tipo_foto' id="validationCustom03" checked="checked" value="1">Principal
					<span style="visibility: hidden;">Espacio </span><input type = 'radio' name= 'tipo_foto' id="validationCustom03" value="2">Secundaria
				<div class="invalid-feedback">
                               Por favor insertar una imagen.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                       </td>
			</tr>
			<tr>
				<td style="text-align: right;">Imagen Extendida:
				</td>
				<td>
					<div>
					<input type = 'radio' name= 'extendida' id="validationCustom03" checked="checked" value="1">Si
					<span style="visibility: hidden;">Espacio </span><input type = 'radio' name= 'extendida' id="validationCustom03" value="2">No
				<div class="invalid-feedback">
                               Por favor insertar una imagen.
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

<!---------------------------  LA VISTA PREVIA DE LA IMAGEN ------------------------------------------------------------------>
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

			$('#validationCustom03').change(function(){
				filePreview(this);
			});

		})();
	</script>
<!---------------------------------------------------------------------------------------------------------------------------->
@stop