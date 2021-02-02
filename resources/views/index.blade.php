<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Visista Lerma</title>
 
</head>
<body>
  
@extends('pagina.header')
@section('contenido')
<!--banner-->
<section> <!-- Slider -->
      <div class="container my-md-5">
        <div id="carouselTurismo" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselTurismo" data-slide-to="0" class="active"></li>
            <li data-target="#carouselTurismo" data-slide-to="1"></li>
            <li data-target="#carouselTurismo" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/large.jpg" class="d-block w-100" alt="...">

            </div>
            <div class="carousel-item">
              <img src="img/large.jpg" class="d-block w-100" alt="...">
             
            </div>
            <div class="carousel-item">
              <img src="img/large.jpg" class="d-block w-100" alt="...">

            </div>
          </div>
        </div>
      </div>
    </section>
    <!--what to do?-->
    <section>
      <div class="container-fluid mt-4 mt-sm-0 mb-4 bg-about" style="background-image: url(img/bg-lerma.jpg);">
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
                  style="background-image: url(https://visita.lerma.gob.mx/foto_actividades/{{$hacer[0]->foto}});">
                <div class="card-body">
                  <h4>{{$hacer[0]->nombre}}</h4>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-1">
            <a href="{{route('quehacer')}}">
              <div class="card bg-img-max-h shadow" 
                  style="background-image: url(https://visita.lerma.gob.mx/foto_actividades/{{$hacer[1]->foto}});">
                <div class="card-body">
                  <h4>{{$hacer[1]->nombre}}</h4>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-2">
            <a href="{{route('quehacer')}}">
              <div class="card shadow" 
                  style="background-image: url(https://visita.lerma.gob.mx/foto_actividades/{{$hacer[2]->foto}});">
                  <div class="card-body">
                    <h4>{{$hacer[2]->nombre}}</h4>
                  </div>
              </div>
            </a>
            <a href="{{route('quehacer')}}">
              <div class="card shadow" 
                  style="background-image: url(https://visita.lerma.gob.mx/foto_actividades/{{$hacer[3]->foto}});">
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
          <div class="col-11 col-md-4">
            <a href="#">
              <div class="card shadow bg-img-max-h" 
                  style="background-image: url(img/thumb.jpg);">
                  <div class="card-body">
                    <h4>Card title</h4>
                  </div>
              </div>
            </a>
            
          </div>
          <div class="col-11 col-md-5">
            <a href="#">
              <div class="card shadow bg-img-max-h" 
                  style="background-image: url(assetLermaimg/thumb.jpg);" >
                  <div class="card-body">
                    <h4>Card title</h4>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-11 col-md-4">
            <a href="#">
              <div class="card shadow bg-img-max-h" 
                  style="background-image: url(assetLermaimg/thumb.jpg);">
                  <div class="card-body">
                    <h4>Card title</h4>
                  </div>
              </div>
            </a>           
          </div>
          <div class="col-11 col-md-5">
            <a href="#">
              <div class="card shadow bg-img-max-h" 
                  style="background-image: url(img/thumb.jpg);">
                  <div class="card-body">
                    <h4>Card title</h4>
                  </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!--you known lerma-->
    <section class="bg-light">
      <div class="container ">
        <h1 class="text-center">Conoce Lerma</h1>
        <div class="row row-turismo">
          <div class="col-12 col-md-12">
            <a href="#">
              <div class="card bg-img-max-h shadow" 
                  style="background-image: url(img/large.jpg);">
                  <div class="card-body">
                    <h4>Card title</h4>
                  </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!--footer-->
   
@endsection 
</body>
</html>