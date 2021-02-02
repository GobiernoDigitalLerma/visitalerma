<?php

namespace App\Http\Controllers;

use App\SubActividad as S;
use App\Actividad as A;
use App\TipoActividad as T;
use App\Usuario as U;
use App\FotoSubActividad as F;
use App\UbicacionActividad as UB;
use App\ResenaSubActividad as R;
use DB;
use Illuminate\Http\Request;
use Redirect;
use Session;

class SubActividadController extends Controller
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

        $subs = S::all();
        return view('subactividades.index',compact('subs','imguser','id_tipo_usuario'));
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

        $actividades = DB::table('actividades')->orderBy('nombre', 'ASC')->get();
        $tipos = DB::table('tipo_actividades')->orderBy('nombre', 'ASC')->where('activo','=',1)->get();
        $locations = DB::table('ubicacion_actividades')->orderBy('nombre', 'ASC')->get();
        return view('subactividades.create',compact('actividades','tipos','locations','imguser','id_tipo_usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Session::get('admin');
        $id_usuario = $user[0]->id_usuario;
        $i = new S;
        $i->id_actividad = $request->ida;
        $i->nombre = $request->nombre;
        $i->fecha = $request->fecha;
        $i->id_tipo_actividad = $request->idta;
        $i->id_ubicacion_actividad = $request->location;
        $i->horario = $request->horario;
	    $i->descripcion= $request->descripcion;
	    $i->costo= $request->costo;
        $i->id_usuario = $id_usuario;
        $i->link= $request->link;
        $i->save();
        Session::flash('message','Registro Guardado Correctamente');
        return Redirect()->route('subactividades');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubActividad  $subActividad
     * @return \Illuminate\Http\Response
     */
    public function show(SubActividad $subActividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubActividad  $subActividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
        $id_tipo_usuario = $user[0]->id_tipo_usuario;

        $sub = S::findOrFail($id);
        $locations = UB::all();
        $actividades = A::all();
        $tipos = T::all();

        return view('subactividades.edit',compact('sub','actividades','tipos','locations','imguser','id_tipo_usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubActividad  $subActividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  

        $new = S::findOrFail($id);
        $new->id_actividad = $request->ida;
        $new->nombre = $request->nombre;
        $new->fecha = $request->fecha;
        $new->id_tipo_actividad = $request->idta;
        $new->id_ubicacion_actividad = $request->location;
        $new->horario = $request->horario;
	    $new->descripcion= $request->descripcion;
	    $new->costo= $request->costo;
        $new->link = $request->link;
        $new->save();
        Session::flash('message','Registro Modificado Correctamente');
        return redirect()->route('subactividades');
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  \App\SubActividad  $subActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $fotos = DB::SELECT("SELECT f.id_foto_sub_actividad,f.foto
        FROM sub_actividades AS s 
        INNER JOIN foto_sub_actividades AS f ON f.id_sub_actividad = s.`id_sub_actividad`
        WHERE s.`id_sub_actividad`=$id");

        $resena = DB::SELECT("SELECT r.id_resena_sub_actividad
        FROM sub_actividades AS s 
        INNER JOIN resena_sub_actividades AS r ON r.`id_sub_actividad` = s.`id_sub_actividad`
        WHERE s.`id_sub_actividad`=$id");

        if (count($resena) > 0) {
            foreach ($resena as $i) {
                R::destroy($i->id_resena_sub_actividad);
            }
        }
        if (count($fotos) > 0) {
            foreach ($fotos as $i) {
                $mi_imagen = public_path().'/foto_actividades/'.$i->foto;
                unlink($mi_imagen);
                F::destroy($i->id_foto_sub_actividad);
            }
        }
        S::destroy($id);
        return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
    }

    public function status(Request $request){
        $new = S::findOrFail($request->id);
        $new->activo = $state = $request->state;
        $new->save();
        return response(['msg' => 'Producto Eliminado', 'status' => 'success', 'state'=>$request->state]);
    }
}
