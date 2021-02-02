@extends('Sistema.admin')
@section('contenido')
<center>
	<h1 style="font-family: 'Bree Serif',serif;">NUEVA ACTIVIDAD</h1>
</center>
	<form class="needs-validation" novalidate enctype="multipart/form-data"  method="POST" action="{{ URL('guardar_actividad') }}">
		{{ csrf_field() }}
		<center>
		<div style="align-content: center;">
		<table class="table" style="width: 50%;">
			<tr>
				<td style="text-align: right;">Nombre actividad:</td>
				<div>
				<td><input type="text" name="nombre" id="validationCustom01" class="form-control" pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{5,40}" required>
					<div class="invalid-feedback" >
                Por favor ingresar un nombre de actividad válido.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              </div>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;">Descripción:</td>
				<div>
				
				<td><textarea name="descripcion" class="form-control" style="width: all;" id="validationCustom02" required></textarea>
			   <div class="invalid-feedback">
                Por favor ingresar una descripción válida.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              </div>	
				</td>
			</tr>
			<tr>
				<td style="text-align: right;">Artista:</td>
				<div>
				<td><textarea name="artista" class="form-control" style="width: all;" id="validationCustom03" required></textarea>
				<div class="invalid-feedback">
                Por favor ingresar un artista válido.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              </div>					
				</td>
      </tr>
      <tr>
        <td style="text-align: right">Su actividad es:</td>
        <td>
          <input type="radio" name="evento" id="turistico" checked><label for="turismo">Atractivo Turistico</label>
          <input type="radio" name="evento" id="evento"><label for="evento">Evento</label>
        </td>
      </tr>
			<tr id="f1" style="display: none">
				<td style="text-align: right;">Fecha de inicio:</td>
				<div>
        <td><input type="date" name="fechaini" class="form-control"  id="validationCustom04" required value="{{date('Y-m-d')}}">
				<div class="invalid-feedback">
                Por favor ingresar una fecha de inicio válida.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              </div>
				</td>
			</tr>
			<tr id="f2"  style="display: none">
				<td style="text-align: right;">Fecha de termino:</td>
				<div>
				<td><input type="date" name="fechafin" class="form-control"  id="validationCustom05" required value="{{date('Y-m-d')}}">
				<div class="invalid-feedback">
                Por favor ingresar una fecha de termino válida.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              
				</td>
        
			</tr>
			<tr>
				<td style="text-align: right;">Horario:</td>
				<td><textarea name="horario" class="form-control" style="width: all;" id="validationCustom06" required></textarea>
				<div class="invalid-feedback">
                Por favor ingresar un horario válida.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
				</td>
			</tr>

      <tr>
				<td style="text-align: right;">Tipo de Actividad:</td>
				<td>
        <div>
          <select name="tipo" class="form-control" id="SearchSelect2" required>
            <option selected="" disabled="" value="">--Seleccionar un Tipo de Actividad--</option>
			@foreach($tipo as $t)
				<option value="{{ $t->id_tipo_actividad }}" >{{ $t->nombre }}</option>
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
				<td style="text-align: right;">Ubicación:</td>
				<td>
        <div>
          <select name="ubi" class="form-control" id="SearchSelect2" required>
            <option selected="" disabled="" value="">--Seleccionar Ubicación--</option>
			@foreach($u as $t)
				<option value="{{ $t->id_ubicacion_actividad }}" >{{ $t->nombre }}</option>
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
        <td style="text-align: right;">Sección de la Pagina Web:</td>
        <td>
        <div>
          <select name="secciones" class="form-control seccion" id="SearchSelect2" required>
            <option selected="" disabled="" value="">--Seleccionar Sección de la Pagina Web--</option>
      <option value="1">¿Qué hacer?</option>
        <option value="2">¿Qué sucede ahora?</option>
        <option value="3">Pueblo con encanto</option>
        <option value="4">Festivales y Cultura</option>
        <option value="5">Artesanías</option>
        <option value="6">Servicios</option>
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
        <td style="text-align: right;">Región:</td>
        <td>
        <div>
          <select name="region" class="form-control" id="SearchSelect2" required>
            <option selected="" disabled="" value="">--Seleccionar Región--</option>
      		<option value="1">Región I Huitzizilapan</option>
            <option value="2">Región II Tlalmimilolpan</option>
            <option value="3">Región  III Atarasquillo</option>
            <option value="4">Región IV Ameyalco</option>
            <option value="5">Región V Lerma</option>
            <option value="6">Región VI Tultepec</option>
            <option value="7">Región VIIPeralta - Xochicuahutla - Analco</option>
            <option value="8">Región VIII Partidas - Parque Industrial</option>
    </select> 
    <div class="invalid-feedback">
                                 Por favor seleccionar una region.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div>
                      </div>
                      </td>
      </tr>
      <tr id="imgA" hidden="true">
      	<td style="text-align: right;">Imagen 1</td>
      	<td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloA"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleA"></textarea><br>
      		<input type="file" class="form-control-file validate-file" name="filenameA" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
      </tr>
      <tr id="element-B" hidden="true">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Añadir imagen" id="add-element-B">
        </td>
      </tr>
      <tr id="imgB" hidden="true">
        <td style="text-align: right;">Imágen 2</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloB"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleB"></textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameB" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
        </td>
      </tr>
      <tr id="element-C" hidden="true">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Añadir imagen" id="add-element-C">
        </td>
      </tr>
      <tr id="imgC" hidden="true">
        <td style="text-align: right;">Imágen 3</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloC"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleC"></textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameC" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
        </td>
      </tr>
      <tr id="element-D" hidden="true">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Añadir imagen" id="add-element-D" data-max-size="1024">
        </td>
      </tr>
      <tr id="imgD" hidden="true">
        <td style="text-align: right;">Imágen 4</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloD"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleD"></textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameD" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
        </td>
      </tr>
      <tr id="element-E" hidden="true">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Añadir imagen" id="add-element-E" data-max-size="1024">
        </td>
      </tr>
      <tr id="imgE" hidden="true">
        <td style="text-align: right;">Imágen 5</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloE"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleE"></textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameE" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
        </td>
      </tr>
      <tr>
        <td align="right" colspan="2">
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
<script>
  $(document).ready(function() {

    $('#evento').click(function() {
      $('#f1').show();
      $('#f2').show();   
    });

    $('#turistico').click(function() {
      $('#f1').hide();
      $('#f2').hide();   
    });

    $(".seccion").on('change',function(){

    	if($(this).val() == "1" || $(this).val() == "3" ){

    		$("#imgA").removeAttr('hidden');
        $("#element-B").removeAttr('hidden');

    	}else{

    		$("#imgA").attr('hidden',true);
        $("#imgB").attr('hidden',true);
        $("#imgC").attr('hidden',true);
        $("#imgD").attr('hidden',true);
        $("#imgE").attr('hidden',true);
        $("#imgF").attr('hidden',true);
        $("#element-B").attr('hidden',true);
        $("#element-C").attr('hidden',true);
        $("#element-D").attr('hidden',true);
        $("#element-E").attr('hidden',true);
        $("#element-F").attr('hidden',true);
        $("#tituloA").val("");
        $("#detalleA").val("");
        $("#filenameA").val("");
        $("#tituloB").val("");
        $("#detalleB").val("");
        $("#filenameB").val("");
        $("#tituloC").val("");
        $("#detalleC").val("");
        $("#filenameC").val("");
        $("#tituloD").val("");
        $("#detalleD").val("");
        $("#filenameD").val("");
        $("#tituloE").val("");
        $("#detalleE").val("");
        $("#filenameE").val("");

    	}

    });

    $("#add-element-B").on("click",function(){

      $("#element-B").attr('hidden',true);
      $("#imgB").removeAttr('hidden');
      $("#element-C").removeAttr('hidden');

    });

    $("#add-element-C").on("click",function(){

      $("#element-C").attr('hidden',true);
      $("#imgC").removeAttr('hidden');
      $("#element-D").removeAttr('hidden');
      
    });

    $("#add-element-D").on("click",function(){

      $("#element-D").attr('hidden',true);
      $("#imgD").removeAttr('hidden');
      $("#element-E").removeAttr('hidden');
      
    });

    $("#add-element-E").on("click",function(){

      $("#element-E").attr('hidden',true);
      $("#imgE").removeAttr('hidden');
      
    });

    $(".validate-file").on('change',function(){

        var archivo = $(this).val();
        
        var extension = archivo.substring(archivo.lastIndexOf("."));

        var size = this.files[0].size;

        if(size > 1000000){

          alert('La imagen no debe superar 1MB');

          $(this).val("");

        }else{

          if(extension != ".png" && extension != ".jpg" && extension != ".jpeg"){

            alert("Solo se admiten imágenes con extensión: png, jpg, jpeg");

            $(this).val("");

          }

        }

    });
    
} );
</script>

@stop