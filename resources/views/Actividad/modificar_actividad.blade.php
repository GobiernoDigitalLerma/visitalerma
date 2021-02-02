@extends('Sistema.admin')
@section('contenido')
<center>
	<h1 style="font-family: 'Bree Serif',serif;">MODIFICAR ACTIVIDAD</h1>
</center>
	<form class="needs-validation" novalidate enctype="multipart/form-data"  method="POST" action="{{ URL('guardar_modificacion_actividad') }}">
		{{ csrf_field() }}
		<center>
		<div style="align-content: center;">
		<table class="table" style="width: 50%;">
			<tr>
				<td style="text-align: right;">No Actividad:</td>
				<td><input type="text" name="ida" class="form-control" value="{{ $a->id_actividad }}" readonly="readonly"></td>
			</tr>
			<tr>
				<td style="text-align: right;">Nombre actividad:</td>
				<div>
				<td><input type="text" name="nombre" id="validationCustom01" class="form-control" pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{5,40}" required value="{{ $a->nombre }}">
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
				
				<td><textarea name="descripcion" class="form-control" style="width: all;" id="validationCustom02" required>{{ $a->descripcion }}</textarea>
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
				<td><textarea name="artista" class="form-control" style="width: all;" id="validationCustom03" required>{{ $a->artista }}</textarea>
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
				<td><input type="date" name="fechaini" class="form-control" value="{{ $a->fecha_inicio}}" id="validationCustom04" required>
				<div class="invalid-feedback">
                Por favor ingresar una fecha de inicio válida.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              </div>
				</td>
			</tr>
			<tr id="f2" style="display: none">
				<td style="text-align: right;">Fecha de termino:</td>
				<div>
				<td><input type="date" name="fechafin" class="form-control" value="{{ $a->fecha_fin_actividad }}" id="validationCustom05" required>
				<div class="invalid-feedback">
                Por favor ingresar una fecha de termino válida.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              </div>
				</td>
			</tr>
			<tr>
				<td style="text-align: right;">Horario:</td>
				<td><textarea name="horario" class="form-control" style="width: all;" id="validationCustom06" required>{{ $a->horario_detalle }}</textarea>
				<div class="invalid-feedback">
                Por favor ingresar un horario válida.
                                         </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
              </div>
				</td>
			</tr>
			<tr>
			<td style="text-align: right;">Tipo de actividad:</td>
			<div>
				<td><select name="tipo" class="form-control" required="required" id="SearchSelect">
					<option disabled="" value="">--Seleccionar una actividad--</option>
			@foreach($tipo as $t)
				<option value="{{ $t->id_tipo_actividad }}" @if( $t->id_tipo_actividad === $a->id_tipo_actividad )selected='selected' @endif>{{ $t->nombre }}</option>
			@endforeach
		</select>
	<div class="invalid-feedback">
                                 Por favor seleccionar un tipo actividad.
                                       </div>
                                       <div class="valid-feedback">
                                        Campo listo!
                      </div>
                      </div>
    								 </td>
	     </tr>
			<tr>
				<tr>
				<td style="text-align: right;">Ubicación:</td>
				<td>
        <div>
          <select name="ubi" class="form-control" id="SearchSelect2" required>
            <option selected="" disabled="" value="">--Seleccionar Ubicación--</option>
			@foreach($u as $t)
				<option value="{{ $t->id_ubicacion_actividad }}" @if( $t->id_ubicacion_actividad === $a->idu )selected='selected' @endif>{{ $t->nombre }}</option>
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
        <td style="text-align: right;">Seccion de la Pagina Web:</td>
        <td>
        <div>
          <select name="secciones" class="form-control seccion" id="SearchSelect2" required>
          	<option value="1" {{ ($a->secciones == 1) ? 'selected' : '' }}>¿Qué hacer?</option>
            <option value="2" {{ ($a->secciones == 2) ? 'selected' : '' }}>¿Qué sucede ahora?</option>
            <option value="3" {{ ($a->secciones == 3) ? 'selected' : '' }}>Pueblo con encanto</option>
            <option value="4" {{ ($a->secciones == 4) ? 'selected' : '' }}>Festivales y Cultura</option>
            <option value="5" {{ ($a->secciones == 5) ? 'selected' : '' }}>Artesanías</option>
            <option value="6" {{ ($a->secciones == 6) ? 'selected' : '' }}>Servicios</option>
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
        <td style="text-align: right;">Region:</td>
        <td>
        <div>
          <select name="region" class="form-control" id="SearchSelect2" required>
            <option value="1" {{ ($a->region == 1) ? 'selected' : '' }}>Región I Huitzizilapan</option>
            <option value="2" {{ ($a->region == 2) ? 'selected' : '' }}>Región II Tlalmimilolpan</option>
            <option value="3" {{ ($a->region == 3) ? 'selected' : '' }}>Región  III Atarasquillo</option>
            <option value="4" {{ ($a->region == 4) ? 'selected' : '' }}>Región IV Ameyalco</option>
            <option value="5" {{ ($a->region == 5) ? 'selected' : '' }}>Región V Lerma</option>
            <option value="6" {{ ($a->region == 6) ? 'selected' : '' }}>Región VI Tultepec</option>
            <option value="7" {{ ($a->region == 7) ? 'selected' : '' }}>Región VIIPeralta - Xochicuahutla - Analco</option>
            <option value="8" {{ ($a->region == 8) ? 'selected' : '' }}>Región VIII Partidas - Parque Industrial</option>
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

      @if ($a->imagenes != null)

        @php
          $array = json_decode($a->imagenes);

            function validate($valor,$arreglo){

              $resultado = null;

              foreach ($arreglo as $value) {

                if($value->position == $valor){

                  $resultado = $value;

                }

              }

              return $resultado;

            }

          $A = validate("A",$array);

          $B = validate("B",$array);

          $C = validate("C",$array);

          $D = validate("D",$array);

          $E = validate("E",$array);

        @endphp

        <tr id="imgA">
        <td style="text-align: right;">Imagen 1</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloA" value="{{ ($A != null ? $A->title : '') }}"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleA">{{ ($A != null ? $A->description : '') }}</textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameA" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
          <input type="text" name="originalNameA" hidden="true" value="{{ ($A->file != null ? $A->file : '') }}">
          @if ($A->file != null)
            <img src="{{ asset('foto_actividades').'/'.$A->file }}" height="100px" width="200px" class="mt-1" id="img1">
          @endif
          <br>
          <div align="right">
            <input type="button" value="Limpiar valores de imagen 1" class="btn btn-sm btn-warning mt-1" id="clean1">
          </div>
        </td>
        </td>
      </tr>
      <tr id="element-B">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Mostrar detalle de la imagen siguiente" id="add-element-B">
        </td>
      </tr>
      <tr id="imgB" hidden="true">
        <td style="text-align: right;">Imágen 2</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloB" value="{{ ($B != null ? $B->title : '') }}"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleB">{{ ($B != null ? $B->description : '') }}</textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameB" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
          <input type="text" name="originalNameB" hidden="true" value="{{ ($B->file != null ? $B->file : '') }}">
          @if ($B->file != null)
            <img src="{{ asset('foto_actividades').'/'.$B->file }}" height="100px" width="200px" class="mt-1" id="img2">
          @endif
          <br>
          <div align="right">
            <input type="button" value="Limpiar valores de imagen 2" class="btn btn-sm btn-warning mt-1" id="clean2">
          </div>
        </td>
        </td>
      </tr>
      <tr id="element-C" hidden="true">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Mostrar detalle de la siguiente imagen" id="add-element-C">
        </td>
      </tr>
      <tr id="imgC" hidden="true">
        <td style="text-align: right;">Imágen 3</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloC" value="{{ ($C != null ? $C->title : '') }}"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleC">{{ ($C != null ? $C->description : '') }}</textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameC" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
          <input type="text" name="originalNameC" hidden="true" value="{{ ($C->file != null ? $C->file : '') }}">
          @if ($C->file != null)
            <img src="{{ asset('foto_actividades').'/'.$C->file }}" height="100px" width="200px" class="mt-1" id="img3">
          @endif
          <br>
          <div align="right">
            <input type="button" value="Limpiar valores de imagen 3" class="btn btn-sm btn-warning mt-1" id="clean3">
          </div>
        </td>
      </tr>
      <tr id="element-D" hidden="true">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Mostrar detalle de la imagen siguiente" id="add-element-D">
        </td>
      </tr>
      <tr id="imgD" hidden="true">
        <td style="text-align: right;">Imágen 4</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloD" value="{{ ($D != null ? $D->title : '') }}"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleD">{{ ($D != null ? $D->description : '') }}</textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameD" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
          <input type="text" name="originalNameD" hidden="true" value="{{ ($D->file != null ? $D->file : '') }}">
          @if ($D->file != null)
            <img src="{{ asset('foto_actividades').'/'.$D->file }}" height="100px" width="200px" class="mt-1" id="img4">
          @endif
          <br>
          <div align="right">
            <input type="button" value="Limpiar valores de imagen 4" class="btn btn-sm btn-warning mt-1" id="clean4">
          </div>
        </td>
      </tr>
      <tr id="element-E" hidden="true">
        <td></td>
        <td>
          <input type="button" class="btn btn-info btn-sm" value="Mostrar detalle de la imagen siguiente" id="add-element-E">
        </td>
      </tr>
      <tr id="imgE" hidden="true">
        <td style="text-align: right;">Imágen 5</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloE" value="{{ ($E != null ? $E->title : '') }}"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleE">{{ ($E != null ? $E->description : '') }}</textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameE" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
          <input type="text" name="originalNameE" hidden="true" value="{{ ($E->file != null ? $E->file : '') }}">
          @if ($E->file != null)
            <img src="{{ asset('foto_actividades').'/'.$E->file }}" height="100px" width="200px" class="mt-1" id="img5">
          @endif
          <br>
          <div align="right">
            <input type="button" value="Limpiar valores de imagen 5" class="btn btn-sm btn-warning mt-1" id="clean5">
          </div>
        </td>
      </tr>
 
      @endif

      @if ($a->imagenes == null)

        <tr id="imgA" {{ ($a->secciones == 3 || $a->secciones == 1) ? '' : 'hidden="true"' }}>
        <td style="text-align: right;">Imagen 1</td>
        <td>
          <label>Título de imagen</label>
          <input type="text" class="form-control" name="tituloA"><br>
          <label>Descripción</label>
          <textarea class="form-control" style="width: all;" name="detalleA"></textarea><br>
          <input type="file" class="form-control-file validate-file" name="filenameA" accept="image/png, image/jpeg, image/jpg" data-max-size="1024">
          <input type="text" name="originalNameA" hidden="true">
        </td>
      </tr>
      <tr id="element-B" {{ ($a->secciones == 3 || $a->secciones == 1) ? '' : 'hidden="true"' }}>
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
          <input type="text" name="originalNameB" hidden="true">
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
          <input type="text" name="originalNameC" hidden="true">
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
          <input type="text" name="originalNameD" hidden="true">
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
          <input type="text" name="originalNameE" hidden="true">
        </td>
      </tr>
 
      @endif

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

    @if ($a->imagenes == null)

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

    @endif

    @if ($a->imagenes != null)

      $(".seccion").on('change',function(){

        if($(this).val() != 3 && $(this).val() != 1){

          $("#imgA").attr('hidden',true);
          $("#imgB").attr('hidden',true);
          $("#imgC").attr('hidden',true);
          $("#imgD").attr('hidden',true);
          $("#imgE").attr('hidden',true);
          $("#imgF").attr('hidden',true);
          $("#element-B").attr('hidden',true);

        }else{

          $("#imgA").removeAttr('hidden');
          $("#element-B").removeAttr('hidden');
          
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

        $("#clean1").on('click', function() {

          $("#img1").remove();
          $("input[name='tituloA']").val("");
          $("input[name='originalNameA']").val("");
          $("textarea[name='detalleA']").val("");
          $("input[name='filenameA']").val("");

        });

        $("#clean2").on('click', function() {

          $("#img2").remove();
          $("input[name='tituloB']").val("");
          $("input[name='originalNameB']").val("");
          $("textarea[name='detalleB']").val("");
          $("input[name='filenameB']").val("");
          
        });

        $("#clean3").on('click', function() {

          $("#img3").remove();
          $("input[name='tituloC']").val("");
          $("input[name='originalNameC']").val("");
          $("textarea[name='detalleC']").val("");
          $("input[name='filenameC']").val("");
          
        });

        $("#clean4").on('click', function() {

          $("#img4").remove();
          $("input[name='tituloD']").val("");
          $("input[name='originalNameD']").val("");
          $("textarea[name='detalleD']").val("");
          $("input[name='filenameD']").val("");
          
        });

        $("#clean5").on('click', function() {

          $("#img5").remove();
          $("input[name='tituloE']").val("");
          $("input[name='originalNameE']").val("");
          $("textarea[name='detalleE']").val("");
          $("input[name='filenameE']").val("");
          
        });

    @endif

} );
</script>
@stop