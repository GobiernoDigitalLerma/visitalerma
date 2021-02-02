<?php

namespace App\Http\Controllers;


use App\FotoActividad;
use App\Actividad;
use App\Usuario;
use Illuminate\Http\Request;
use DB;
use Session;
 
class FotoActividadController extends Controller
{


    public function fotos_actividades() {   
    if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $id_foto_actividad=FotoActividad::all();
        $id_actividad =DB::SELECT("SELECT * FROM actividades where activo=1 ORDER BY nombre ASC");
        return view('Fotos_actividades.fotos_actividades',compact('imguser','id_tipo_usuario'))->with('id_foto_actividad',$id_foto_actividad)
                                                          ->with('id_actividad',$id_actividad);
    }
    public function guardar_fotosact(Request $request)

{

        $fot_act = new FotoActividad;
        $fot_act->id_actividad=$request->id_actividad;
        $file = $request->file('foto');  
        $file->move('foto_actividades',$file->getClientOriginalName());

        $fot_act->foto=$file->getClientOriginalName();
        $fot_act->video=$request->video;
        $fot_act->detalle=$request->detalle;
        $fot_act->tipo_foto=$request->tipo_foto;
        $fot_act->extendida=$request->extendida;
        $fot_act->save();

        Session::flash('message','Registro Guardado Correctamente');
        return redirect('reporte');
    }

    public function reporte() {
    if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();
	

        $sql=DB::SELECT("SELECT f.id_foto_actividad,a.`nombre` AS nombre,f.`foto`,f.`video`,f.`detalle`,f.tipo_foto,f.extendida FROM actividades AS a
            INNER JOIN foto_actividades AS f ON f.`id_actividad`=a.`id_actividad` WHERE f.activo = 1");
        return view('Fotos_actividades.report_fotosact',compact('imguser','id_tipo_usuario'))->with('sql',$sql);
    }

    public function mod_fotos_actividades($pera){

        if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

         $fot=FotoActividad::where('id_foto_actividad',$pera)->get();
        $id_actividad =DB::SELECT("SELECT * FROM actividades where activo=1 ORDER BY nombre ASC");
        return view('Fotos_actividades.mod_fotos_actividades',compact('imguser','id_tipo_usuario'))->with('fot',$fot[0])
                                                          ->with('id_actividad',$id_actividad);
}
   public function guarda_fotos_actividades(Request $request)
{

    if($request->hasFile('foto')){



                $id_foto_actividad=$request->id_foto_actividad;
                 $id_actividad=$request->id_actividad;
                 $file = $request->file('foto');  
                 $file->move('foto_actividades',$file->getClientOriginalName());
                 $video=$request->video;
                 $detalle=$request->detalle;

                 $fot = FotoActividad::find($id_foto_actividad);
                 $fot->id_actividad=$request->id_actividad;
                 $fot->foto=$file->getClientOriginalName();
                 $fot->video=$request->video;
                 $fot->detalle=$request->detalle;
                 $fot->tipo_foto=$request->tipo_foto;
                 $fot->extendida=$request->extendida;
                 $fot->save();


                Session::flash('message','Registro Actuaizado Correctamente');
                 return redirect('reporte');
             }else{

                $id_foto_actividad=$request->id_foto_actividad;
                 $id_actividad=$request->id_actividad;
                 $video=$request->video;
                 $detalle=$request->detalle;

                 $fot = FotoActividad::find($id_foto_actividad);
                 $fot->id_actividad=$request->id_actividad;
                 $fot->video=$request->video;
                 $fot->detalle=$request->detalle;
                 $fot->tipo_foto=$request->tipo_foto;
                 $fot->extendida=$request->extendida;
                 $fot->save();


                Session::flash('message','Registro Actuaizado Correctamente');
                 return redirect('reporte');
             }


}

 public function destroy($id, Request $request)
    {
        
        if ( $request->ajax() ) {
            DB::SELECT("DELETE  FROM foto_actividades WHERE id_foto_actividad=$id");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }
}
