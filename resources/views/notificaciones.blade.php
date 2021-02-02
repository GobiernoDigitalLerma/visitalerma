@extends('Sistema.admin')
    @section('contenido')
    <section class="text-center">
        <h1 class="text-upercase">GESTIÓN DE NOTIFICACIONES</h1>
        <br>
         
    </section>
    <section>
        <form class="needs-validation" novalidate action="{{ route('sendNotification') }}" method="POST" >
			{{ csrf_field() }}
			<center>
		   <div class="container" align="center">
            @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
            @endforeach
			<table class="table col-md-6" >
                <tr>
					<td style="text-align: right;">Actividad:</td>
					<td>
						<div>
                           <select name="actividad" id="SearchSelect" class="form-control w-100" >
                               <option value="">-- SELECCIONA UNA ACTIVIDAD --</option>
                               @foreach ($actividades as $item)
                               <option value="{{ $item->id_actividad }}">{{ $item->nombre }}</option> 
                               @endforeach
                           </select>
                       </div>
                       </td>
	 			</tr>
				<tr>
					<td style="text-align: right;">Titulo:</td>
					<td>
						<div>
						<input autocomplete="off" id="validationCustom01" placeholder="Titulo" type="text" name="title" class="form-control" required >
                       </div>
                       </td>
	 			</tr>
	 			<tr>
					<td style="text-align: right;">Mensaje:</td>
					<td>
						<div>
                            <textarea id="validationCustom02" placeholder="Mensaje" name="mensaje" class="form-control" required="required"  ></textarea>
							
                       </div>
                       </td>
	 			</tr>
                <tr>
                       <td></td>
                       <td align="right">
                        <input type="submit" value="Enviar notifiación" class="btn btn-primary col-md-4">
                       </td>
                </tr>
         </table>
     </div>
   </center>
</form>

    </section>
    @stop