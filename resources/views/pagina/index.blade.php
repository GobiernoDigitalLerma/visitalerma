
@section('title')
        <title>Visita Lerma</title>
@endsection
@extends('pagina.header')
@section('contenido')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{asset('js/pouchdb.min.js')}}" charset="utf-8"></script>
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
              <a href="{{ route('paginaBanner',$banner->nombre) }}"><img src="{{asset('banner/uploads/'.$banner->ruta)}}" class="d-block w-100" alt="..."></a>
              </div>
            @else
              <div class="carousel-item">
              <a href="{{ route('paginaBanner',$banner->nombre) }}"><img src="{{asset('banner/uploads/'.$banner->ruta)}}" class="d-block w-100" alt="..."></a>
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
        <h1 class="text-center">PUEBLO CON ENCANTÓ</h1>
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              INSTALAR APLICACIÓN EN TU DISPOSITIVO MOVIL
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <button type="button" class="btn btn-success btn-sm btn-block download" id="buttonAdd" name="button">DESCARGAR APLICACIÓN</button>

          </div>

        </div>
      </div>
    </div>
    <script>
    window.onload = (e) => {
// Declare init HTML elements
const buttonAdd = document.querySelector('#buttonAdd');

let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
  // Prevent Chrome 67 and earlier from automatically showing the prompt
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
});

// Add event click function for Add button
buttonAdd.addEventListener('click', (e) => {
  // Show the prompt
  deferredPrompt.prompt();
  console.log(deferredPrompt);
  // Wait for the user to respond to the prompt
  deferredPrompt.userChoice
    .then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {

        const ip = "<?php echo $_SERVER['REMOTE_ADDR'] ; ?>";
        const token = "{{ csrf_token() }}";
       $.post('downloadPWA',{
         _token:token,
         ipublic:ip
       }, (data) => {
         console.log(data);
       });
       $('#exampleModal').modal('hide');
        console.log('User accepted the A2HS prompt');
      } else {


        console.log('User dismissed the A2HS prompt');
      }
      deferredPrompt = null;
    });
});
}

    </script>
    <script>
  $(document).ready(function(e) {
    const navegador = window.screen;
    const ip = "<?php echo $_SERVER['REMOTE_ADDR'] ; ?>";

    if (navegador.width <= 800) {
      $.get('checkpwa/'+ip, data => {
        if (data.total == 0) {
          $('.showpwamodal').trigger("click");
        }
      })
    }
  });
</script>

<script>

    const ip = "<?php echo $_SERVER['REMOTE_ADDR'] ; ?>";

        function subscripcion(){
          if (!swReg) return console.log("no hay registro del service worker");

          swReg.pushManager
           .subscribe({
               userVisibleOnly: true,
               applicationServerKey: urlBase64ToUint8Array(
                   "{{env('VAPID_PUBLIC_KEY')}}"
                 )
           })
           .then(res => res.toJSON())
           .then(subscripcion => {

               fetch('/api/subscribe/'+ip, {
                   method: 'POST',
                   headers:{
                       'Content-Type': 'application/json'
                     },
                   body: JSON.stringify(subscripcion)
               })
               .then(  verificasubscripcion() )
               .catch(console.log);

           });
          };

                 //function url
          function urlBase64ToUint8Array(base64String) {
          const padding = '='.repeat((4 - base64String.length % 4) % 4);
          const base64 = (base64String + padding)
          .replace(/\-/g, '+')
          .replace(/_/g, '/');
          const rawData = window.atob(base64);
          const outputArray = new Uint8Array(rawData.length);
          for (let i = 0; i < rawData.length; ++i) {
          outputArray[i] = rawData.charCodeAt(i);
          }
          return outputArray;
          }
          notificarme();
        </script>
@endsection
