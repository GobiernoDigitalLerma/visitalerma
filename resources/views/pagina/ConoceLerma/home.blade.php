<title>{{ $head[0]->nombre }}</title>
@extends('pagina.header')
@section('contenido')
<div class="container">
  <div class="row">
    <ol class="breadcrumb bg-light col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 0px">
    <li class="breadcrumb-item"><a href="{!!URL::to('/')!!}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{!!URL::to('conoce_lerma')!!}">Pueblo con encantó</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $head[0]->nombre }}</li>
    </ol>
  </div>
</div>

<link rel="stylesheet" href="/public/css/QueSucede.css">
<link href="{{asset('css/quehacer.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/cssLerma/styleQueSucede.css')}}" rel="stylesheet" type="text/css" />
<div class="container">
  @foreach($head as $i)
  <div id="head">
    <div id="img-head">
      <img src="/public/foto_actividades/{{  $i->foto }}" width="100%" height="420px" class="principal">
      <span id="title-head" class="titulos">{{ $i->nombre }}</span>
      <div class="texto-encima" style="">
  <p>
    {{$i->nombre}}
  </p>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-8">
        <p class="text-justify" id="desc-main">{{ $i->descripcion }}</p>

      </div>
      <div class="col-sm-4">
        <table class="table">
          <thead>
            <th class="text-center table-success" colspan="3" style="color: #FFF"><strong>PUEBLO CON ENCANTÓ</strong></th>
          </thead>
          <tbody>
          @foreach($table as $i)  
            <tr>
              <td><strong><a href="{{ route('conoce_lerma_actividades',$i->nombre) }}" class="text-dark">{{ $i->nombre }}</a></strong></td>           
            </tr>
          @endforeach
          </tbody>
        </table>    
      </div>
    </div>
  </div>
  @endforeach
<!-- Inicio de pagina -->
  <!--Aqui va la seccion de imagenes-->

    @foreach($act as $a)
      <div class="actividad">
  <div class="img-body-3">
          <img class="img" src="{{asset('foto_actividades/'.$a->foto)}}" data-link="{{ route('conoce_lerma_subactividad',$a->nombre) }}" >
          <span class="texto-encima">
              <p>{{$a->nombre}}</p>
          </span>
  </div>
  <div class="description-3">
          <h3><i>{{$a->nombre}}</i></h3>
            <p>{{$a->descripcion}}<a href="{{ route('conoce_lerma_subactividad',$a->nombre) }}" style="color: #5e2129"><center><button type="button" class="btn gradient-1" style="color:
                    white; font-family: 'Bebas Neue', arial;   font-size:20px;">Ver Mas</button></center></a>
            </p>
        </div>
      </div>
    @endforeach
<!-- Fin de pagina -->
</div>
</div>
     <script type="text/javascript">
      $(document).ready(function(){
  $('.img').click(function(){
    var link = $(this).data('link');
    window.location.href = link;
  });
        var iter = 0;
        $('.actividad').each(function(){
          if (iter === 0) {
            $(this).find('.img-body-3').addClass(' img-right');
            $(this).find('.description-3').addClass(' descripcion-left');
            iter = 1;
          }else{
            $(this).find('.img-body-3').addClass(' img-left'); 
            $(this).find('.description-3').addClass(' descripcion-right');
            iter = 0; 
          }
        });
      });
  </script>
@endsection