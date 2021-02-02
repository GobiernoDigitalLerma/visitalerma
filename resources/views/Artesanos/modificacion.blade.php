@extends('Sistema.admin')
    @section('contenido')
@foreach($art as $re)
<center>
            <h1 style="font-family:bree serif,serif;">ARTESANOS</h1>
    </center>
    <form class="needs-validation" novalidate enctype="multipart/form-data" action="{{route('updateartesano')}}" method="post">
        @csrf
        <center>
        <div style="align-content: center;">
        <table class="table" style="width: 50%;">
              <tr>


                <td style="text-align: right;">Id:</td>
                <td>
                <div>
       
        <input type="text" name="id_art" class="form-control " id="validationCustom01" 
        required placeholder="Id" value="{{$re->id_art}}">
                <div class="invalid-feedback">
                Por favor ingresa un nombre  válido.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
        <tr>


                <td style="text-align: right;">Nombre:</td>
                <td>
                <div>
       
        <input type="text" name="nombre" class="form-control " id="validationCustom01" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" 
        required placeholder="Nombre" value="{{$re->nombre}}">
                <div class="invalid-feedback">
                Por favor ingresa un nombre  válido.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
            <tr>

                <td style="text-align: right;">Direccion:</td>
                <td>
                <div>
       
        <input type="text" name="direccion" class="form-control " id="validationCustom01" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" required placeholder="Direccion" value="{{$re->direccion}}">
                <div class="invalid-feedback">
                Por favor ingresa una direccion válido.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
            <tr>

                <td style="text-align: right;">Telefono:</td>
                <td>
                <div>
       
        <input type="text" name="telefono" class="form-control " id="validationCustom01" required placeholder="telefono" value="{{$re->telefono}}">
                <div class="invalid-feedback">
                Por favor ingresa un numero  válido.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
         <tr>

                <td style="text-align: right;">Contacto:</td>
                <td>
                <div>
       
        <input type="text" name="contacto" class="form-control " id="validationCustom01" required placeholder="Contacto" value="{{$re->contacto}}">
                <div class="invalid-feedback">
                Por favor ingresa un contacto  válido.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>

            <tr>

                <td style="text-align: right;">Correo:</td>
                <td>
                <div>
       
        <input type="text" name="correo" class="form-control " id="validationCustom01" required placeholder="Correo" value="{{$re->correo}}">
                <div class="invalid-feedback">
                Por favor ingresa un Correo  válido.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Logros:</td>
                <td>
                <div>
                <textarea name="logros" class="form-control " style="width: all;" id="validationCustom02" required placeholder="logros">{{$re->logros}}</textarea>
                <div class="invalid-feedback">
                Por favor ingresa una reseña.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Premios:</td>
                <td>
                <div>
                <textarea name="premios" class="form-control " style="width: all;" id="validationCustom02" required placeholder="premios">{{$re->premios}}</textarea>
                <div class="invalid-feedback">
                Por favor ingresa una reseña.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Historia:</td>
                <td>
                <div>
                <textarea name="historias" class="form-control " style="width: all;" id="validationCustom02" required placeholder="historia">{{$re->historias}}</textarea>
                <div class="invalid-feedback">
                Por favor ingresa una reseña.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
                  <tr>

                <td style="text-align: right;">Tipo artesanias:</td>
                <td>
                <div>
       
        <input type="text" name="id_tipo_artesanias" class="form-control " id="validationCustom01" required placeholder="tipo" value="{{$re->id_tipo_artesanias}}">
                <div class="invalid-feedback">
                Por favor ingresa un tipo válido.
                </div>
                <div class="valid-feedback">
                Campo listo!
                </div>
                </div>
                </td>
            </tr>
@endforeach

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