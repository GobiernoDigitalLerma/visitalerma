<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    @if(!empty($head[0]->nombre))
    	<title>{{ $head[0]->nombre }}</title>
    @else
    	<title>Actividad</title>
    @endif
    @PWACRIZPRZ
    <style media="screen">
    @media screen and (max-width: 800px) {
      .divfotoprincipal{
        height: 100px;
      }
    }
     </style>
</head>
<body>
@extends('pagina.header')
@section('contenido')
    <!--head image-->
    @foreach($head as $act)
    <section>
      <div class="container divfotoprincipal">
        <div class="col-12">
          <div class="bg-img-head">
            	<img src="/public/foto_actividades/{{$act->foto }}" width="100%" height="auto" class="principal">
          </div>
        </div>
      </div>
    </section>


    <!--breadcumbs-->
    <section class="container">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="https://visita.lerma.gob.mx">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('conoce_lerma')}}">Pueblo con encantó </a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$act->nombre}}</li>
      </ol>
    </section>

    <!--description-->
    <section class="events">
        <div class="container my-md-5 mb-4">
          <div class="row">
            <div class="col-12 col-md-7">
              <div class="card-content">
                <h1>{{ $act->nombre }}</h1>
		<div >
		      <hr class="float-left" style="
		      content:'';left:1rem;top:4rem;margin:10px auto;width:25%;height:3px;background:#ed1a38">
            	</div><br>
                <p style="white-space:pre-line; text-align: justify;">{{$act->descripcion}}</p>
              </div>
            </div>
                 <div class="col-12 col-md-5">
                 <li class="list-group-item bg-info text-white">
		    <h4 class="text-center">Información del Evento</h4>
		  </li>
		  @foreach($descripcion as $des)
		  <li class="list-group-item bg-light">
		    <i class="far fa-calendar-check"></i>
		    Fecha / <strong>{{$des->fecha_inicio}}-{{$des->fecha_fin_actividad}}</strong>
		  </li>
		  <li class="list-group-item">
		    <i class="far fa-clock"></i>
		    Hora / <strong><ul>{{$des->horario_detalle}}.</ul></strong>
		  </li>

		  @endforeach
                <li class="list-group-item bg-info text-white">
                  <h4 class="text-center">Pueblo con encantó</h4>
                </li>
                 @foreach($table as $a)
                <a href="{{route('conoce_lerma_actividades',$a->nombre)}}" class="list-group-item list-group-item-action bg-light">
                {{ $a->nombre }}</a>
                @endforeach
              </div>


            </div>
          </div>
        </div>
    </section>
@endforeach
    <!--events-->

<?php
$bandera = 1;
?>
    <section id="galeria">
      @if (array_key_exists(0,$head))
        @if (!is_null($head[0]->imagenes))
          @php
          $array = json_decode($head[0]->imagenes);
          $toggle = 1;
           @endphp
            @foreach($array as $i)
              @if (!is_null($i->file))
                @if ($toggle == 0)
                  <div class="card mb-5">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-7">
                          <div class="card-body">
                            <h3 class="card-title">{{$i->title}}</h3>
                            <p class="card-text" ALIGN="justify">{{$i->description}}</p>
            
                          </div>
                        </div>
                        <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$i->file) }});">
                        </div>
                      </div>
                    </div>
                  </div>
                  @php
                    $toggle = 1;                    
                  @endphp
                @else
                  <div class="card bg-light mb-5">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$i->file) }});">
                        </div>
                        <div class="col-md-7">
                          <div class="card-body">
                            <h3 class="card-title">{{$i->title}}</h3>
                            <p class="card-text" ALIGN="justify">{{$i->description}}</p>          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @php
                      $toggle = 0;
                  @endphp
                @endif
              @endif
            @endforeach          
        @endif
      @endif
    </section>

    <section class="events mb-5">
      @foreach($actividades as $a)

      @if(($bandera % 2) == 0)

        <div class="card">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
                <div class="card-body">
                  <h3 class="card-title">{{$a->nombre}}</h3>
                  <p class="card-text" ALIGN="justify" style="white-space:pre-line; text-align: justify;">{{$a->descripcion}}</p>
                  <a href="{{route('conoce_lerma_subactividad',$a->nombre)}}" class="btn btn-info btn-sm">Ver más</a>
                </div>
            </div>
           <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$a->foto) }});">
            </div>
          </div>
        </div>
      </div>

      @else


      <div class="card bg-light">
        <div class="container">
          <div class="row">
          <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$a->foto) }});">
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h3 class="card-title">{{$a->nombre}}</h3>
                <p class="card-text" ALIGN="justify" style="white-space:pre-line; text-align: justify;">{{$a->descripcion}}</p>
                <a href="{{route('conoce_lerma_subactividad',$a->nombre)}}" class="btn btn-info btn-sm">Ver m&aacute;s</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      <?php
      $bandera = $bandera + 1;
      ?>

      @endforeach
    </section>

    {{-- <div class="card bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-5 bg-img-max-h shadow" style="background-image: url({{ asset('foto_actividades/'.$array[$i]) }});">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <h3 class="card-title"></h3>
              <p class="card-text" ALIGN="justify"></p>

            </div>
          </div>
        </div>
      </div>
    </div> --}}


<section class="events bg-light">
  <div class="container">
    <div class="row justify-content-between">
     <div class="col-12 col-md-6">
      <div class="card-content">
         <h3> Reseñas</h3>
        <div class="review">
        @foreach($resena as $resenas)
         <p>"{{$resenas->detalle}}"</p>
         <h6 class="bmv">{{$resenas->nombre}}</h6>
        @endforeach
        <hr>
        </div>
      </div>
    </div>
   </div>
 </div>
</section>


@stop
</body>

</html>
