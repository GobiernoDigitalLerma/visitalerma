<!--Inico del Machote-->
@extends('Sistema.admin')
@section('contenido')

<center><h1 style="font-family: 'Bree Serif', serif;">MODIFICACIÓN TIPO DE ACTIVIDADES</h1>
</center>
<form class="needs-validation" novalidate enctype="multipart/form-data" action ="{{route('editatactividad')}}" method="POST">

<!--Para traer el token-->
{{csrf_field()}}
<!--Inicio del Formulario-->
<center>
<div style="align-content: center;">
<input type="hidden" name="id_tipo_actividad" value="{{$contenido->id_tipo_actividad}}" class="form-control" >
		<table class="table" style="width: 50%;">
			<tr>
				<td style="text-align: right;">Nombre de tipo-actividad</td>
				<td>
					<div>
					<input required id="validationCustom01" placeholder="Tipo actividad" type="text" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" name="nombre" value="{{$consul->nom}}" class="form-control">
					<div class="invalid-feedback">
                                 Por favor ingresar un tipo de actividad válido.
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
@stop
