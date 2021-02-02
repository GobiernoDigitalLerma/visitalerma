@extends('Sistema.admin')
	@section('contenido')
	<div align="center">
	<h1 style="font-family:bree serif,serif;">GESTIÓN DE UBICACIONES DE SUB-ACTIVIDADES</h1>
	</div>
	<BR>
	<div align="right">
	<a href="{{url('create-ubicacion-sub-actividad')}}"><button class="btn btn-success">Añadir Ubicación</button></a>
	</div>
	<br>
	<div class="table-responsive">
    <table class="table table-bordered">
			<thead align="left">
				<th>Nombre</th>
				<th>Latitud</th>
				<th>Longitud</th>
				<th>Actividad</th>
				<th>Ubicación</th>
				<th>Operaciones</th>
				<th></th>
			</thead>
			<tbody>
				@if($ubicaciones->count())
				@foreach($ubicaciones as $ubicacion)
				<tr>
				<td>{{$ubicacion->nombre}}</td>
				<td>{{$ubicacion->fx}}</td>
				<td>{{$ubicacion->fy}}</td>
				<td>{{$ubicacion->nombreActividad}}</td>
				<td><a href="{{$ubicacion->frame}}" target="_blank">Acceder</a></td>
				<td>
					<a class="btn btn-warning" href="{{action('UbicacionSubActividadController@edit', $ubicacion->id_ubicacion_sub_actividad)}}" >Modificar</a>
 
         		</td>
         		<td>
         			<form method="post" action="{{action('UbicacionSubActividadController@destroy', $ubicacion->id_ubicacion_sub_actividad)}}">
    				{{ csrf_field() }}
    				<div>
        				<button type="submit" class="btn btn-danger">Eliminar</button>
    				</div>                
					</form>
         		</td>
				</tr>
				@endforeach
				@else
               	<tr>
                	<td>No hay registros...</td>
              	</tr>
              	@endif
			</tbody>
	</table>
</div>
@endsection