<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>FOTO DE ACTIVIDADES</title>
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
<center>
    <h1 style="font-family: 'Bree Serif',serif;">GESTIÓN DE FOTOS DE ACTIVIDADES</h1>
</center>
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
            <a href="{{ URL::to('fotos_actividades') }}"><button class="btn btn-success col-md-4">Nueva foto de actividad</button></a>
        </div>
    <br>
    <div class="table-responsive">
    <table class="table table-bordered" id="reporte">
        <thead>
            <th>No Fotos de Actividades</th>
            <th>Nombre Actividad</th>
            <th>Foto</th>
            <!-- <th>Video</th>
            <th>Detalle</th> -->
            <th>Tipo de Foto</th>
            <th>Extendida</th>
            <th >Operaciones</th>
        </thead>
        <tbody>
            @foreach($sql as $report)
                <tr>
                    <td>{{ $report->id_foto_actividad }}</td>
                    <td>{{ $report->nombre }}</td>
                <td><img style="width:85px; height:85px;" src="{{ asset('foto_actividades/'.$report->foto) }}"></td>
                    <!-- <td>{{ $report->video }}</td>
                    <td>{{ $report->detalle}}</td> -->
                    @if($report->tipo_foto==1)
                    <td>Principal</td>
                    @else
                        @if($report->tipo_foto==2)
                        <td>Secundaria</td>
                        @else
                        <td>No hay tipo de foto</td>
                        @endif
                    @endif
                    @if( $report->extendida==1)
                    <td>Si</td>
                    @else
                    <td>No</td>
                    @endif
                    <td>
                    <div class="input-group">
                       <a href="{{ URL::action('FotoActividadController@mod_fotos_actividades',['pera'=>$report->id_foto_actividad]) }}"><button class="btn btn-warning">Modificar</button></a>
                        &nbsp;
                        {!! Form::open(['method' => 'DELETE', 'id' => 'formDelete', 'action' => ['UsuarioController@destroy', $report->id_foto_actividad]]) !!}

                        {!! Form::button( 'Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger elimina','id' =>  'btnelimina', 'data-id' => $report->id_foto_actividad ] ) !!}

                        {!! Form::close() !!}
                    </div>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
        url: '{{ url('/eliminarfotoactividad') }}' + '/' + id,
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
