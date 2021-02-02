<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UbicacionActividad;
use Session;
use App\Usuario;use Illuminate\Database\Eloquent\Model;

class UbicacionActividadController extends Controller
{
    public function index()
    {   
        if(!session::has('admin')){
                return Redirect('/login');
            }
        $user = Session::get('admin');

        $imguser = $user[0]->avatar;

	    $id_tipo_usuario = $user[0]->id_tipo_usuario;
      
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $ubicaciones = DB::table('ubicacion_actividades')
        ->select(
            'ubicacion_actividades.id_ubicacion_actividad',     
            'ubicacion_actividades.nombre',
            'ubicacion_actividades.fx',       
            'ubicacion_actividades.fy',
            'ubicacion_actividades.region'
            )
        ->where('ubicacion_actividades.activo',"=","1")
        ->get();

        return view('UbicacionActividad.index',compact('ubicaciones','imguser','id_tipo_usuario'));
    }


    public function create()
    {
        if(!session::has('admin')){
           return Redirect('/login');
        }

        $user = Session::get('admin');

        $imguser = $user[0]->avatar;

		$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        return view('UbicacionActividad.new',compact('imguser','id_tipo_usuario'));

    }

    public function store(Request $request)
    {
        if($request->ajax()){

        $this->validate($request,
        [ 
            'nombre'        =>  'required',
            'fx'            =>  'required',
            'fy'            =>  'required',
            'region'        =>  'required'
        ]);


        UbicacionActividad::create($request->all());
        
        return response()->json(["success"=>"Registro aceptado."]);

        }
    }

    public function edit(Request $reques,$id)
    {
        if(!session::has('admin')){
           return Redirect('/login');
        }

        $user = Session::get('admin');

        $imguser = $user[0]->avatar;
        
	    $id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $ubicacion = UbicacionActividad::find($id);

        return view('UbicacionActividad.edit',compact('ubicacion','imguser','id_tipo_usuario'));
    }

    public function update(Request $request,$id)
    {
        if($request->ajax()){

            $this->validate($request,
            [ 
                'nombre'        =>  'required',
                'fx'            =>  'required',
                'fy'            =>  'required',
                'region'        =>  'required'
            ]);
        
            UbicacionActividad::find($id)->update($request->all());

            return response()->json(["success"=>"El registro se ha actualizado."]);

        }
    }

    public function destroy(Request $request,$id)
    {
        if ( $request->ajax() ) { 

            DB::SELECT("update ubicacion_actividades set ubicacion_actividades.activo=0 where $id=id_ubicacion_actividad");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
    }
    
}

