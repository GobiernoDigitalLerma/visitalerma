<?php

namespace App\Http\Controllers;


use App\Http\Requests\SubActRequest;
use App\ResenaSubActividad;
use Illuminate\Http\Request;
use App\SubActividad;
use App\Usuario;
use DB;
use Session;
class ResenaSubActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	if(!session::has('admin')){
            return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $resena=DB::Select("SELECT ra.id_resena_sub_actividad,ra.id_sub_actividad,ra.nombre,ra.detalle,a.nombre AS actividad 
            FROM resena_sub_actividades AS ra
          INNER JOIN sub_actividades AS a ON a.`id_sub_actividad`=ra.`id_sub_actividad` WHERE ra.activo=1");
        return view('Catalogos.ResenaSubactividad.index',compact('resena','imguser','id_tipo_usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $date= SubActividad::all();
          return view('Catalogos.ResenaSubactividad.alta',compact('date','imguser','id_tipo_usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $nombre=$request['nombre'];
        $detalle=$request['detalle'];
        $id_sub_actividad=$request['id_sub_actividad'];

        DB::Insert("insert into resena_sub_actividades(nombre,detalle,id_sub_actividad)
        value('$nombre','$detalle',$id_sub_actividad)");

        Session::flash('message','Registro Guardado Correctamente');
        return redirect('resenasub');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResenaSubActividad  $resenaSubActividad
     * @return \Illuminate\Http\Response
     */
    public function show(ResenaSubActividad $resenaSubActividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResenaSubActividad  $resenaSubActividad
     * @return \Illuminate\Http\Response
     */
    public function edit(ResenaSubActividad $resenaSubActividad)
    {   
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $date = SubActividad::all();
        return view('Catalogos.ResenaSubactividad.modificacion',compact('date','imguser','id_tipo_usuario'),[
            'resenaSubActividad'=>$resenaSubActividad
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResenaSubActividad  $resenaSubActividad
     * @return \Illuminate\Http\Response
     */
    public function update(ResenaSubActividad $resenaSubActividad)
    {
        $resenaSubActividad->update([
            'nombre'=>request('nombre'),
            'detalle'=>request('detalle'),
            'id_sub_actividad'=>request('id_sub_actividad'),
        ]);
        Session::flash('message','Registro Actualizado Correctamente');
        return redirect('resenasub');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResenaSubActividad  $resenaSubActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
         if ( $request->ajax() ) { 
              DB::SELECT("UPDATE resena_sub_actividades set resena_sub_actividades.activo=0 where $id=id_resena_sub_actividad");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }
    public function delete($id, Request $request)
    {
        
         if ( $request->ajax() ) { 
              DB::SELECT("DELETE FROM `resena_sub_actividades` WHERE `id_resena_sub_actividad` = $id");

            return response(['msg' => 'Reseña Eliminada', 'status' => 'success']);
        }
        
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }
}
