<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo_artesania;
use App\Usuario;
use DB;
use Session;

class ControllerTartesanias extends Controller
{
    //Vista de la Alta
    public function tipo_artesanias()
    {

    if(!session::has('admin')){
    return Redirect('/login');
    }

    $user = Session::get('admin');
    $imguser = $user[0]->avatar;
    $id_tipo_usuario = $user[0]->id_tipo_usuario;
    
    return view('tartesanias.tipo_artesanias',compact('imguser','id_tipo_usuario'));
	
    }

    //Alta de tipo de Artesanias 
    public function enviar_tipoartesania(Request $request)
    {
    $nombre= $request->nombre;
 
    //enviar variables
    $tartesanias= new tipo_artesania;
    $tartesanias->id_tipo_artesanias = $request->id_tipo_artesanias;
    $tartesanias->nombre = $request->nombre;
    $tartesanias->save();
    Session::flash('message','Registro Guardado Correctamente');
    return redirect('/reporte_tartesanias');
    }

    //vista de reporte tipo de artesanias
    public function reporte_tartesanias(Request $request)
    {
        if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
        $id_tipo_usuario = $user[0]->id_tipo_usuario;
  		$avatar=Usuario::where('id_usuario','=','14')->get();

         //Para optener la clave de la BD
        $consul= tipo_artesania::select('tipo_artesanias.id_tipo_artesanias',
                                          'tipo_artesanias.nombre','tipo_artesanias.activo')
                    ->get();
  

        return view('tartesanias.reporte_tartesanias',compact('imguser', 'id_tipo_usuario'))
        ->with(['consul'=>$consul]);
   
    }

    //vista para modificar perfiles
    public function edita_tartesaniasvista($id_tipo_artesanias) //recibe id para modificar
    {
    if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
        $id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $contenido= tipo_artesania::where('id_tipo_artesanias',$id_tipo_artesanias)->get();//obtener 
      
        $consul= tipo_artesania::select('tipo_artesanias.id_tipo_artesanias as clave',
                                          'tipo_artesanias.nombre as nom')
                                    ->where("id_tipo_artesanias","=",$id_tipo_artesanias)
                            ->get();

        return view('tartesanias.edita_tartesaniasvista',compact('imguser', 'id_tipo_usuario'))
         ->with('contenido',$contenido[0])
        ->with('consul',$consul[0]);              
    }


    //edita tipo artesanias   
     public function editatartesanias(Request $request)
    {
    //Recibes las variables del formulario
    $id_tipo_artesanias= $request->id_tipo_artesanias;
    $nombre= $request->nombre;
  
    $tartesanias= tipo_artesania::find($id_tipo_artesanias);
    $tartesanias->nombre = $request->nombre;
    $tartesanias->save();
    Session::flash('message','Registro Actualizado Correctamente');
    return redirect('/reporte_tartesanias');

    }

    public function destroy(Request $request,$id)
    {
        if ( $request->ajax() ) { 

            DB::SELECT("UPDATE tipo_artesanias set tipo_artesanias.activo=0 where $id=id_tipo_artesanias");

            return response(['msg' => 'Artesanía Eliminada', 'status' => 'success']);
        }
    }


    public function reactivar(Request $request,$id)
    {
        if ( $request->ajax() ) { 

            DB::SELECT("UPDATE tipo_artesanias set tipo_artesanias.activo=1 where $id=id_tipo_artesanias");
            
            return response(['msg' => 'Artesanía Activada', 'status' => 'success']);
        }
    }

     public function eliminar (Request $request,$id)
    {
        if ( $request->ajax() ) { 

            DB::SELECT("DELETE FROM tipo_artesanias WHERE $id= id_tipo_artesanias");
          return response(['msg' => 'Artesanía eliminada', 'status' => 'success']);
        }
    }

}
