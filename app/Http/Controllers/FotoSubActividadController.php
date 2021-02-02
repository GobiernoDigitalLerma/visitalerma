<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FotoSubActividad;
use App\SubActividad;
use App\Usuario;
use DB;
use Session;

class FotoSubActividadController extends Controller
{
      public function fotos_sub_actividades()
      {   
    if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();


        $id_foto_sub_actividad=FotoSubActividad::all();
        $id_foto_actividad=DB::SELECT("SELECT * FROM sub_actividades where activo=1 ORDER BY nombre ASC");
        return view('Fotos_sub_actividades.fotos_sub-actividades',compact('imguser','id_tipo_usuario'))->with('id_foto_sub_actividad',$id_foto_sub_actividad)
                                                            ->with('id_foto_actividad',$id_foto_actividad);
    }
    public function guardar_foto_sub_act(Request $request){


        $fot_act = new FotoSubActividad;
        $fot_act->Id_sub_actividad=$request->id_sub_actividad;
        

        $file = $request->file('foto');  
        $file->move('foto_actividades',$file->getClientOriginalName());
        $fot_act->foto=$file->getClientOriginalName();
        $fot_act->video=$request->video;
        $fot_act->detalle=$request->detalle;
        $fot_act->tipo_foto=$request->tipo_foto;
        $fot_act->extendida=$request->extendida;
        $fot_act->save();

        Session::flash('message','Registro Guardado Correctamente');
        return redirect('reporte_sub_actividad');
    }

    public function reporte_sub_actividad()

    {   
    if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  	
        $avatar=Usuario::where('id_usuario','=','14')->get();
        $sql=DB::SELECT("SELECT foto_sub.`activo`,foto_sub.`detalle`,foto_sub.`foto`,foto_sub.`id_foto_sub_actividad`,sub_act.`nombre`,foto_sub.`video`,foto_sub.tipo_foto,foto_sub.extendida  FROM foto_sub_actividades AS foto_sub
INNER JOIN sub_actividades AS sub_act ON sub_act.`id_sub_actividad`=foto_sub.`id_sub_actividad`  
WHERE foto_sub.activo=1");
        return view('Fotos_sub_actividades.reporte_sub_actividad',compact('imguser','id_tipo_usuario'))->with('sql',$sql);
    }

    public function mod_fotos_subactividades($pera){   
    if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

         $fot=FotoSubActividad::where('id_foto_sub_actividad',$pera)->get();
        $id_actividad =DB::SELECT("SELECT * FROM sub_actividades where activo=1 ORDER BY nombre ASC");
        return view('Fotos_sub_actividades.mod_fotos_subactividades',compact('imguser','id_tipo_usuario'))->with('fot',$fot[0])
                                                          ->with('id_actividad',$id_actividad);
}
   public function guarda_fotos_sub_actividad(Request $request)
{

     if($request->hasFile('foto')){

                $id_foto_sub_actividad=$request->id_foto_sub_actividad;
                 $id_sub_actividad=$request->id_sub_actividad;
                 $file = $request->file('foto');  
                 $file->move('foto_actividades',$file->getClientOriginalName());
                 $video=$request->video;
                 $detalle=$request->detalle;

                 $fot = FotoSubActividad::find($id_foto_sub_actividad);
                 $fot->id_sub_actividad=$request->id_sub_actividad;
                 $fot->foto=$file->getClientOriginalName();
                 $fot->video=$request->video;
                 $fot->detalle=$request->detalle;
                 $fot->tipo_foto=$request->tipo_foto;
                 $fot->extendida=$request->extendida;
                 $fot->save();


                Session::flash('message','Registro Actualizado Correctamente');
                 return redirect('reporte_sub_actividad');
                  }else{

                    $id_foto_sub_actividad=$request->id_foto_sub_actividad;
                 $id_sub_actividad=$request->id_sub_actividad;
                 $video=$request->video;
                 $detalle=$request->detalle;

                 $fot = FotoSubActividad::find($id_foto_sub_actividad);
                 $fot->id_sub_actividad=$request->id_sub_actividad;
                 $fot->video=$request->video;
                 $fot->detalle=$request->detalle;
                 $fot->tipo_foto=$request->tipo_foto;
                 $fot->extendida=$request->extendida;
                 $fot->save();

                 Session::flash('message','Registro Actualizado Correctamente');
                 return redirect('reporte_sub_actividad');

             }

}

public function destroy($id, Request $request)
    {
        
        if ( $request->ajax() ) {
             DB::SELECT("DELETE  FROM foto_sub_actividades WHERE id_foto_sub_actividad=$id");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }
}