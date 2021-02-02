@extends('pagina.header')

@section('contenido')
<style>
    /* Ocultar bot�n radio */
input[id^="OFF"]{
display: none;
}
/* Estilo bot�n clicable */
input[id^="OFF"] + label {
display: block;
width: 100px;
margin: 0 auto;
padding: 5px 20px;
background: #444141;
cursor: pointer;
}
/* Estilo bot�n cuando su INPUT est� seleccionado */
input[id^="OFF"]:checked + label {
color: #333;
background: #ccc;
}
/* Estilo caja SPOILER (inicialmente oculto) */
input[id^="OFF"] ~ .OFF {
width: 90%;
height: 0;
overflow: hidden;
opacity: 0;
margin: 10px auto 0;
}
/* Estilo caja SPOILER cuando su INPUT est� seleccionado */
input[id^="OFF"]:checked + label + .OFF{
height: auto;
opacity: 1;
}
</style>
<br>
<section>
<div class="container">
<div class="row no-gutters">
    <div class="conocelerma col-sm-12 col-lg-6 col-xs-12" style="text-align: center;">
      <img src="{{ asset('images/icons/.png') }}" class="img-fluid img-fluid imgsecundaria">
   </div>
   <div class="conocelerma col-sm-12 col-lg-6 col-xs-12">
   <br>
     <H3 style="text-align: center;">No hay conexi&oacute;n a internet</H3>
<input type="checkbox" id="OFF1"></input>
<label for="OFF1" style="text-align: center; color:white;" >MAS</label>
<div class="OFF"><h5>Intenta:</h5>
    <ul>
      <li>Desactivar el modo avi&oacute;n.</li>
      <li>Activar los datos m&oacute;viles o la conexi&oacute;n Wi-Fi.</li>
      <li>Verificar la se&ntilde;al en tu &aacute;rea.</li>
    </ul>
</div>
   </div>
</div>	
</div>
	
</section>
<br>
@endsection