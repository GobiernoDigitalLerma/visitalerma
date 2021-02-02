<title>CONOCE LERMA</title>
@extends('pagina.header')
@section('contenido')

<link href="{{asset('css/quehacer.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('js/hover.js')}}">  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


  <!--=================================================
  =            Seccion Actividad tipo Que Sucede Ahora principal            =
  ==================================================-->
<div class="container" style="text-align: center; padding-right: 0px;padding-left: 0px">
    <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="{!!URL::to('/')!!}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Conoce Lerma</li>
    </ol>
<section>
  <div class="row container" style="height: 90px">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1 class="titulos" align="center" style="color: #9c66a4;">CONOCE LERMA</h1>
      <hr class="lineaTituloAzul col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
    </div>

  </div>
@foreach($imgPrincipal as $img)
<a href="{{route('conoce_lerma_actividades',$img->nombre)}}">
  <div class="row">
    <div class="actividadprincipal col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
      <div class="contentimg"> 
        <img src="{{ asset('foto_actividades/'.$img->foto) }}" alt="" class="img-fluid imgprincipal" alt="" class="img-fluid imgprincipal">
        <div class="principaltext texto-encima">
          <p>{{$img->nombre}}</p>
        </div>
      </div>
    </div>
  </div>  
</a>  
@endforeach
</section>


<section>
  <div class="row no-gutters">
    @foreach($imgSecundaria as $img)
      <div onmouseover="show(this);" onmouseout="hide(this);" class=" col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
        <div class="contentimg"> 
          <a href="{{route('conoce_lerma_actividades',$img->nombre)}}"><img src="{{ asset('foto_actividades/'.$img->foto) }}"  alt="" class="img-fluid imgsecundaria"></a>
          <div class="secundariotexto texto-encima">
            <p>{{$img->nombre}}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
</div>

  <!--END Seccion Actividad tipo Que Sucede Ahora principal=-->
  




  <!--=================================================
  =            Seccion SubActividades -tipo- Que Sucede Ahora    =
  ==================================================-->





  <!--END Seccion SubActividades -tipo- Que Sucede Ahora=-->
@stop