@extends('Sistema.admin')
@section('contenido')

<center><h1 style="font-family: 'Bree Serif',serif;">REGISTRA FOTOS DE ACTIVIDADES</h1></center>
  <form class="needs-validation" novalidate enctype="multipart/form-data" action="{{route('guardar_fotosact')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <center>
    <div style="align-content: center;">
    <table class="table" style="width: 50%;">

      <tr>
        <td style="text-align: right;">Actividad:<br></td>
        <td>
          <div>
          <select  class="form-control" name = 'id_actividad' id="SearchSelect" required>
        <option selected="" disabled="" value="">--Seleccionar actividad--</option>
      @foreach($id_actividad as $car)
      <option value = '{{$car->id_actividad}}'>{{$car->nombre}}</option>
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
        <td>
          <div>
          <input placeholder="link" class="form-control" type = 'text' name= 'video'  onchange="return youtube()" id="video">
          <div class="valid-feedback">
            Por favor inserta un link de youtube si es nesesario     
          </div>
          <div class="invalid-feedback">
              Por favor inserta un link de youtube valido
          </div>
          </div>
        </td>
      </tr>
      <tr>
        <td style="text-align: right;">Imagen:
        </td>
        <td>
          <div>
          <input class="form-control-file" type = 'file' name= 'foto' id="validationCustom03"required onchange="return fileValidation()"> 
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
        <td style="text-align: right;">Tipo de Imagen:
        </td>
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
      </tr>
      <tr>
        <td style="text-align: right;">Imagen Extendida:
        </td>
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



    function fileValidation(){
    var fileInput = document.getElementById('validationCustom03');
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

    if(string == null){

      return true;

    }

    function youtube_parser(url){

          var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;

          var match = url.match(regExp);

          return (match&&match[7].length==11)? match[7] : false;
          
    }

    var valor = youtube_parser(string);

    if(valor != false){

      alert('Link valido');

      return true;

    }else if(valor == false){

      alert('Por favor inserta un link de youtube valido');

      fileInput.value = '';

      return false;

    }
    
}

$(document).ready(function(){  
  
    $("#no").click(function() {  
        if($("#no").is(':checked')) {  
            document.querySelector('#ex2').checked = true;  
        } else {  
            document.querySelector('#ex1').checked = true;
        }  
    });  
  
}); 

$(document).ready(function(){  
  
    $("#si").click(function() {  
        if($("#no").is(':checked')) {  
            document.querySelector('#ex2').checked = true;  
        } else {  
            document.querySelector('#ex1').checked = true;
        }  
    });  
  
}); 

  </script>
<!---------------------------------------------------------------------------------------------------------------------------->


@stop