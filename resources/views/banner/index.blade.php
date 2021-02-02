<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>BANNERS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{{ asset('sweetalert2/dist/sweetalert2.min.css')}}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.all.min.js')}}}"></script>
        <script src="{{{ asset('sweetalert2/dist/sweetalert2.min.js')}}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

  <style>
    .usert{
      z-index: 100%;
    }
  </style>
</head>
<body>
  @extends('Sistema.admin')
  @section('contenido')

     <div class="col-lg-12 col-xs-12 col-sm-12">
              <div class="col-lg-12 col-xs-12 col-sm-12 ">
                       <CENTER><h1 style="font-family: 'Bree Serif',serif;">GESTIÓN DE BANNER</h1></CENTER>
                       <br>
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

                              <div align="right">
                             <a href="{{ route('nbanner') }}">
                              <button  class="btn btn-success col-md-4">Nuevo Banner</button>
                            </a>
                           	</div>
                             <br>
                              <div class="table-responsive">
                              <table class="table table-bordered" id="reporte">
                              <thead>

                               <th>No. banner</th>
                               <th>Imagen</th>
                               <th>Nombre</th >
                               <th>Fecha Inicio</th>
                               <th>Fecha Final</th>
                               <!-- <th>Descripcion</th> -->
                               <th>Actividad</th>
                               <th>Operaciones</th>

                             </thead>

                           <tbody>
				@foreach($data as $ban)
                            <tr>
                              <td>{{ $ban->id_banner }}</td>
                           <td><img src="{{ URL::to('/banner/uploads') }}/{{ $ban->ruta }}" class="img-thumbnail" width="100" height="100" /></td>
                            <th>{{ $ban->nombre }}</th>
                            <td>{{ $ban->fecha_inicio }}</td>
                            <td>{{ $ban->fecha_fin }}</td>
                            <!-- <td>{{ $ban->descripcion }}</td> -->
                            <td>{{ $ban->activa }}</td>
                            <td>
                             <div class="input-group">
                               <a  href="{{URL::action('BanerController@edit',['id'=>$ban->id_banner])}}" class="btn btn-warning">Modificar</a>
                              &nbsp;
                              {!! Form::open(['method' => 'DELETE', 'id' => 'formDelete', 'action' => ['BanerController@destroy', $ban->id_banner]]) !!}

                              {!! Form::button( 'Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger elimina','id' =>  'btnelimina', 'data-id' => $ban->id_banner ] ) !!}

                              {!! Form::close() !!}
                            </div>
                            </td>
                           </tr>
				@endforeach
                            </tbody>


                             </table>
                           </div>
                     </div>

        </div>

<script>

$('.elimina').on('click', function(e) {
    var inputData = $('#formDelete').serialize();


    var id = $(this).attr('data-id');
    var parent = $(this).parent();

    Swal.fire({
  title: 'Estas seguro?',
  text: "¡No podrás revertir esto!",

  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.value) {

$.ajax({
        url: '{{ url('/eliminarbaner') }}' + '/' + id,
        type: 'POST',
        data: inputData,
        success: function( msg ) {
            if ( msg.status === 'success' ) {
              Swal.fire({

  icon: 'success',
  title: 'Registro eliminado con exito',
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
                toastr.error('Cannot delete the category');
            }
        }
    });
  }
})

    return false;
});

</script>
  @stop
</body>
</html>
