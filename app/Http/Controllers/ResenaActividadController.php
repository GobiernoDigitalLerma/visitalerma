<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\SaveResenaActRequest;
use App\ResenaActividad;
use Illuminate\Http\Request;
use App\Actividad;
use App\Usuario;
use DB;
use Session;
class ResenaActividadController extends Controller
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

         $rese=DB::Select("SELECT ra.id_resena_actividad,ra.id_actividad,ra.nombre,ra.detalle,a.nombre AS actividad FROM resena_actividades AS ra
          INNER JOIN actividades AS a ON a.`id_actividad`=ra.`id_actividad` WHERE ra.activo=1");
         return view('Catalogos.ResenaActividad.index',compact('rese','imguser','id_tipo_usuario'));
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

        $date = Actividad::all();
        return view('Catalogos.ResenaActividad.alta',compact('date','imguser','id_tipo_usuario'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         ResenaActividad::create([
            'nombre'=>request('nombre'),
            'detalle'=>request('detalle'),
            'id_actividad'=>request('id_actividad'),
         ]);

         //Session::flash('message','Registro Guardado Correctamente');
        return  redirect('resena');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResenaActividad  $resenaActividad
     * @return \Illuminate\Http\Response
     */
    public function show(ResenaActividad $resenaActividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResenaActividad  $resenaActividad
     * @return \Illuminate\Http\Response
     */
    public function edit(ResenaActividad $resenaActividad)
    {   
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $date = Actividad::all();
         return view('Catalogos.ResenaActividad.modificacion' ,compact('date','imguser','id_tipo_usuario'),[
            'resenaActividad'=>$resenaActividad
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResenaActividad  $resenaActividad
     * @return \Illuminate\Http\Response
     */
    public function update(ResenaActividad $resenaActividad)
    {
         $resenaActividad->update([
            'nombre'=> request('nombre'),
            'detalle'=>request('detalle'),
            'id_actividad'=>request('id_actividad'),
         ]);
         //Session::flash('message','Registro Actualizado Correctamente');
                  return redirect('resena');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResenaActividad  $resenaActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
         if ( $request->ajax() ) { 
              DB::SELECT("UPDATE resena_actividades set resena_actividades.activo=0 where $id=id_resena_actividad");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }
}
