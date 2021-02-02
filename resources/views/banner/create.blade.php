@extends('Sistema.admin')
@section('contenido')

<CENTER><h1 style="font-family: 'Bree Serif',serif;">BANNER</h1></CENTER>
<form id="form" class="needs-validation" novalidate enctype="multipart/form-data" method="post" action="{{ route('Guardarbaner') }}">
	@csrf
    <center>
        <div style="align-content:center; ">
            <table class="table" style="width: 50%;">
                      
                       <tr>
                       <td style="text-align: right;">    
                               Nombre del Banner:
                       </td>       
                       <td>
                       <div>
                       <input type="text" class="form-control" name="nombre" id="validationCustom01" value="{{old('nombre')}}">
                       @if($errors->first('nombre'))
                                <p style="color: red;">Por favor ingresar un nombre de banner válido</p>
                       @endif
                       {{-- <div class="invalid-feedback">
                               Por favor ingresar un nombre de banner válido.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div> --}}
                       </div>
                       <td>
                       </tr>

                       <tr>
                       <td style="text-align: right;">  
                               Fecha inicio:
                       </td>
                       <td>
                       <div>
                       <input type="date" class="form-control" id="validationCustom02" name="fecha_inicio" value="{{old('fecha_inicio')}}">
                       @if($errors->first('fecha_inicio'))
                              <p style="color:red;">Por favor ingresa una fecha valida</p>
                       @endif
                       
                       {{-- <div class="invalid-feedback">
                       </div> --}}
                       {{-- <div class="valid-feedback">
                               Campo listo!
                       </div> --}}
                       </div>
                       </td>
                       </tr>

                       <tr>
                       <td style="text-align: right;">  
                               Fecha final:
                       </td>
                       <td>
                       <div>
                       <input type="date" class="form-control"  id="validationCustom03"name="fecha_fin">
                       @if($errors->first('fecha_fin'))
                                <p style="color:red;">Por favor ingresa una fecha valida</p>
                       @endif
                       {{-- <div class="invalid-feedback">
                               Por favor ingresar una fecha final válida.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div> --}}
                       </div>
                       </td>
                       </tr>

               
                       <tr>
                       <td style="text-align: right;">      
                               Descripción:
                       </td>
                       <td>
                       <div> 
                       
                       <textarea type="text" class="form-control"  id="validationCustom04"name="descripcion"></textarea>
                       @if($errors->first('descripcion'))
                                <p style="color:red;">Por favor ingresa una descripción valida</p>
                       @endif
                       {{-- <div class="invalid-feedback">
                               Por favor ingresar una descripción válida.
                       </div>
                       <div class="valid-feedback">
                               Campo listo!
                       </div> --}}
                       </div>
                       </td>
                       </tr>
                       <tr>
                       <td style="text-align: right;">      
                            Imagen:
                       </td>
                       <td>    
                        <div>
                       <input type="file" class="form-control-file" id="file" name="ruta">
                       @if($errors->first('ruta'))
                                <p style="color:red;">Por favor selecciona una imagen</p>
                       @endif
                       
                       {{-- <div id="errores1" class="invalid-feedback">
                                 Por favor seleccionar una imagen válida.
                      </div>
                      <div id="errores2"  class="valid-feedback">
			 Campo listo!
                      </div> --}}
                      </div>
                       </td>
                       </tr>

                       <tr>
                       <td></td>
                       <td><div id="imagePreview"></div></td>
                       </tr>
                       <tr>
                       <td style="text-align: right;">      
                                Actividad:
                       </td>
                       <td>
                       <div>
                       <select name="id_actividad" class="form-control" id="SearchSelect">
                       <option value="">--Seleccionar una actividad--</option>
                        @foreach($date as $act)
                        <option value="{{$act->id_actividad}}">{{$act->nombre}}</option>
                        @endforeach 
                       </select>
                       @if($errors->first('id_actividad'))
                                <p style="color:red;">Por favor seleccionar una actividad</p>
                       @endif
                       {{-- <div class="invalid-feedback">
                                 Por favor seleccionar una actividad.
                      </div>
                      <div class="valid-feedback">
                                 Campo listo!
                      </div> --}}
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
    $('#file').change( function() {
  
  if(this.files[0].size > 1000000) {
      $(this).val('');
    $('#errores1').html("La imagen supera 1Megabyte de peso permitido.");
  } else { //ok
     var formato = (this.files[0].name).split('.').pop();
    //alert(formato);
      if(formato.toLowerCase() == 'jpg' || formato.toLowerCase() == 'png' || formato.toLowerCase() == 'gif') {
          $('#errores2').html("Campo listo!");
      } else {
        $(this).val('');
        $('#errores1').html("Formato no soportado");
      }
     }

});  
                         // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
                    /* 'use strict';
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
                              }, false);  */

                             function filePreview(input){
                                 if(input.files && input.files[0]){
                                  var reader =new FileReader(); //clase que lee el archivo para mostrarla

                                         reader.onload=function(e){
                                         $('#imagePreview').html("<center><img src='"+e.target.result+"' style=width:200px; height:200;/></center>");
                                            }
                                          reader.readAsDataURL(input.files[0]);
                                          }
                                          }
                                           $('#file').change(function()
                              {


                               filePreview(this);
                              });
                    })();
                           


    </script>
@endsection
