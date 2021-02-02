<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Artesanias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      	<link rel="stylesheet" href="{{{ asset('sweetalert2/dist/sweetalert2.min.css')}}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.all.min.js')}}}"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.min.js')}}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

        <meta name="csrf-token" content="{{ csrf_token() }}" />
 
	<style>
		.usert{
			z-index: 100%;
		}
	</style>
</head>
<body>
    @extends('Sistema.admin')
    @section('contenido')
    <!--Inicio Boron de Altas-->
  <h1 align="center" style="font-family: 'Bree Serif', serif;"> GESTI&Oacute;N DE ARTESANIAS</h1>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $("#content").fadeOut(1500);
            },3000);
         
            setTimeout(function() {
                $(".content2").fadeIn(1500);
            },6000);
        });
    </script>
     <div align="right"><a href="{{URL::to('/artesaniasalta')}}" class="btn btn-success col-md-4">Nueva Artesania</a></div><br>

     <div class="table-responsive bs-example widget-shadow">
     <!--Inicia la Tabla-->
     <table class="table table-bordered table-responsive" id="reporte">
        <thead>
        <tr>
          <th>Clave</th>
          <th>Nombre</th>
          <th>Caracteristicas</th>
          <th>Medidas</th>
          <th>tipo artesania</th>
          <th>Foto 1</th>
          <th>Foto 2</th>
          <th>Foto 3</th>
          <th>Foto 4</th>
          <th>Descripcion</th>
          <th>Opciones</th>
        </tr> 
      </thead>
      <tbody>
        @foreach($artesanias as $c)
        <tr>
          <th scope="row">{{$c->idpa}}</th>
          <td>{{$c->nombre}}</td>
          <td>{{$c->caracteristicas}}</td>  
          <td>{{$c->medidas}}</td> 
          <td>{{$c->id_tipo_artesanias}}</td>
          @if ($c->foto1 != null)
          <td><img src="{{asset('productos_artesanias/'.$c->foto1)}}" alt="" width="100" height="100"></td>
          @else
          <td>SIN FOTOGRAFIA</td>
          @endif 
          @if ($c->foto2 != null)
          <td><img src="{{asset('productos_artesanias/'.$c->foto2)}}" alt="" width="100" height="100"></td>
          @else
          <td>SIN FOTOGRAFIA</td>
          @endif 
          @if ($c->foto3 != null)
          <td><img src="{{asset('productos_artesanias/'.$c->foto3)}}" alt="" width="100" height="100"></td>
          @else
          <td>SIN FOTOGRAFIA</td>
          @endif 
          @if ($c->foto4 != null)
          <td><img src="{{asset('productos_artesanias/'.$c->foto4)}}" alt="" width="100" height="100"></td>
          @else
          <td>SIN FOTOGRAFIA</td>
          @endif 
          <td>{{$c->descripcion}}</td> 

          <td>
            
              <a href="{{URL::action('ControllerTartesanias@edita_tartesaniasvista',['id_tipo_artesanias'=>$c->id_tipo_artesanias])}}"  class="btn btn-warning">
              Modificar</a>
            @if ($c->activo == 0)
            <button class="btn btn-primary actviar" name="{{ $c->id_tipo_artesanias }}">Activar</button>
            <button class="btn btn-danger eliminar" name="{{ $c->id_tipo_artesanias }}">Eliminar</button>
            @else
            <button class="btn btn-danger desactivar" name="{{ $c->id_tipo_artesanias }}">Desactivar</button>
            @endif

            </td>

        </tr>
        @endforeach


    
     </tbody> 
    </table> 
  </div>

<script type="text/javascript">

$('.desactivar').on('click', function(e) {
    var id = $(this).attr('name');
    Swal.fire({
      title: 'Estas seguro?',
      text: "Â¡No podrÃ¡s revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Desactivar!'
    }).then((result) => {

      if (result.value) {

      $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: '{{ url('eliminar-artesania-ajax') }}' + '/' + id,
          method: 'POST',
          success: function( msg ) {
              if ( msg.status === 'success' ) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Registro desactivado con exito',
                      showConfirmButton: false,
                      timer: 1000
               })
                      parent.slideUp(300, function () {
                      parent.closest("tr").remove();
                });
                 setInterval(function() {
                  
                 }, 5900);
           
            }
          },
          error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('No se puede desactivar este registro.');
            }
          }
        });

      }else if(!result.value){

        Swal.fire(
            'Cancelado',
            'El registro no ha sido desactivado.',
            'success'
        )

      }

     setTimeout("location.href='reporte_tartesanias'", 2000);
  });
});


$('.actviar').on('click', function(e) {
    var id = $(this).attr('name');

    Swal.fire({
      title: 'Estas seguro?',
      text: "Â¡No podrÃ¡s revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Activar!'
    }).then((result) => {

      if (result.value) {

      $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: '{{ url('activar-artesania-ajax') }}' + '/' + id,
          method: 'POST',
          success: function( msg ) {
              if ( msg.status === 'success' ) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Registro activado con exito',
                      showConfirmButton: false,
                      timer: 1000
               })
                      parent.slideUp(300, function () {
                      parent.closest("tr").remove();
                });
                 setInterval(function() {
                  
                 }, 5900);
            
            }
          },
          error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('No se puede activar este registro.');
            }
          }
        });

      }else if(!result.value){

        Swal.fire(
            'Cancelado',
            'El registro no ha sido activado.',
            'success'
        )

      }
    setTimeout("location.href='reporte_tartesanias'", 2000);
      
  });
});


$('.eliminar').on('click', function(e) {
    var id = $(this).attr('name');

    Swal.fire({
      title: 'Estas seguro?',
      text: "Â¡No podrÃ¡s revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {

      if (result.value) {

      $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: '{{ url('eliminardefinitivo-artesania-ajax') }}' + '/' + id,
          method: 'POST',
          success: function( msg ) {
              if ( msg.status === 'success' ) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Registro Eliminado con exito',
                      showConfirmButton: false,
                      timer: 1000
               })
                      parent.slideUp(300, function () {
                      parent.closest("tr").remove();
                });
                 setInterval(function() {
                  
                 }, 5900);
            
            }
          },
          error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('No se puede Eliminar este registro.');
            }
          }
        });

      }else if(!result.value){

        Swal.fire(
            'Cancelado',
            'El registro no ha sido eliminado.',
            'success'
        )

      }
    setTimeout("location.href='reporte_tartesanias'", 2000);
      
  });
});


</script>
@stop
</body>
