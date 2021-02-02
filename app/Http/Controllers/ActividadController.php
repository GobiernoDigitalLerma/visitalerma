<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\TipoActividad;
use App\Usuario;
use Illuminate\Http\Request;
use DB;
use Session;

class ActividadController extends Controller
{
    public function alta_actividad(Request $request)
    {   
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	    $id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();
        $u=DB::SELECT("SELECT * FROM ubicacion_actividades WHERE activo=1 ORDER BY nombre ASC");
        $tipo=DB::SELECT("SELECT * FROM tipo_actividades WHERE activo=1 ORDER BY nombre ASC");
        return view('Actividad.alta_actividad',compact('imguser','u','id_tipo_usuario'))->with('tipo',$tipo);
    }

    public function guardar_actividad(Request $request)
    {

        if ($request->secciones != 1 && $request->secciones != 3) {

            $a                      =   New Actividad();
            $a->nombre              =   $request->nombre;
            $a->descripcion         =   $request->descripcion;
            $a->artista             =   $request->artista;
            $a->fecha_inicio        =   $request->fechaini;
            $a->fecha_fin_actividad =   $request->fechafin;
            $a->horario_detalle     =   $request->horario;
            $a->id_tipo_actividad   =   $request->tipo;
            $a->idu                 =   $request->ubi;
            $a->secciones           =   $request->secciones;
            $a->region              =   $request->region;
            $a->imagenes            =   null;
            $a->save();

            Session::flash('message','Registro Guardado Correctamente');

            return redirect('actividad');

        }else{

            $data = array();

            if($request->hasFile('filenameA')){ 

                $fileA  = $request->file("filenameA");
                $nameA  = str_replace(' ', '-',$fileA->getClientOriginalName());
                $fileA->move(public_path("foto_actividades"),$nameA);

                array_push($data,array("position"=>"A","title"=>$request->tituloA,"description"=>$request->detalleA,
                                       "file"=>$nameA));

            }else{

                array_push($data,array("position"=>"A","title"=>$request->tituloA,"description"=>$request->detalleA,
                                       "file"=>null));


            }

            if($request->hasFile('filenameB')){ 

                $fileB  = $request->file("filenameB");
                $nameB  = str_replace(' ', '-',$fileB->getClientOriginalName());
                $fileB->move(public_path("foto_actividades"),$nameB);

                array_push($data,array("position"=>"B","title"=>$request->tituloB,"description"=>$request->detalleB,
                                       "file"=>$nameB));

            }else{

                array_push($data,array("position"=>"B","title"=>$request->tituloB,"description"=>$request->detalleB,
                                       "file"=>null));

            }

            if($request->hasFile('filenameC')){ 

                $fileC  = $request->file("filenameC");
                $nameC  = str_replace(' ', '-',$fileC->getClientOriginalName());
                $fileC->move(public_path("foto_actividades"),$nameC);

                array_push($data,array("position"=>"C","title"=>$request->tituloC,"description"=>$request->detalleC,
                                       "file"=>$nameC));

            }else{

                array_push($data,array("position"=>"C","title"=>$request->tituloC,"description"=>$request->detalleC,
                                       "file"=>null));

            }


            if($request->hasFile('filenameD')){ 

                $fileD  = $request->file("filenameD");
                $nameD  = str_replace(' ', '-',$fileD->getClientOriginalName());
                $fileD->move(public_path("foto_actividades"),$nameD);

                array_push($data,array("position"=>"D","title"=>$request->tituloD,"description"=>$request->detalleD,
                                       "file"=>$nameD));

            }else{

                array_push($data,array("position"=>"D","title"=>$request->tituloD,"description"=>$request->detalleD,
                                       "file"=>null));

            }

            if($request->hasFile('filenameE')){ 

                $fileE  = $request->file("filenameE");
                $nameE  =str_replace(' ', '-',$fileE->getClientOriginalName());
                $fileE->move(public_path("foto_actividades"),$nameE);

                array_push($data,array("position"=>"E","title"=>$request->tituloE,"description"=>$request->detalleE,
                                       "file"=>$nameE));

            }else{

                array_push($data,array("position"=>"E","title"=>$request->tituloE,"description"=>$request->detalleE,
                                       "file"=>null));

            }

            $a                      =   New Actividad();
            $a->nombre              =   $request->nombre;
            $a->descripcion         =   $request->descripcion;
            $a->artista             =   $request->artista;
            $a->fecha_inicio        =   $request->fechaini;
            $a->fecha_fin_actividad =   $request->fechafin;
            $a->horario_detalle     =   $request->horario;
            $a->id_tipo_actividad   =   $request->tipo;
            $a->idu                 =   $request->ubi;
            $a->secciones           =   $request->secciones;
            $a->region              =   $request->region;
            $a->imagenes            =   json_encode($data);
            $a->save();

            Session::flash('message','Registro Guardado Correctamente');

            return redirect('actividad');

        }
    }

    public function actividad()
    {
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $a=DB::SELECT("SELECT u.nombre as idu, a.id_actividad,a.fecha_inicio,a.nombre,substr(a.descripcion,1,100) as descripcion,a.artista,a.horario_detalle,a.fecha_fin_actividad,t.nombre as tipo,a.secciones,a.activo FROM actividades AS a INNER JOIN tipo_actividades AS t ON t.id_tipo_actividad=a.id_tipo_actividad 
            inner join ubicacion_actividades as u on u.id_ubicacion_actividad = a.idu");

        return view('Actividad.reporte_actividad',compact('imguser','id_tipo_usuario'))->with('a',$a);
    }

    public function modificar_actividad($ida)
    {
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $u=DB::SELECT("SELECT * FROM ubicacion_actividades WHERE activo=1 ORDER BY nombre ASC");
        $a=DB::SELECT("SELECT * FROM actividades WHERE id_actividad=$ida");
        $tipo=DB::SELECT("SELECT * FROM tipo_actividades WHERE activo=1 ORDER BY nombre ASC");
        return view('Actividad.modificar_actividad',compact('imguser','u','id_tipo_usuario'))->with('a',$a[0])
                                                    ->with('tipo',$tipo);
    }

    public function guardar_modificacion_actividad(Request $request)
    {
        if ($request->secciones != 1 && $request->secciones != 3) {

            $a                      =   Actividad::find($request->ida);
            $a->nombre              =   $request->nombre;
            $a->descripcion         =   $request->descripcion;
            $a->artista             =   $request->artista;
            $a->fecha_inicio        =   $request->fechaini;
            $a->fecha_fin_actividad =   $request->fechafin;
            $a->horario_detalle     =   $request->horario;
            $a->id_tipo_actividad   =   $request->tipo;
            $a->idu                 =   $request->ubi;
            $a->secciones           =   $request->secciones;
            $a->region              =   $request->region;
            $a->imagenes            =   null;
            $a->save();

            Session::flash('message','Registro Guardado Correctamente');

            return redirect('actividad');

        }else{

            $data = array();

            if($request->hasFile('filenameA')){ 

                $fileA  = $request->file("filenameA");
                $nameA  = str_replace(' ', '-',$fileA->getClientOriginalName());
                $fileA->move(public_path("foto_actividades"),$nameA);

                array_push($data,array("position"=>"A","title"=>$request->tituloA,"description"=>$request->detalleA,
                                       "file"=>$nameA));

            }else{

                array_push($data,array("position"=>"A","title"=>$request->tituloA,"description"=>$request->detalleA,
                                       "file"=>$request->originalNameA));


            }

            if($request->hasFile('filenameB')){ 

                $fileB  = $request->file("filenameB");
                $nameB  = str_replace(' ', '-',$fileB->getClientOriginalName());
                $fileB->move(public_path("foto_actividades"),$nameB);

                array_push($data,array("position"=>"B","title"=>$request->tituloB,"description"=>$request->detalleB,
                                       "file"=>$nameB));

            }else{

                array_push($data,array("position"=>"B","title"=>$request->tituloB,"description"=>$request->detalleB,
                                       "file"=>$request->originalNameB));

            }

            if($request->hasFile('filenameC')){ 

                $fileC  = $request->file("filenameC");
                $nameC  = str_replace(' ', '-',$fileC->getClientOriginalName());
                $fileC->move(public_path("foto_actividades"),$nameC);

                array_push($data,array("position"=>"C","title"=>$request->tituloC,"description"=>$request->detalleC,
                                       "file"=>$nameC));

            }else{

                array_push($data,array("position"=>"C","title"=>$request->tituloC,"description"=>$request->detalleC,
                                       "file"=>$request->originalNameC));

            }


            if($request->hasFile('filenameD')){ 

                $fileD  = $request->file("filenameD");
                $nameD  = str_replace(' ', '-',$fileD->getClientOriginalName());
                $fileD->move(public_path("foto_actividades"),$nameD);

                array_push($data,array("position"=>"D","title"=>$request->tituloD,"description"=>$request->detalleD,
                                       "file"=>$nameD));

            }else{

                array_push($data,array("position"=>"D","title"=>$request->tituloD,"description"=>$request->detalleD,
                                       "file"=>$request->originalNameD));

            }

            if($request->hasFile('filenameE')){ 

                $fileE  = $request->file("filenameE");
                $nameE  = str_replace(' ', '-',$fileE->getClientOriginalName());
                $fileE->move(public_path("foto_actividades"),$nameE);

                array_push($data,array("position"=>"E","title"=>$request->tituloE,"description"=>$request->detalleE,
                                       "file"=>$nameE));

            }else{

                array_push($data,array("position"=>"E","title"=>$request->tituloE,"description"=>$request->detalleE,
                                       "file"=>$request->originalNameE));

            }

            $a                          =   Actividad::find($request->ida);
            $a->nombre                  =   $request->nombre;
            $a->descripcion             =   $request->descripcion;
            $a->artista                 =   $request->artista;
            $a->fecha_inicio            =   $request->fechaini; 
            $a->fecha_fin_actividad     =   $request->fechafin;
            $a->horario_detalle         =   $request->horario;
            $a->id_tipo_actividad       =   $request->tipo;
            $a->idu                     =   $request->ubi;
            $a->secciones               =   $request->secciones;
            $a->region                  =   $request->region;
            $a->imagenes                =   json_encode($data);
            $a->save();


            Session::flash('message','Registro Guardado Correctamente');

            return redirect('actividad');

        }
    }

    public function destroy($id, Request $request)
    {
        
        if ( $request->ajax() ) {
              DB::SELECT("DELETE FROM baners WHERE id_actividad=$id");
              DB::SELECT("DELETE FROM foto_actividades WHERE id_actividad=$id");
              DB::SELECT("DELETE FROM resena_actividades WHERE id_actividad=$id");
              DB::SELECT("DELETE FROM calificacion_actividades WHERE ida=$id");

              $idas=DB::SELECT("SELECT id_sub_actividad FROM sub_actividades WHERE id_actividad=$id");
              foreach ($idas as $idas) {
                $ida=$idas->id_sub_actividad;
                  DB::SELECT("DELETE  FROM resena_sub_actividades WHERE id_sub_actividad=$ida");
                  DB::SELECT("DELETE  FROM foto_sub_actividades WHERE id_sub_actividad=$ida");
                  DB::SELECT("DELETE  FROM calificacion_sub_actividades WHERE idsa=$ida");
                  DB::SELECT("DELETE  FROM sub_actividades WHERE id_sub_actividad=$ida");
              }
              
              
              DB::SELECT("DELETE  FROM actividades WHERE id_actividad=$id");



            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }

    public function desactiva($id, Request $request)
    {
        
        if ( $request->ajax() ) {
              DB::SELECT("UPDATE actividades SET activo=0 WHERE id_actividad=$id");

            return response(['msg' => 'Producto Desactivado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }

    public function activa($id, Request $request)
    {
        
        if ( $request->ajax() ) {
              DB::SELECT("UPDATE actividades SET activo=1 WHERE id_actividad=$id");

            return response(['msg' => 'Producto Activado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }
 public function show()
    {
        $act=DB::Select("SELECT  ac.nombre,ac.`artista` ,ac.`descripcion`,ac.`fecha_inicio`
                            ,ac.`fecha_fin_actividad`,ft.foto
                FROM actividades AS ac
                INNER JOIN foto_actividades AS ft ON ft.`id_actividad`=ac.`id_actividad`
                where ac.activo= 1");
        return view('Quesucede.home',compact('act'));
    }

}
