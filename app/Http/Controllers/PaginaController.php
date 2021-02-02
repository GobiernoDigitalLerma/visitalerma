<?php

namespace App\Http\Controllers;

use App\Baner;
use App\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginaController extends Controller
{
  /*=============================================
  =            Metodos para que hacer           =
  =============================================*/
  public function actividades()
  {
    $imgp = DB::SELECT('SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE f.tipo_foto = 1
              AND a.`secciones` = 1
              ORDER BY f.foto DESC
              LIMIT 1');
    $imgs = DB::SELECT("SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`,substring(a.descripcion,1,100) as detalle
            FROM foto_actividades AS f
            INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
            WHERE f.tipo_foto = 2
            AND f.extendida=2
            AND a.secciones = 1
            AND a.activo=1
            ORDER BY a.nombre DESC");
  
    
      /* DB::table('actividades as a')
              ->join('foto_actividades as f', 'f.id_actividad', '=' , 'a.id_actividad')
              ->select(
                'a.id_actividad', 'a.nombre',
                'f.foto',
                DB::row('substring(a.descripcion,1,100)')
                )
              ->where('a.secciones', '=', 1)
              ->where('f.tipo_foto', '=', 2)
              ->groupBy('a.id_actividad')
              ->get(); */
    
    


    return view('pagina.quehacer.nivel2', compact('imgp', 'imgs'));
  }

  public function quehacern3($nombre)
  {

    $actividad = DB::SELECT("SELECT a.descripcion,a.`id_actividad` AS id ,a.`nombre`, f.`foto`,a.`secciones`,f.`tipo_foto`,f.extendida
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 1 AND nombre ='$nombre' AND f.`extendida`=1
              ORDER BY f.foto DESC");

    if (empty($actividad)) {
      $actividad = DB::SELECT("SELECT a.descripcion,a.`id_actividad` AS id ,a.`nombre`, f.`foto`,a.`secciones`,f.`tipo_foto`,f.extendida
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 1 AND nombre ='$nombre' AND f.`extendida`=2
              ORDER BY f.foto DESC");
    }


    $act_quehacer = DB::SELECT("SELECT a.`nombre`,f.`extendida`
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 1 AND f.`extendida`=1
              ORDER BY f.foto DESC
                 ");

    $resena = DB::Select("SELECT r.id_actividad,r.nombre,r.detalle,r.activo
    					FROM resena_actividades AS r
  						INNER JOIN actividades AS a ON a.`id_actividad` = r.`id_actividad`
       					 WHERE a.`nombre` = '$nombre'
    					AND r.activo = 1");
    //Agregar ubicacion de la actividad.

    $ubicacion=DB::SELECT("SELECT * FROM actividades 
    INNER JOIN ubicacion_actividades ON ubicacion_actividades.id_ubicacion_actividad=actividades.idu
    WHERE actividades.nombre = '$nombre'");

    $fotos=DB::SELECT("SELECT  imagenes FROM actividades 
    WHERE nombre = '$nombre'");
    $foto=$fotos[0]->imagenes;
    $dato=json_decode($foto); 


   if(empty($dato[0]->file)){
    $mg1='null';
	}	
	else{
    $mg1=$dato[0];
	}

    if(empty($dato[1]->file)){
    $mg2='null';
	}	
	else{
    $mg2=$dato[1];
	}
	if(empty($dato[2]->file)){
    $mg3='null';
	}	
	else{
    $mg3=$dato[2];
	}
	 if(empty($dato[3]->file)){
    $mg4='null';

  }	
	else{
    $mg4=$dato[3];
	}
	if(empty($dato[4]->file)){
    $mg5='null';
	}	
	else{
    $mg5=$dato[4];
	}

    $fecha_event=$ubicacion[0]->fecha_inicio;
    setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
    $fecha = strftime("%d de %B de %Y", strtotime($fecha_event));



    $sub_actividad = DB::SELECT("SELECT s.nombre,f.foto,s.descripcion,f.`extendida`
                                   FROM actividades AS a
                                   INNER JOIN sub_actividades AS s ON s.`id_actividad`=a.`id_actividad`
                                   INNER JOIN foto_sub_actividades AS f ON f.`id_sub_actividad`=s.`id_sub_actividad`
                                   WHERE a.`nombre`='$nombre' AND f.`extendida` = 2");


    return view("pagina.quehacer.nivel3", compact('actividad', 'act_quehacer', 'sub_actividad','resena','ubicacion','fecha','fotos','mg1','mg2','mg2','mg3','mg4','mg5'));
  }

  public function quehacern4($nombre)
  {

    $ubicacion = DB::SELECT("SELECT u.nombre,u.fx,u.fy,s.nombre
                               FROM sub_actividades AS s
                               INNER JOIN ubicacion_actividades AS u ON
                               u.id_ubicacion_actividad = s.id_ubicacion_actividad
                               WHERE s.nombre = '$nombre'");
    
    $resena = DB::SELECT("SELECT r.nombre as autor,r.detalle,s.nombre
                            FROM resena_sub_actividades AS r
                            INNER JOIN sub_actividades AS s ON s.id_sub_actividad =
                            r.id_sub_actividad
                            WHERE s.`nombre` = '$nombre'");


    $sub_actividad = DB::SELECT("SELECT s.`nombre`,s.`descripcion`,a.nombre AS actividad,s.id_sub_actividad as id_subactividad
                                 FROM actividades AS a
                                 INNER JOIN sub_actividades AS s ON s.id_actividad =
                                 a.id_actividad
                                 WHERE s.nombre = '$nombre'");

    $foto_sub = DB::SELECT("SELECT f.foto,s.nombre AS sub_act,f.detalle,s.`fecha`,
                             s.`horario`,s.costo,s.link
                             FROM
                             foto_sub_actividades AS f
                             INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
                             f.id_sub_actividad
                             WHERE s.nombre = '$nombre'");
    $fecha_event = $foto_sub[0]->fecha;
    setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
    $fecha = strftime("%d de %B de %Y", strtotime($fecha_event));

    $act = DB::SELECT("SELECT a.nombre
                               FROM actividades AS a
                               INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                               WHERE s.nombre = '$nombre'");
    $actividad = $act[0]->nombre;
    $interes = DB::SELECT("CALL interesniv4('$actividad')");



    $totalinteres = DB::SELECT("SELECT COUNT(s.nombre) AS totalinteres
                                  FROM actividades AS a
                                  INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                                  INNER JOIN ubicacion_actividades AS u ON
                                  u.id_ubicacion_actividad = s.id_ubicacion_actividad
                                  INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                  WHERE a.nombre = '$actividad' AND f.`extendida` = 2
                                  LIMIT 3;");
    //dd($totalinteres);
    $foto_extendida = DB::SELECT("SELECT s.nombre,f.foto FROM sub_actividades AS s
                                    INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                    WHERE s.`nombre` = '$nombre' AND f.`extendida`=1");
                                    // dd($foto_extendida);
    $promedioCalificacion = DB::SELECT("SELECT FORMAT(AVG(cal.calificacion),1) AS calificacion FROM calificacion_sub_actividades AS cal
      INNER JOIN sub_actividades AS sub ON sub.`id_sub_actividad` = cal.idsa
      WHERE nombre = '$nombre'");

    $video = DB::SELECT("SELECT f.video
    FROM
    foto_sub_actividades AS f
    INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
    f.id_sub_actividad
    WHERE s.nombre = '$nombre'
    ");
    //dd($video);

    return view("pagina.quehacer.nivel4", compact('ubicacion', 'resena', 'sub_actividad', 'foto_sub', 'fecha', 'interes', 'totalinteres', 'foto_extendida', 'promedioCalificacion', 'video'));
  }

  /*=====  End of Metodos para que hacer ======*/

  public function index()
  {
    $images = DB::SELECT("SELECT * FROM baners where activo=1 order by created_at desc");

    $hacer = \DB::table('foto_actividades as f')
                  ->join('actividades as a', 'a.id_actividad', '=', 'f.id_actividad')
                  ->select('a.id_actividad as id', 'a.nombre', 'f.foto',\DB::raw("rand() r"))
                  ->where('f.tipo_foto', '=', 2)
                  ->where('a.secciones', '=', 1)
                  ->orderBY('r')
                  ->limit(4)
                  ->get();
      // dd($hacer);

    $sucede = DB::SELECT(
      'SELECT a.`nombre` , f.foto,  RAND() r
                    FROM foto_actividades AS f
                    INNER JOIN actividades AS a
                    ON a.`id_actividad` = f.`id_actividad`
                    WHERE a.secciones = 2
		    AND f.tipo_foto = 2
/* 		    AND f.extendida = 2 */
                    ORDER BY r DESC'
    );

    $conoce = DB::SELECT('SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`
							FROM foto_actividades AS f
							INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
							AND a.`secciones` = 3
							ORDER BY a.`id_actividad` ASC
							LIMIT 1');

    $festival = DB::SELECT('SELECT a.`id_actividad` as id ,a.`nombre`, f.`foto`, rand() r
                            				FROM foto_actividades AS f
                            				INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
                            				WHERE a.secciones = 4
                            				ORDER BY r DESC
                            				limit 2');
    $artesania = DB::SELECT('SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`
							FROM foto_actividades AS f
							INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
							AND a.`secciones` = 5
							ORDER BY f.foto DESC
							LIMIT 1');


    $actividades = DB::SELECT('SELECT a.`id_actividad` as id ,a.`nombre`, f.`foto`, rand() r
							FROM actividades AS a
							INNER JOIN foto_actividades AS f ON a.id_actividad=f.id_actividad
							WHERE a.secciones= 6
							AND f.tipo_foto=1
							ORDER BY r DESC
              LIMIT 2');
    return view('pagina.index', compact('images', 'hacer', 'sucede', 'conoce', 'festival', 'artesania', 'actividades'));
  }
  /*========== Funcion para vista del cuerto nivel ===========*/
  public function cuartoNivel()
  {

    $imagenPrincipal =  DB::table("foto_sub_actividades")
      ->join("sub_actividades", "sub_actividades.id_sub_actividad", "=", "foto_sub_actividades.id_sub_actividad")
      ->select(
        "foto_sub_actividades.foto",
        "sub_actividades.nombre",
        "sub_actividades.descripcion"
      )
      ->where([
        ["sub_actividades.id_sub_actividad", "=", 60],
        ["foto_sub_actividades.tipo_foto", "=", "1"]
      ])
      ->take(1)
      ->get();

    $imagenSecundaria = DB::table("foto_sub_actividades")
      ->join("sub_actividades", "sub_actividades.id_sub_actividad", "=", "foto_sub_actividades.id_sub_actividad")
      ->select(
        "foto_sub_actividades.foto",
        "sub_actividades.nombre",
        "foto_sub_actividades.detalle"
      )
      ->where([
        ["sub_actividades.id_sub_actividad", "=", 61],
        ["foto_sub_actividades.tipo_foto", "=", "2"]
      ])
      ->get();

    $ubicacions = DB::table("sub_actividades")
      ->join("ubicacion_actividades", "ubicacion_actividades.id_ubicacion_actividad", "=", "sub_actividades.id_ubicacion_actividad")
      ->select(
        "ubicacion_actividades.nombre",
        "ubicacion_actividades.fx",
        "ubicacion_actividades.fy"
      )
      ->where("sub_actividades.id_sub_actividad", "=", 58)
      ->get();

    $resenas = DB::table("resena_sub_actividades")
      ->join("sub_actividades", "sub_actividades.id_sub_actividad", "=", "resena_sub_actividades.id_sub_actividad")
      ->select(
        "resena_sub_actividades.nombre",
        "resena_sub_actividades.detalle"
      )
      ->where("sub_actividades.id_sub_actividad", "=", 58)
      ->get();


    $actividadesmas =  DB::table("sub_actividades")
      ->leftJoin("foto_sub_actividades", "foto_sub_actividades.id_sub_actividad", "=", "sub_actividades.id_sub_actividad")
      ->leftJoin("resena_sub_actividades", "resena_sub_actividades.id_sub_actividad", "=", "sub_actividades.id_sub_actividad")
      ->select(
        "sub_actividades.id_sub_actividad",
        "sub_actividades.nombre"
      )
      ->whereNotNull(['foto_sub_actividades.foto', "resena_sub_actividades.nombre"])
      ->where("sub_actividades.activo", "=", "1")
      ->groupBy('sub_actividades.id_sub_actividad')
      ->inRandomOrder()->take(4)->get();


    return view('pagina.nev', compact('imagenPrincipal', 'imagenSecundaria', 'actividadesmas', 'resenas', 'ubicacions'));
  }


  /*=====  End of Metodos para que sucede ======*/


  // Festival & Cultura
  /*
       ````.`...`--oo+dy+hdd:/dmdy/.````````
    ````.`...--:yhoNhydNm/smNmmy:...``````````
   `````...-./::mmsmysyhh/smNNNmy-....`````````
   `````..--./:/md/:+ydddoyyssshds--......```````
  ````.`...++sso+:sNNNmdhoymMMh/dmo/-..:...```````
  ````.....yNNd:/mMMdo++++++odMyoNm++-.::...``````
  ````...-.oMN/+NMMy++++++++++mMhsMdo+-:+-...`.```
  ````.:..-:Nd+sMMNyso++hm++++yNMNNMhh///s-`..`.``
  ````.::.--yNm+mMMy+++++++++/hNMNNMNdh:ooy-`....`
   `` `.o-.--mNNdmMMy++syyo++hNNMMMMMNmhohhh/.....
   `` ``+/..-:mNNNNMMNdhyyhdmNMMMMMMNmmddmmmdhs::.
   `` ``/o/---/NMMmmNmdmmmmmmNMMMNNmmmNNMMMMMNmmho
    ` ``-oo//:-/NMMNNmdmmmmNNMNNNNNMMMMMMMMMMMMNMm
    `  ``+sso++-/mMMMMMMMMMMMMMMMMMMMMMMMMMMMMMdNM
    `  ``/oohssh+/dMMMMMMMMMMMMMMMMMMMMMMMMMMMM+dm
       ``-+osdhhddosNMMMMMMMMMMMMMMMMMMMMMMMMMm+hh
    `   `.+ooymmmNNNdmNMMMMMMMMMMMMMMMMMMMMMMMNNmN
    `   ``/+oodmNNNMMMMNMMMMMMMMMMMMMMMMMMMMMMMMMM
    ``    :syssmmNNNMMmmNmmNMMMMMMMMMMMMMMMMMMMMMM
     `   ``::/:ymmNNNMMMMMmyshmNNMMMMMMMMNNMMMMMMM
         ` ```.:ydmNNNMMMMMMMMNNNNMMMMMMMMMMMMMMMM
         ` ```..-sddmNNNMMMMMMMMMMMMMMMMMMMMMMMMMM
          ` ````../shdmmNNNMMMMMMMMMMMMMMMMMMMMMMM
          `  ``````.:oyddmmNNNNMMMMMMMMMMMMMMMMMMM
             `````````-/oyhdmmmNNNNNMMMMMMMMNNNNNM
               `  ```````.:+syhddmmmNNNNNNNMMMMMMM
                     `````.--:/+syhhddmmmmNNNNNNNN
                          `....---:+oyyhhdddmmmmNN
    */
  public function festival()
  {
    $imgp = DB::SELECT('SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE f.tipo_foto = 1
              AND a.`secciones` = 4
              ORDER BY f.foto DESC
              LIMIT 1');

    $imgs = DB::SELECT('SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`,SUBSTR(a.descripcion,1,100) as detalle, RAND() r
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE f.tipo_foto = 2
              AND a.secciones = 4
              ORDER BY r DESC');

    return view('pagina.festivalYCultura.nivel-dos', compact('imgp', 'imgs'));
  }

  public function festival3($nombre)
  {

    $actividad = DB::SELECT("SELECT a.descripcion,a.`id_actividad` AS id ,a.`nombre`, f.`foto`,a.`secciones`,f.`tipo_foto`,f.extendida
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 4 AND nombre ='$nombre' AND f.`extendida`=1
              ORDER BY f.foto DESC");
    //return $actividad;
    if (empty($actividad)) {
      $actividad = DB::SELECT("SELECT a.descripcion,a.id_actividad AS id ,a.nombre, f.foto,a.secciones,f.tipo_foto,f.extendida
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 4 AND nombre ='$nombre' AND f.`extendida`=2
              ORDER BY f.foto DESC");
    }


    $act_festival = DB::SELECT("SELECT a.`nombre`,f.`extendida`
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 4 AND f.`extendida`=1
              ORDER BY f.foto DESC
                 ");

    $resena = DB::Select("SELECT r.id_actividad,r.nombre,r.detalle,r.activo
    					FROM resena_actividades AS r
  						INNER JOIN actividades AS a ON a.`id_actividad` = r.`id_actividad`
       					 WHERE a.`nombre` = '$nombre'
    					AND r.activo = 1");

    $sub_actividad = DB::SELECT("SELECT s.nombre,f.foto,s.descripcion,f.`extendida`
                                   FROM actividades AS a
                                   INNER JOIN sub_actividades AS s ON s.`id_actividad`=a.`id_actividad`
                                   INNER JOIN foto_sub_actividades AS f ON f.`id_sub_actividad`=s.`id_sub_actividad`
                                   WHERE a.`nombre`='$nombre' AND f.`extendida` = 2");

    //return $sub_actividad;

    return view("pagina.festivalYCultura.nivel-tres", compact('actividad', 'act_festival', 'sub_actividad','resena'));
  }

  public function festival4($nombre)
  {

    $ubicacion = DB::SELECT("SELECT u.nombre,u.fx,u.fy,s.nombre
                               FROM sub_actividades AS s
                               INNER JOIN ubicacion_actividades AS u ON
                               u.id_ubicacion_actividad = s.id_ubicacion_actividad
                               WHERE s.nombre = '$nombre'");

    $resena = DB::SELECT("SELECT r.nombre as autor,r.detalle,s.nombre
                            FROM resena_sub_actividades AS r
                            INNER JOIN sub_actividades AS s ON s.id_sub_actividad =
                            r.id_sub_actividad
                            WHERE s.`nombre` = '$nombre'");


    $sub_actividad = DB::SELECT("SELECT s.`nombre`,s.`descripcion`,a.nombre AS actividad,s.id_sub_actividad as id_subactividad
                                 FROM actividades AS a
                                 INNER JOIN sub_actividades AS s ON s.id_actividad =
                                 a.id_actividad
                                 WHERE s.nombre = '$nombre'");

    $foto_sub = DB::SELECT("SELECT f.foto,f.video,s.nombre AS sub_act,f.detalle,s.`fecha`,
                             s.`horario`,s.costo,s.link
                             FROM
                             foto_sub_actividades AS f
                             INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
                             f.id_sub_actividad
                             WHERE s.nombre = '$nombre'");

    $video = DB::SELECT("SELECT f.video
                             FROM
                             foto_sub_actividades AS f
                             INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
                             f.id_sub_actividad
                             WHERE s.nombre = '$nombre'
			     ");
    //return $video;


    $fecha_event = $foto_sub[0]->fecha;
    setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
    $fecha = strftime("%d de %B de %Y", strtotime($fecha_event));

    $fest = DB::SELECT("SELECT a.nombre
                               FROM actividades AS a
                               INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                               WHERE s.nombre = '$nombre'");
    $festival = $fest[0]->nombre;

    $interes = DB::SELECT("CALL interesniv4('$festival')");

    $totalinteres = DB::SELECT("SELECT COUNT(s.nombre) AS totalinteres
                                  FROM actividades AS a
                                  INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                                  INNER JOIN ubicacion_actividades AS u ON
                                  u.id_ubicacion_actividad = s.id_ubicacion_actividad
                                  INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                  WHERE a.nombre = '$festival' AND f.`extendida` = 2
                                  LIMIT 3;");
    //return $totalinteres;

    $foto_extendida = DB::SELECT("SELECT s.nombre,f.foto FROM sub_actividades AS s
                                    INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                    WHERE s.`nombre` = '$nombre' AND f.`extendida`=1");

    $promedioCalificacion = DB::SELECT("SELECT FORMAT(AVG(cal.calificacion),1) AS calificacion FROM calificacion_sub_actividades AS cal
      INNER JOIN sub_actividades AS sub ON sub.`id_sub_actividad` = cal.idsa
      WHERE nombre = '$nombre'");


    return view("pagina.festivalYCultura.nivel-cuatro", compact('ubicacion', 'resena', 'sub_actividad', 'foto_sub', 'fecha', 'interes', 'totalinteres', 'foto_extendida', 'promedioCalificacion', 'video'));
  }

  // Festival & Cultura

  /*===============================  Metodo de seccion actividades =================================*/
  public function index_actividades()
  {

    //
    $actividades = DB::SELECT("SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`,substring(a.descripcion,1,100) as descripcion
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE f.tipo_foto = 2
              AND f.extendida=2
              AND a.secciones = 6
              AND a.activo=1
              ORDER BY a.nombre DESC");


    return view('pagina.actividades.actividades')->with('actividades', $actividades);
  }

  public function abrir($nombre)
  {

    $actividad = DB::SELECT("SELECT a.descripcion,a.`id_actividad` AS id ,a.`nombre`, f.`foto`,a.`secciones`,f.`tipo_foto`,f.extendida
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 6 AND nombre ='$nombre' AND f.`extendida`=1 AND f.tipo_foto=1
              ORDER BY f.foto DESC");

    if (empty($actividad)) {
      $actividad = DB::SELECT("SELECT a.descripcion,a.`id_actividad` AS id ,a.`nombre`, f.`foto`,a.`secciones`,f.`tipo_foto`,f.extendida
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 6 AND nombre ='$nombre' AND f.`extendida`=2
              ORDER BY f.foto DESC");
    }

    $act3 = DB::SELECT("SELECT a.`nombre`,f.`extendida`
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 6 AND f.`extendida`=1
              ORDER BY f.foto DESC
                 ");
	$resena = DB::Select("SELECT r.id_actividad,r.nombre,r.detalle,r.activo
    					FROM resena_actividades AS r
  						INNER JOIN actividades AS a ON a.`id_actividad` = r.`id_actividad`
       					 WHERE a.`nombre` = '$nombre'
    					AND r.activo = 1");

    $sub_actividad3 = DB::SELECT("SELECT s.nombre,f.foto,s.descripcion,f.`extendida`
                                   FROM actividades AS a
                                   INNER JOIN sub_actividades AS s ON s.`id_actividad`=a.`id_actividad`
                                   INNER JOIN foto_sub_actividades AS f ON f.`id_sub_actividad`=s.`id_sub_actividad`
                                   WHERE a.`nombre`='$nombre' AND f.`extendida` = 2 and f.tipo_foto=2 and s.activo=1 and f.video IS NULL");

    return view("pagina.actividades.actividades3", compact('actividad', 'act3', 'sub_actividad3','resena'));
  }

  public function index_actividades4($nombre)
  {

    $ubicacion = DB::SELECT("SELECT u.nombre,u.fx,u.fy,s.nombre
                               FROM sub_actividades AS s
                               INNER JOIN ubicacion_actividades AS u ON
                               u.id_ubicacion_actividad = s.id_ubicacion_actividad
                               WHERE s.nombre = '$nombre'");

    //dd($ubicacion);
    $resena = DB::SELECT("SELECT r.nombre as autor,r.detalle,s.nombre
                            FROM resena_sub_actividades AS r
                            INNER JOIN sub_actividades AS s ON s.id_sub_actividad =
                            r.id_sub_actividad
                            WHERE s.`nombre` = '$nombre'");


    $sub_actividad = DB::SELECT("SELECT s.`nombre`,s.`descripcion`,a.nombre AS actividad,s.id_sub_actividad as id_subactividad
                                 FROM actividades AS a
                                 INNER JOIN sub_actividades AS s ON s.id_actividad =
                                 a.id_actividad
                                 WHERE s.nombre = '$nombre'");

    $foto_sub = DB::SELECT("SELECT f.foto,s.nombre AS sub_act,f.detalle,s.`fecha`,
                             s.`horario`,s.costo,s.link
                             FROM
                             foto_sub_actividades AS f
                             INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
                             f.id_sub_actividad
                             WHERE s.nombre = '$nombre'");
    $fecha_event = $foto_sub[0]->fecha;
    setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
    $fecha = strftime("%d de %B de %Y", strtotime($fecha_event));

    $act = DB::SELECT("SELECT a.nombre
                               FROM actividades AS a
                               INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                               WHERE s.nombre = '$nombre'");
    $actividad = $act[0]->nombre;
    $interes = DB::SELECT("CALL interesniv4('$actividad')");


    $totalinteres = DB::SELECT("SELECT COUNT(s.nombre) AS totalinteres
                                  FROM actividades AS a
                                  INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                                  INNER JOIN ubicacion_actividades AS u ON
                                  u.id_ubicacion_actividad = s.id_ubicacion_actividad
                                  INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                  WHERE a.nombre = '$actividad' AND f.`extendida` = 2
                                  LIMIT 3;");
    //dd($totalinteres);
    $foto_extendida = DB::SELECT("SELECT s.nombre,f.foto FROM sub_actividades AS s
                                    INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                    WHERE s.`nombre` = '$nombre' AND f.`extendida`=1 and f.tipo_foto=1");
    $promedioCalificacion = DB::SELECT("SELECT FORMAT(AVG(cal.calificacion),1) AS calificacion FROM calificacion_sub_actividades AS cal
      INNER JOIN sub_actividades AS sub ON sub.`id_sub_actividad` = cal.idsa
      WHERE nombre = '$nombre'");

    $video = DB::SELECT("SELECT f.video
    FROM
    foto_sub_actividades AS f
    INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
    f.id_sub_actividad
    WHERE s.nombre = '$nombre' ORDER BY f.video DESC");

    return view("pagina.actividades.actividades4", compact('ubicacion', 'resena', 'sub_actividad', 'foto_sub', 'fecha', 'interes', 'totalinteres', 'foto_extendida', 'promedioCalificacion','video'));
  }
  /*==================================== Fin Metodo Actividades ============================*/
  /*==================================================================================
                                      seccion de conoce_lerma
    =====================================================================================*/
  public function conoce_lerma()
  {
    $imgPrincipal =  DB::SELECT('SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`,SUBSTR(a.descripcion,1,100) as                               detalle, RAND() r
                                    FROM foto_actividades AS f
                                    INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
                                    WHERE f.tipo_foto = 2
                                    AND a.secciones = 3
				                     /*        AND f.extendida = 2 */
                                    ORDER BY r DESC');

    $imgSecundaria = DB::SELECT("SELECT a.`id_actividad`,a.`nombre`,f.`foto`
                                  	FROM actividades AS a
                                  	INNER JOIN foto_actividades AS f ON a.`id_actividad`=f.`id_actividad`
                                  	WHERE a.`secciones`=3
                                  	");

    return view('pagina.ConoceLerma.nivel2', compact('imgPrincipal', 'imgSecundaria'));
  }


  #nivel3-conoce_lerma
  public function conoce_lerma_actividades($nombre)
  {

    $head = DB::SELECT("SELECT a.descripcion,a.`id_actividad` AS id ,a.`nombre`, f.`foto`,a.`secciones`,f.`tipo_foto`,f.extendida,a.imagenes
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 3
              AND nombre ='$nombre'
              AND f.`extendida`=1
              ORDER BY f.foto DESC
		LIMIT 1");

    $act = DB::SELECT("SELECT a.`nombre`,f.`extendida`
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 3 AND f.`extendida`=1
              ORDER BY f.foto DESC");


    $table =  DB::SELECT("SELECT a.`nombre`
                                    FROM foto_actividades AS f
                                    INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
                                    WHERE f.tipo_foto = 1
                                    AND a.secciones = 3
				    AND f.extendida = 1");
  $descripcion = DB::SELECT("select a.fecha_inicio,a.fecha_fin_actividad,a.horario_detalle
                                from actividades as a
                                  where a.nombre = '$nombre'");
                                  
 $ubicacion = DB::SELECT("SELECT u.nombre,u.fx,u.fy,s.nombre
                               FROM sub_actividades AS s
                               INNER JOIN ubicacion_actividades AS u ON
                               u.id_ubicacion_actividad = s.id_ubicacion_actividad
                               WHERE s.nombre = '$nombre'");

    $resena = DB::Select("SELECT r.id_actividad,r.nombre,r.detalle,r.activo
    					FROM resena_actividades AS r
  						INNER JOIN actividades AS a ON a.`id_actividad` = r.`id_actividad`
       					 WHERE a.`nombre` = '$nombre'
    					AND r.activo = 1");

    $actividades = DB::SELECT("SELECT s.nombre,f.foto,s.descripcion,f.`extendida`
                                   FROM actividades AS a
                                   INNER JOIN sub_actividades AS s ON s.`id_actividad`=a.`id_actividad`
                                   INNER JOIN foto_sub_actividades AS f ON f.`id_sub_actividad`=s.`id_sub_actividad`
                                   WHERE a.`nombre`='$nombre' AND f.`extendida` = 2");
      
      $ubicacion = DB::SELECT("SELECT u.nombre,u.fx,u.fy,a.nombre
                               FROM actividades AS a
                               INNER JOIN ubicacion_actividades AS u ON
                               u.id_ubicacion_actividad = a.idu
                               WHERE a.nombre = '$nombre'");

    //return $head[0]->imagenes;
                            
    return view('pagina.ConoceLerma.nivel3', compact('head', 'act', 'table', 'actividades','resena','descripcion','ubicacion'));
  }
  #nivel3-conoce_lerma

  #nivel 4
  public function conoce_lerma_subactividad($nombre)
  {

    $ubicacion = DB::SELECT("SELECT u.nombre,u.fx,u.fy,s.nombre
                               FROM sub_actividades AS s
                               INNER JOIN ubicacion_actividades AS u ON
                               u.id_ubicacion_actividad = s.id_ubicacion_actividad
                               WHERE s.nombre = '$nombre'");

    //dd($ubicacion);
    $resena = DB::SELECT("SELECT r.nombre as autor,r.detalle,s.nombre
                            FROM resena_sub_actividades AS r
                            INNER JOIN sub_actividades AS s ON s.id_sub_actividad =
                            r.id_sub_actividad
                            WHERE s.`nombre` = '$nombre'");


    $sub_actividad = DB::SELECT("SELECT s.`nombre`,s.`descripcion`,a.nombre AS actividad,s.id_sub_actividad as id_subactividad
                                 FROM actividades AS a
                                 INNER JOIN sub_actividades AS s ON s.id_actividad =
                                 a.id_actividad
                                 WHERE s.nombre = '$nombre'");

    $foto_sub = DB::SELECT("SELECT f.foto,s.nombre AS sub_act,f.detalle,s.`fecha`,
                             s.`horario`,s.costo,f.`video`,s.link
                             FROM
                             foto_sub_actividades AS f
                             INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
                             f.id_sub_actividad
                             WHERE s.nombre = '$nombre'");
    $fecha_event = $foto_sub[0]->fecha;
    setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
    $fecha = strftime("%d de %B de %Y", strtotime($fecha_event));

    $act = DB::SELECT("SELECT a.nombre
                               FROM actividades AS a
                               INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                               WHERE s.nombre = '$nombre'");
    $actividad = $act[0]->nombre;
    $interes = DB::SELECT("CALL interesniv4('$actividad')");

    $foto_extendida = DB::SELECT("SELECT s.nombre,f.foto FROM sub_actividades AS s
                                    INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                    WHERE s.`nombre` = '$nombre' AND f.`extendida`=1");
    $promedioCalificacion = DB::SELECT("SELECT FORMAT(AVG(cal.calificacion),1) AS calificacion FROM calificacion_sub_actividades AS cal
      INNER JOIN sub_actividades AS sub ON sub.`id_sub_actividad` = cal.idsa
      WHERE nombre = '$nombre'");
    $totalinteres = DB::SELECT("SELECT COUNT(s.nombre) AS totalinteres
                                  FROM actividades AS a
                                  INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                                  INNER JOIN ubicacion_actividades AS u ON
                                  u.id_ubicacion_actividad = s.id_ubicacion_actividad
                                  INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                  WHERE a.nombre = '$actividad' AND f.`extendida` = 2
                                  LIMIT 3;");
$video = DB::SELECT("SELECT f.video
                             FROM
                             foto_sub_actividades AS f
                             INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
                             f.id_sub_actividad
                             WHERE s.nombre = '$nombre'
			     ");


    return view("pagina.ConoceLerma.nivel4", compact('totalinteres', 'video','promedioCalificacion', 'ubicacion', 'resena', 'sub_actividad', 'foto_sub', 'fecha', 'interes', 'foto_extendida'));
  }


  /*================================================================================================
                                        Fin de conoce lerma
==================================================================================================*/

  public function banner($nombre)
  {

    $seccionBanner = DB::Select("SELECT b.nombre,a.secciones,a.`id_actividad`,a.`nombre` AS actividad FROM banners AS b
  INNER JOIN actividades AS a ON a.`id_actividad` = b.`id_actividad`
  WHERE b.`nombre` = '$nombre' AND b.activo = 1 ");


    if (empty($seccionBanner)) {
      return redirect()->route('pagina.index');
    }
    if ($seccionBanner[0]->secciones == 1) {
      return redirect()->route('quehacern3', $seccionBanner[0]->actividad);
    }
    if ($seccionBanner[0]->secciones == 2) {
      return redirect()->route('pagina.queSucedeNivel3', $seccionBanner[0]->actividad);
    }
    if ($seccionBanner[0]->secciones == 3) {
      return redirect()->route('conoce_lerma_actividades', $seccionBanner[0]->actividad);
    }
    if ($seccionBanner[0]->secciones == 4) {
      return redirect()->route('festival.actividades', $seccionBanner[0]->actividad);
    }
    /* 		if ($seccionBanner[0]->secciones == 5) {
			return "redirect()->route('artesanias');"
		}	 */
    if ($seccionBanner[0]->secciones == 6) {
      return redirect()->route('abrir', $seccionBanner[0]->actividad);
    }
  }


  public function queSucede()
  {
    /* Codigo antes del que se metio */



    $imgs = DB::SELECT('SELECT a.`id_actividad` AS id ,a.`nombre`, f.`foto`,SUBSTR(a.descripcion,1,100) as detalle, RAND() r
    FROM foto_actividades AS f
    INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
    WHERE f.tipo_foto = 2
    AND a.secciones = 2
    ORDER BY r DESC');

    return view('pagina.queSucede.queSucede', compact('imgs', 'imgp'));
  }
  public function queSucedeNivel3($nombre)
  {

    $actividad = DB::SELECT("SELECT a.descripcion,a.`id_actividad` AS id ,a.`nombre`, f.`foto`,a.`secciones`,f.`tipo_foto`,f.extendida
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 2 AND nombre ='$nombre' AND f.`extendida`=1
              ORDER BY f.foto DESC");

    $act_queSucede = DB::SELECT("SELECT a.`nombre`,f.`extendida`
              FROM foto_actividades AS f
              INNER JOIN actividades AS a ON a.`id_actividad` = f.`id_actividad`
              WHERE a.secciones = 2 AND f.`extendida`=1
              ORDER BY f.foto DESC
                 ");
    $resena = DB::Select("SELECT r.id_actividad,r.nombre,r.detalle,r.activo
    					FROM resena_actividades AS r
  						INNER JOIN actividades AS a ON a.`id_actividad` = r.`id_actividad`
       					 WHERE a.`nombre` = '$nombre'
    					AND r.activo = 1");

    $sub_actividad = DB::SELECT("SELECT s.nombre,f.foto,s.descripcion,f.`extendida`
                                   FROM actividades AS a
                                   INNER JOIN sub_actividades AS s ON s.`id_actividad`=a.`id_actividad`
                                   INNER JOIN foto_sub_actividades AS f ON f.`id_sub_actividad`=s.`id_sub_actividad`
                                   WHERE a.`nombre`='$nombre'
				   AND f.`extendida` = 2
                                   AND f.tipo_foto = 2");


    /* return "hola"; */
    return view("pagina.queSucede.queSucedeNivel3", compact('actividad', 'act_queSucede', 'sub_actividad','resena'));
  }


  public function queSucedeNivel4($nombre)
  {
    $ubicacion = DB::SELECT("SELECT u.nombre,u.fx,u.fy,s.nombre
                               FROM sub_actividades AS s
                               INNER JOIN ubicacion_actividades AS u ON
                               u.id_ubicacion_actividad = s.id_ubicacion_actividad
                               WHERE s.nombre = '$nombre'");

    //dd($ubicacion);
    $resena = DB::SELECT("SELECT r.nombre as autor,r.detalle,s.nombre
                            FROM resena_sub_actividades AS r
                            INNER JOIN sub_actividades AS s ON s.id_sub_actividad =
                            r.id_sub_actividad
                            WHERE s.`nombre` = '$nombre'");


    $sub_actividad = DB::SELECT("SELECT s.`nombre`,s.`descripcion`,a.nombre AS actividad,s.id_sub_actividad as id_subactividad
      FROM actividades AS a
      INNER JOIN sub_actividades AS s ON s.id_actividad =
      a.id_actividad
      WHERE s.nombre = '$nombre'");

    $foto_sub = DB::SELECT("SELECT f.foto,s.nombre AS sub_act,f.detalle,s.`fecha`,
                             s.`horario`,s.costo,s.link
                             FROM
                             foto_sub_actividades AS f
                             INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
                             f.id_sub_actividad
                             WHERE s.nombre = '$nombre'");
    $fecha_event = $foto_sub[0]->fecha;
    setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
    $fecha = strftime("%d de %B de %Y", strtotime($fecha_event));

    $act = DB::SELECT("SELECT a.nombre
                               FROM actividades AS a
                               INNER JOIN sub_actividades AS s ON s.id_actividad = a.id_actividad
                               WHERE s.nombre = '$nombre'");
    $actividad = $act[0]->nombre;
    $interes = DB::SELECT("CALL interesniv4('$actividad')");

    $foto_extendida = DB::SELECT("SELECT s.nombre,f.foto FROM sub_actividades AS s
                                    INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.id_sub_actividad
                                    WHERE s.`nombre` = '$nombre' AND f.`extendida`=1");

    $promedioCalificacion = DB::SELECT("SELECT FORMAT(AVG(cal.calificacion),1) AS calificacion FROM calificacion_sub_actividades AS cal
      INNER JOIN sub_actividades AS sub ON sub.`id_sub_actividad` = cal.idsa
      WHERE nombre = '$nombre'");

    $video = DB::SELECT("SELECT f.video
    FROM
    foto_sub_actividades AS f
    INNER JOIN sub_actividades AS s ON s.id_sub_actividad=
    f.id_sub_actividad
    WHERE s.nombre = '$nombre'
    ");
    //dd($video);

    return view("pagina.queSucede.queSucedeNivel4", compact('ubicacion', 'resena', 'sub_actividad', 'foto_sub', 'fecha', 'interes', 'foto_extendida', 'promedioCalificacion','video'));
  }
}
