@extends('Sistema.admin')
@section('contenido')

                                <CENTER><h1 style="font-family: 'Bree Serif',serif;">MODIFICAR BANNER</h1></CENTER>
                                <form class="needs-validation" novalidate enctype="multipart/form-data" method="post" action="{{ route('updatbaner') }}" >
   								 @csrf
								 <center>
                                <div style="align-content:center; ">
                                        <table class="table" style="width: 50%;">
                                <tr>
                                <td style="text-align: right;">    
                                        No. Banner:
                                </td>
                                
                                <td>
                                         <input type="text" class="form-control" name="id_banner" value="{{ $data[0]->id_banner }}" readonly="readonly">
</td>
                                </tr>
                                <tr>
                                <td style="text-align: right;">    
                                        Nombre del banner:
                                </td>
                                
                                <td>
                                        <div>
                       <input type="text" class="form-control" placeholder="Nombre" id="validationCustom01" name="nombre" value="{{ $data[0]->nombre }}">
                       @if($errors->first('nombre'))
                                          <p style="color:red;">Por favor ingresar un nombre de banner válido.</p>
                       @endif
    									 {{-- <div class="invalid-feedback">
                                               Por favor ingresar un nombre de banner válido.
                                         </div>
                                         <div class="valid-feedback">
                                               Campo listo!
                                         </div> --}}
  										 </div>
                                </td>
                                </tr>
                                <tr>
                                <td style="text-align: right;">  
                                         Fecha inicio:
                                </td>
                                <td>
                                          <div>
                                          <input type="date" class="form-control" id="validationCustom02" name="fecha_inicio" value="{{ $data[0]->fecha_inicio }}">
                                          
                                          @if($errors->first('fecha_inicio'))
                                              <p style="color:red;">Por favor ingresar una fecha inicio válida.</p>
                                          @endif
                                          {{-- <div class="invalid-feedback">
                                                    Por favor ingresar una fecha inicio válida .
                                         </div>
                                         <div class="valid-feedback">
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
                                         <input type="date" class="form-control" id="validationCustom03"name="fecha_fin" value="{{ $data[0]->fecha_fin }}">
                                         @if($errors->first('fecha_fin'))
                                            <p style="color:red;">Por favor ingresar una fecha fin válida.</p>
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
                                          
                                          <textarea type="text" class="form-control" id="validationCustom04" id="validationCustom04" name="descripcion">{{ $data[0]->descripcion }}</textarea>
                                          @if($errors->first('descripcion'))
                                              <p style="color:red;">Por favor ingresar una descripción válida.</p>
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
    							 <input type="text" id="ruta" class="form-control-file"  name="hidden_image" value="{{ $data[0]->ruta }}">
                                <input id="file" type="file" class="form-control-file"  name="ruta"/>
                                 
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
                                <td>
                                </td>
                                <td>
                                        <center>
                                        <div id="imagePreview"><img src="{{ URL::to('/banner/uploads') }}/{{ $data[0]->ruta }}" width="300" height="100">
                                        </center>
                                </td>
                                </tr>
                                <tr>
   										<td style="text-align: right;">      
                                         Actividad:
                                </td>
                                <td>
                                         <div>
                                         <select class="form-control" name="id_actividad" id="SearchSelect"> 
                                                <option hidden="" value="{{ $data[0]->id_actividad }}">{{ $data[0]->act }}</option>
                                                <option disabled="" value="">--Seleccionar una actividad--</option>
                                                @foreach($actividad as $act)
                                                 <option value="{{ $act->id_actividad }}">{{ $act->nombre }}</option>
                                                 @endforeach
                                         </select>
                                         @if($errors->first('id_actividad'))
                                              <p style="color:red;">Por favor ingresar una fecha inicio válida.</p>
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
                                <td>

										
                                 </table>
                                 
                            
                            </center>
                            <div align="right">
                                    <button type="submit" class="btn btn-primary col-md-4">Guardar</button>
                                 </div>
								    </form>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
								    <script type="text/javascript">

                                        $('#file').change( function() {
  
                                          if(this.files[0].size > 1000000) {
      $(this).val('');
    $('#errores1').html("La imagen supera 1 Megabyte de peso permitido.");
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
                                        }, false); */

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
