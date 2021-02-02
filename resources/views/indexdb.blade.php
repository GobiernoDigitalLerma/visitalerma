@php
  $a = 1;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Que hacer</title>

  <style>
    @media screen and (min-width: 800px) {
     .imagen{
       width: 456px;
       height: ;
     }
}
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('js/pouchdb.min.js')}}" charset="utf-8"></script>
</head>
<body>

  @extends('pagina.header')
	@section('contenido')


	<div class="pc">
	<!--=================================================
	=            Seccion Actividad principal            =
	==================================================-->
	<div class="container" style="text-align: center; padding-right: 0px;padding-left: 0px">
	 <!--breadcumbs-->
    <section class="container">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{!!URL::to('/')!!}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">QuÃ© hacer</li>
        </ol>
    </section>
    <!--what to do?-->

<!--Nueva SecciÃ³n-->
<section>
        <div class="container my-md-5">
          <div class="row row-cols-1 row-cols-md-3" id="subactividades">
            <div class="col mb-4">
              <div class="card-content">
                <h1 ALIGN="left">que hacer</h1>
		<div >
              <hr class="float-left" style="
              content:'';left:1rem;top:4rem;margin:10px auto;width:25%;height:3px;background:#ed1a38">
            </div><br>
                <p ALIGN="justify">A continuaciÃ³n se muestran algunas actividades que se puedes realizar en el Municipio de Lerma, te fascinarÃ¡..</p>
              </div>
            </div>


          </div>
        </div>
    </section>
    <!--footer-->


	</div>
	</div>
  <script>
  const hacerpeticion = async  () => {
      const peticion = await fetch('https://visita.lerma.gob.mx/api/quehacer')
      const data = await peticion.json();
      var db = new PouchDB('encuestacovid');
      db.put({
        _id: 'mydoc',
        title: data
      }).then(function (response) {
      showTodos(0);
      }).catch(function (err) {
        console.log(err);
      });

      db.get('mydoc').then(function(doc) {
        return db.put({
          _id: 'mydoc',
          _rev: doc._rev,
          title: data
        });
      }).then(function(response) {
         showTodos(0)
      }).catch(function (err) {
        console.log(err);
      });

      db.changes({
      since: 'now',
      live: true
    });

  };

  function  showTodos(id)
      {
         var db = new PouchDB('encuestacovid');
         db.allDocs({include_docs: true, descending: false})

         .then( doc=>{

             const documentos = doc.rows[id].doc;
             console.log(documentos.title.quehacerindex);
             documentos.title.quehacerindex.forEach(item => {
                var subactividades = '<div class="col mb-4"><div class="card shadow"><a href="quehacern3/'+item.nombre+'"><img src="foto_actividades/'+item.foto+'" class="card-img-top imagen" alt="..." height="300px"></a><div class="card-body"><h4 class="card-title">'+item.nombre+'</h4><p class="card-text" ALIGN="justify">'+item.detalle+'...</p></div></div></div>';
                     $('#subactividades').append(subactividades);


             })

         })
      }

  hacerpeticion();

  </script>
@stop

</body>
</html>
