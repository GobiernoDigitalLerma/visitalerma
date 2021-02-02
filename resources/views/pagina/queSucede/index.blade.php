@extends('pagina.header')

@section('title')
        <title>Visita Lerma</title>
@endsection


@section('contenido')

    <!--banner-->
    <section> <!-- Slider -->
      <div class="container my-md-5">
        <div id="carouselTurismo" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">

          @foreach($images as $banner)
            @if($loop->first)
              <li data-target="#carouselTurismo" data-slide-to="{{$loop->iteration-1}}" class="active"></li>
            @else
              <li data-target="#carouselTurismo" data-slide-to="{{$loop->iteration-1}}"></li>
            @endif
          @endforeach


          </ol>
          <div class="carousel-inner" role="listbox">


          @foreach($images as $banner)
            @if($loop->first)
              <div class="carousel-item active">
                <img src="{{asset('banner/uploads/'.$banner->ruta)}}" class="d-block w-100" alt="...">
              </div>
            @else
              <div class="carousel-item">
                <img src="{{asset('banner/uploads/'.$banner->ruta)}}" class="d-block w-100" alt="...">
              </div>
            @endif
           @endforeach
           </div>
        </div>
      </div>
    </section>
    <!--what to do?-->
   <section>
      <div class="container-fluid mt-4 mt-sm-0 mb-4 bg-about" style="background-image: url(/img/bg-lerma.jpg);">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-6">
            <h1 class="text-center text-white">Qué Hacer</h1>
          </div>
        </div>
      </div>
      <div class="container my-md-5">
        <div class="row row-turismo">
          <div class="col-12 col-md-2">
            <a href="{{route('quehacer')}}">
              <div class="card bg-img-max-h shadow" 
                  style="background-image: url({{ asset('foto_actividades/'.$hacer[0]->foto) }});">
                <div class="card-body">
                  <h4>{{$hacer[0]->nombre}}</h4>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-1">
            <a href="{{route('quehacer')}}">
              <div class="card bg-img-max-h shadow" 
                  style="background-image: url({{ asset('foto_actividades/'.$hacer[1]->foto) }});">
                <div class="card-body">
                  <h4>{{$hacer[1]->nombre}}</h4>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-2">
            <a href="{{route('quehacer')}}">
              <div class="card shadow" 
                  style="background-image: url({{ asset('foto_actividades/'.$hacer[2]->foto) }});">
                  <div class="card-body">
                    <h4>{{$hacer[2]->nombre}}</h4>
                  </div>
              </div>
            </a>
            <a href="{{route('quehacer')}}">
              <div class="card shadow" 
                  style="background-image: url({{ asset('foto_actividades/'.$hacer[3]->foto) }});">
                  <div class="card-body">
                    <h4>{{$hacer[3]->nombre}}</h4>
                  </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>



    <!--what happens now?-->
    <section class="my-md-5">
      <div class="container">
        <h1 class="text-center">Qué Sucede Ahora</h1>
        <div class="row row-turismo no-wrap">
        @foreach($sucede as $infoSucede)
          <div class="col-11 col-md-5">
            <a href="{{route('pagina.queSucede')}}">
              <div class="card shadow bg-img-max-h" 
                  style="background-image: url({{ asset('foto_actividades/'.$infoSucede->foto) }});" >
                  <div class="card-body">
                    <h4>{{$infoSucede->nombre}}</h4>
                  </div>
              </div>
            </a>
          </div>
         @endforeach
        </div>
      </div>
    </section>
    <!--you known lerma-->
    <section class="bg-light">
      <div class="container ">
        <h1 class="text-center">Conoce Lerma</h1>
        <div class="row row-turismo">
          <div class="col-12 col-md-12">
            <a href="{{ route('conoce_lerma') }}">
              <div class="card bg-img-max-h shadow" 
                  style="background-image: url('{{asset('foto_actividades/'.$conoce[0]->foto)}}');background-repeat: no-repeat;">
                  <div class="card-body">
                    <h4>{{$conoce[0]->nombre}}</h4>
                  </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
@endsection 
