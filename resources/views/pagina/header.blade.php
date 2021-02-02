<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('title')


    <meta name="robots" content="index,follow">
    <meta name="description" content="Lerma Pueblo con Encanto">
    <meta name="author" content="LERMA.GOB.MX">
    <meta name="keywords" content="lerma, turismo, artesanias, que hacer, municipio">
    <meta name="copyright" content="Copyright 2020 Ayuntamiento de Lerma">
    <link rel="canonical" href="https://visita.lerma.gob.mx">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://visita.lerma.gob.mx">
    <meta property="og:title" content="Visita Lerma">
    <meta property="og:description" content="Lerma Pueblo con Encanto">
    <meta property="og:image" content="https://geoid.mx/img/logo-geoid.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assetsLerma/css/src/style.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">
    @yield('link')
    @laravelPWA
</head>
<body>
    <!--header-->
    <header>
      <div class="brand text-center">
        <img src="{{asset('assetsLerma/img/logos-lerma.png')}}" alt="lerma">
      </div>
      <div class="social-icons">
        <div class="container">
          <ul>
            <li class="search">
              <form class="form-inline">
                <input class="form-control form-control-sm" type="search" placeholder="¿Que estas buscando?" aria-label="Buscar">
              </form>
            </li>
            <li class="facebook">
              <a href="https://www.facebook.com/Ayuntamiento-de-Lerma-467953823268730" class="s-i" target="_blank"></a>
            </li>
            <li class="instagram">
              <a href="https://www.instagram.com/promocionturisticalerma/" class="s-i" target="_blank"></a>
            </li>
            <li class="youtube">
              <a href="https://www.youtube.com/channel/UC8IK9ozLAiYcvIftlzb1NWw" class="s-i" target="_blank"></a>
            </li>
          </ul>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-dark gradient-brand">
        <div class="container">
          <button class="navbar-toggler ri" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav">
              <li class="nav-item">
                 <a class="nav-link" href="https://visita.lerma.gob.mx">INICIO</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="https://visita.lerma.gob.mx/quehacer">QUÉ HACER</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="https://visita.lerma.gob.mx/queSucede">QUÉ SUCEDE AHORA</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="https://visita.lerma.gob.mx/conoce_lerma">PUEBLO CON ENCANTÓ</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="https://visita.lerma.gob.mx/festival-cultura">FESTIVALES Y CULTURA</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#">ARTESANÍAS</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="https://visita.lerma.gob.mx/index_actividades">SERVICIOS</a>
             </li>
         </ul>
          </div>
        </div>
        </nav>
    </header>

<!-- CONTENIDO DE LA PAGINA -->
  @yield('contenido')
<!-- FIN DE CONTENIDO -->


    <!--footer-->
    <footer>
      <div class="container-fluid bg-dark text-light">
        <div class="container">
          <div class="row py-5 justify-content-center">
            <div class="col-4 col-md-1">
              <img src="{{asset('assetsLerma/img/lerma-footer.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-10 col-md-4">
              <h5 class="text-uppercase pb-1">Contactanos</h5>
              <i class="fas fa-phone fa-xs fa-footer pr-3"></i><a href="tel:+52 728 2829903" class="text-light">+52 (728) 2829903</a><br>
              <i class="far fa-envelope fa-xs fa-footer pr-3"></i><a href="mailto:turismo@gmail.com" class="text-light">turismo.lerma@gmail.com</a><br>
              <i class="fas fa-map-marker-alt fa-xs fa-footer pr-3"></i><a href="#" class="text-light">Palacio Municipal s/n Col. Centro, Lerma, Estado de México</a>
            </div>
            <div class="col-10 col-md-3">
              <h5 class="text-uppercase pb-1">Síguenos</h5>
              <i class="fab fa-facebook fa-xs fa-footer pr-3"></i><a href="https://www.facebook.com/Ayuntamiento-de-Lerma-467953823268730" class="text-light">Facebook</a><br>
              <i class="fab fa-instagram-square fa-xs fa-footer pr-3"></i><a href="https://www.instagram.com/promocionturisticalerma/" class="text-light">Instagram</a><br>
              <i class="fab fa-youtube fa-xs fa-footer pr-3"></i><a href="https://www.youtube.com/channel/UC8IK9ozLAiYcvIftlzb1NWw" class="text-light">YouTube</a><br>
            </div>
            <div class="col-10 col-md-4">
              <h5 class="text-uppercase pb-1">Enlaces de interes</h5>
              <a href="http://www.lerma.gob.mx/" class="text-light">Ayuntamiento de Lerma</a><br>
              <a href="http://turismo.edomex.gob.mx/" class="text-light">Secretaría de Cultura y Turismo del Estado de México.</a><br>
              <a href="http://iifaem.edomex.gob.mx/" class="text-light">Instituto de Investigación y Fomento de las Artesanias del Estado de México</a><br>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid bg-secondary">
        <div class="container">
          <div class="row py-3 justify-content-md-center text-center">
            <div class="col-12 col-md-8 copy">
              <a href="#" class="text-white small text-uppercase pr-4">Derechos reservados {{ date("Y") }}</a>
              <a href="http://www.lerma.gob.mx/ayuntamiento/aviso-de-privacidad/" class="text-white small text-uppercase pr-4">Anuncio de privacidad</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b2d5760d1d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    @yield('script')
</body>
</html>
