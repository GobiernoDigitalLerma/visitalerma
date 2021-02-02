<?php

namespace App\Http\Controllers;

use App\TipoUsuario;
use Illuminate\Http\Request;
use App\Usuario;
use DB;
use Session;

class TipoUsuarioController extends Controller
{
    public function tipo_usuarios()
    {
	if(!session::has('admin')){
            return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

     	return view('tusuarios.tipo_usuarios',compact('imguser', 'id_tipo_usuario'));
    }

     public function enviar_tusu(Request $request)
    {
       $nombre= $request->nombre;
 
    //enviar variables
    $tactividad= new TipoUsuario;
    $tactividad->id_tipo_usuario = $request->id_tipo_usuario;
    $tactividad->nombre = $request->nombre;
    $tactividad->save();
    Session::flash('message','Registro Guardado Correctamente');
    return redirect('/reporte_tusuarios');
    }

     //vista de reporte pacientes
    public function reporte_tusuarios(Request $request)
    {
        if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

         //Para optener la clave de la BD
        $consul= TipoUsuario::select('tipo_usuarios.id_tipo_usuario as clave',
                                          'tipo_usuarios.nombre','tipo_usuarios.activo')
                            ->get();
  

        return view('tusuarios.reporte_tusuarios',compact('imguser', 'id_tipo_usuario'))
        ->with(['consul'=>$consul]);
   
    }

    //vista para modificar perfiles
     public function edita_tusuariosvista($id_tipo_usuario) //recibe id para modificar
    {
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $contenido= TipoUsuario::where('id_tipo_usuario',$id_tipo_usuario)->get();//obtener id_perfiles
      
        $consul= TipoUsuario::select('tipo_usuarios.id_tipo_usuario as clave',
                                          'tipo_usuarios.nombre as nom')
                                    ->where("id_tipo_usuario","=",$id_tipo_usuario)
                            ->get();

        return view('tusuarios.edita_tusuariosvista',compact('imguser', 'id_tipo_usuario'))
         ->with('contenido',$contenido[0])
        ->with('consul',$consul[0]);
       
                  
    }

     //edita empleados    
     public function editatusuarios(Request $request)
    {
    //Recibes las variables del formulario
    $id_tipo_usuario= $request->id_tipo_usuario;
    $nombre= $request->nombre;
  
    $tusu= TipoUsuario::find($id_tipo_usuario);
    $tusu->nombre = $request->nombre;
    $tusu->save();
    Session::flash('message','Registro Actualizado Correctamente');
    return redirect('/reporte_tusuarios');

    }

      //metodo para eliminar 
     public function destroy($id, Request $request)
    {
         if ( $request->ajax() ) {
             DB::SELECT("UPDATE tipo_usuarios set tipo_usuarios.activo=0 where $id=id_tipo_usuario");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }


     public function reactivartusuario($id_usuario, Request $request)
    {    

    $activo= $request->activo;
    
    if($request->get('activo') == 0){
        $activo= 1;
    }

    $ac= TipoUsuario::find($id_usuario);
    $ac->activo = $activo;
    $ac->save();

    return redirect('/reporte_tusuarios');


    } 

}
