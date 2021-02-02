<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>alta Tarjeta madre</title>
</head>
<body>
 @extends('Sistema.admin')  
@section('contenido')

<form action="{{route('guardar_artesanias')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

    @csrf
    <center>
     <div class="container" align="center">
      <table class="table col-md-7" >
        <tr>
          <td style="text-align: right;">Nombre</td>
          <td>
            <div>
              <input id="validationCustom01" placeholder="Nombre Artesania" type="text" name="name" class="form-control" required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}">
              <div class="invalid-feedback">
               Por favor ingresar un nombre valido.
             </div>
             <div class="valid-feedback">
               Campo listo!
             </div>
           </div>
         </td>
       </tr>
       <tr>
        <td style="text-align: right;">Caracteristicas:</td>
        <td>
          <div>
			<textarea placeholder="Caracteristicas" type="text" name="caracteristicas" class="form-control" required="required"></textarea>
			 </div>
        </td>
      </tr>
      <tr>
        <td style="text-align: right;">Medidas:</td>
        <td>
          <div>
            <input id="validationCustom03" placeholder="Medidas" type="text" name="medidas" class="form-control"  required="required">
            <div class="invalid-feedback">
             Por favor ingresar medidas validas.
           </div>
           <div class="valid-feedback">
             Campo listo!
           </div>
         </div>
       </td>
     </tr>
     <tr>
      <td style="text-align: right;">Tipo Artesania:</td>
      <td>
        <div>
         <select id="SearchSelect" name="id_tipo_artesanias" class="form-control " required="required">
           <option value="" hidden="">--Seleccionar tipo de artesania--</option>
           @foreach($tipoartesania as $a)
           <option value="{{$a->id_tipo_artesanias}}">{{$a->nombre}}</option>
           @endforeach
         </select>
         <div class="invalid-feedback">
          Por favor seleccionar tipo de artesania.
        </div>
        <div class="valid-feedback">
          Campo listo!
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;">Descripcion:</td>
    <td>
      <div>
        <textarea placeholder="Descripcion" type="text" name="descripcion" class="form-control" required="required"></textarea>

      </div>
    </td>
  </tr>         
  <tr>
    <td style="text-align: right;">Fotografia 1:</td>
    <td><div>
      <input onchange="nombref1(this.value);" class="form-control-file img1" type="file" name="foto1" id="validationCustom09" placeholder="Elije una imagen" >
      <input hidden type="text" name="nombrefoto1" id="f1">
      <div class="invalid-feedback">
       Por favor inserta una imagen.
     </div>
     <div class="valid-feedback">
       Campo listo!
     </div>
   </div>
 </td>
</tr>
<tr>
  <td style="text-align: right;">Fotografia 2:</td>
  <td><div>
   <input onchange="nombref2(this.value);" class="form-control-file" type="file" name="foto2" id="validationCustom09" placeholder="Elije una imagen2" >
   <input hidden type="text" name="nombrefoto2" id="f2">
   <div class="invalid-feedback">
    Por favor inserta una imagen.
  </div>
  <div class="valid-feedback">
    Campo listo!
  </div>
</div>
</td>
</tr>
<tr>
  <td style="text-align: right;">Fotografia 3:</td>
  <td><div>
   <input onchange="nombref3(this.value);" class="form-control-file" type="file" name="foto3" id="validationCustom09" placeholder="Elije una imagen" >
   <input hidden type="text" name="nombrefoto3" id="f3">
   <div class="invalid-feedback">
    Por favor inserta una imagen.
  </div>
  <div class="valid-feedback">
    Campo listo!
  </div>
</div>
</td>
</tr>
<tr>
  <td style="text-align: right;">Fotografia 4:</td>
  <td><div>
   <input onchange="nombref4(this.value);" class="form-control-file" type="file" name="foto4" id="validationCustom09" placeholder="Elije una imagen" >
   <input hidden type="text" name="nombrefoto4" id="f4">
   <div class="invalid-feedback">
    Por favor inserta una imagen.
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
      
            $('#validationCustom09').change(function(){
              filePreview(this);
            });
      
          })();
        </script>
<script>      
function nombref1(fic) {
    fic = fic.split('\\');
  $('#f1').val(fic[fic.length-1]);
}
function nombref2(fic) {
    fic = fic.split('\\');
  $('#f2').val(fic[fic.length-1]);
}
function nombref3(fic) {
    fic = fic.split('\\');
  $('#f3').val(fic[fic.length-1]);
}
function nombref4(fic) {
    fic = fic.split('\\');
  $('#f4').val(fic[fic.length-1]);
}
	</script>
@stop
</body>
</html>
