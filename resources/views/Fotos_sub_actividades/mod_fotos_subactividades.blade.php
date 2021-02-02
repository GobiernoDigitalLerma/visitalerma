@extends('Sistema.admin')
@section('contenido')

<center>
	<h1 style="font-family: 'Bree Serif',serif;">MODIFICACIÓN FOTOS DE SUB-ACTIVIDADES</h1>
</center>
	<form class="needs-validation" novalidate enctype="multipart/form-data"  action="{{route('guarda_fotos_sub_actividad')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}

		
<center>
<div style="align-content: center;">
		<table class="table" style="width: 50%;">
        <tr>
				<td style="text-align: right;">Tipo de Imagen:
				</td>
				@if($fot->tipo_foto==1)
				<td>
					<div>
						<input type = 'radio' name= 'tipo_foto' id="si" checked="checked" value="1">Principal
					<span style="visibility: hidden;">Espacio </span><input type = 'radio' name= 'tipo_foto' id="no" value="2">Secundaria
					<div class="invalid-feedback">
                               Por favor insertar una imagen.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                </td>
                @else
                <td>
					<div>
						<input type = 'radio' name= 'tipo_foto' id="si" value="1">Principal
					<span style="visibility: hidden;">Espacio </span><input type = 'radio' name= 'tipo_foto' id="no" value="2"  checked="checked">Secundaria
					<div class="invalid-feedback">
                               Por favor insertar una imagen.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                </td>
                @endif
			</tr>
			<tr>
				<td style="text-align: right;">Imagen Extendida:
				</td>
				@if($fot->extendida==1)
				<td>
					<div>
					<input type = 'radio' name= 'extendida' id="ex1" checked="checked" value="1">Si
					<span style="visibility: hidden;">Espacio </span><input type = 'radio' name= 'extendida' id="ex2" value="2">No
					<div class="invalid-feedback">
                               Por favor insertar una imagen.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                </td>
                @else
                <td>
					<div>
					<input type = 'radio' name= 'extendida' id="ex1" value="1">Si
					<span style="visibility: hidden;">Espacio </span><input type = 'radio' name= 'extendida' id="ex2" value="2"  checked="checked">No
					<div class="invalid-feedback">
                               Por favor insertar una imagen.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div>
                       </div>
                </td>
                @endif
			</tr>
		<tr>
				<td style="text-align: right;">No fotos sub-actividad:<br></td>
				<td>
				<input class="form-control" type = 'text' name= 'id_foto_sub_actividad' value="{{$fot->id_foto_sub_actividad}}" readonly="readonly"></td>
			</tr>
<tr>
			<td style="text-align: right;">Selecciona una actividad:<br></td>
				<td>
					<div><select  class="form-control" name = 'id_sub_actividad' id="SearchSelect" required>
						<option disabled="" value="">--Seleccionar actividad--</option>
	    @foreach($id_actividad as $car)
	    <option value="{{ $car->id_sub_actividad }}" @if( $car->id_sub_actividad === $fot->id_sub_actividad )selected='selected' @endif>{{ $car->nombre }}</option>
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
				<td style="text-align: right;">Comentario:<br></td>
				<td>
					<div><textarea   class="form-control" name="detalle" id="validationCustom02" required>{{$fot->detalle}}</textarea><div class="invalid-feedback">
                                 Por favor ingresa un comentario válido.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
			</tr>
			<tr>
				<td style="text-align: right;">Agregue link del video:<br></td>
				<td>
					<div><input class="form-control" type = 'text' name= 'video' value="{{$fot->video}}" onchange="return youtube()" id="video"><div class="valid-feedback">
                                 Agrega link siempre y cuando lo requiera.
                      </div>
                  </div>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;">Imagen:<br></td>
				<td>
						<input class="form-control-file" type = 'file' name= 'foto' value="{{$fot->foto}}" id="foto" onchange="return fileValidation()">
				</td>
			</tr>
					<tr>
				<td></td>
			
	       </tr>
			<tr>
				<td colspan="2">
					<center>
	           		<div id="imagePreview"><img  src="{{ URL::to('/foto_actividades') }}/{{ $fot->foto }}"  width="150" height="150"></div></center>
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

			$('#foto').change(function(){
				filePreview(this);
			});

		})();


		function fileValidation(){
    var fileInput = document.getElementById('foto');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Por favor selecciona una imagen valida');
        fileInput.value = '';
        return false;
    }
}

function youtube(){
    var fileInput = document.getElementById('video');
    var string = fileInput.value;
    
    substring = "www.youtube.com";
    sub="youtu.be";


if(string.indexOf(substring) !== -1){
} else {
  if(string.indexOf(sub) !== -1){
} else {
  alert('Por favor inserta un link de youtube si es nesesario');
        fileInput.value = '';
        return false;
}
}
}


$(document).ready(function(){  
  
    $("#no").click(function() {  
        if($("#no").is(':checked')) {  
            document.querySelector('#ex1').disabled = true;
            document.querySelector('#ex2').checked = true;  
        } else {  
              document.querySelector('#ex2').disabled = true;
            document.querySelector('#ex1').checked = true;
        }  
    });  
  
}); 

$(document).ready(function(){  
  
    $("#si").click(function() {  
        if($("#no").is(':checked')) {  
            document.querySelector('#ex1').disabled = true;
            document.querySelector('.Link').disabled = true;
            document.querySelector('#ex2').checked = true;  
        } else {  
              document.querySelector('#ex2').disabled = true;
            document.querySelector('#ex1').checked = true;
        }  
    });  
  
});
	</script>
<!---------------------------------------------------------------------------------------------------------------------------->

@stop