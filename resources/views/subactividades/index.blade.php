<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sub-actividad</title>
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
    .box {
        border: 1px solid #333333;
        width: 150px;
        height: 100px;
        overflow: scroll;
        border-color: white;
        overflow-x: hidden;
      }
  </style>
</head>
<body>
  @extends('Sistema.admin')
  @section('contenido')

<center>
  <h1 style="font-family: 'Bree Serif',serif;">GESTIÓN DE SUB-ACTIVIDAD</h1>
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
      <a href="{{ URL::to('altaSubactividad') }}"><button class="btn btn-success col-md-4">Nueva sub-actividad</button></a>
    </div><br>
  <div class="table-responsive">
  <table id="reporte" class="usert table table-bordered ">
      <thead>
        <tr>
          <th>No. sub-actividad</th>
          <th>Nombre</th>
          <th>Fecha</th>
          <th>Horario</th>
    <th>Descripci&oacute;n</th>
    <th>Link(s)</th>
	  <th>Costo</th>
          <th>Actividad</th>
          <th>Ubicación</th>
          <th>Tipo de actividad</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subs as $i)
          <tr>
            <td>{{ $i->id_sub_actividad }}</td>
            <td>{{ $i->nombre }}</td>
            <td>{{ $i->fecha }}</td>
            <td>{{ $i->horario }}</td>
      <td><div class="box">{{ $i->descripcion }}</div></td>
      <td><div class="box">{{ $i->link }}</div></td>
	    @if($i->costo)
	    <td>$ {{ number_format($i->costo,2) }}</td>
	    @else
	    <td>Sin costo</td>
	    @endif
            <td>{{ $i->actividades->nombre }}</td>
            <td>{{ $i->ubicaciones->nombre }}</td>
            <td>{{ $i->tipoActividad->nombre }}</td>
            <td>
                <a href="{{ route('status') }}" data-id="{{ $i->id_sub_actividad }}" data-state="{{ $i->activo }}" class="btn btn-primary status"></a>&nbsp;
                
                <a href="{{ route('editSubactividad',$i->id_sub_actividad) }}" class="btn btn-warning">Modificar</a>
                &nbsp;
                {!! Form::open(['method' => 'DELETE', 'class' => 'formDelete','action' => ['SubActividadController@destroy', $i->id_sub_actividad]]) !!}
                {{ csrf_field() }}
                {!! Form::button( 'Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger elimina', 'data-id' => $i->id_sub_actividad ] ) !!}

                {!! Form::close() !!}            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
</div>

<script>
  $(".status").each(function(){
    var state = $(this).data('state');
    if (state == 1) {
      $(this).html('Desactivar');
    }else{
      $(this).html('Activar');
    }
  });
  $(".status").on('click',function(e){
    e.preventDefault();
    var selector = $(this);
    var href = selector.attr('href');
    var id = selector.data('id');
    var state = selector.data('state');
    var text = selector.html();
    if (state == 0 ) {
      state = 1;
    }else{
      state = 0;
    }
    Swal.fire({
      title: 'Estas seguro de '+text+'?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, '+text+'!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
        url: href,
        type: 'GET',
        data: {id,state},
        success: function( msg ) {
            if ( msg.status === 'success' ) {
              if (text == 'Activar') {
                text = 'Activado';
              }else{
                text = 'Desactivado';
              }
              Swal.fire({
                icon: 'success',
                title: text+' con exito',
                showConfirmButton: false,
                timer: 1000
              })
              if(msg.state == 0){
                selector.html('Activar');
                selector.data('state',0);
              }else{
                selector.html('Desactivar');
                selector.data('state',1);
              }
            }
        },
        error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('Cannot delete the category');
            }
        }
    });
      }else{
        return false;
      }
    });
  });

$('.elimina').on('click', function(e) {
    var inputData = $('.formDelete').serialize();


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
        url: "{{ url('/deleteSubactividad') }}" + '/' + id,
        type: 'DELETE',
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