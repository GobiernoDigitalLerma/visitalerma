<?php

namespace App\Http\Controllers;

use App\TipoActividad;
use App\Usuario;
use App\SubActividad;
use App\Actividad;
use Illuminate\Http\Request;
use DB;
use Session;


class TipoActividadController extends Controller
{

    public function tipo_actividad()
    {
        
  if(!session::has('admin')){
            return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
  $id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

      return view('tactividad.tipo_actividad',compact('imguser', 'id_tipo_usuario'));
    }


 public function enviar_tipoac(Request $request)
    {
       $nombre= $request->nombre;
 
    //enviar variables
    $tactividad= new TipoActividad;
    $tactividad->id_tipo_actividad = $request->id_tipo_actividad;
    $tactividad->nombre = $request->nombre;
    $tactividad->save();
    Session::flash('message','Registro Guardado Correctamente');
    return redirect('/reporte_tactividad');
    }


    //vista de reporte pacientes
    public function reporte_tactividad(Request $request)
    {
        if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
  $id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

         //Para optener la clave de la BD
        $consul= TipoActividad::select('tipo_actividades.id_tipo_actividad as clave',
                                          'tipo_actividades.nombre','tipo_actividades.activo')
                            ->get();
  

        return view('tactividad.reporte_tactividad',compact('imguser', 'id_tipo_usuario'))
        ->with(['consul'=>$consul]);
   
    }

    //vista para modificar perfiles
     public function edita_tactividadvista($id_tipo_actividad) //recibe id para modificar
    {
  if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
  $id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $contenido= TipoActividad::where('id_tipo_actividad',$id_tipo_actividad)->get();//obtener id_perfiles
      
        $consul= TipoActividad::select('tipo_actividades.id_tipo_actividad as clave',
                                          'tipo_actividades.nombre as nom')
                                    ->where("id_tipo_actividad","=",$id_tipo_actividad)
                            ->get();

        return view('tactividad.edita_tactividadvista',compact('imguser', 'id_tipo_usuario'))
         ->with('contenido',$contenido[0])
        ->with('consul',$consul[0]);
       
                  
    }

    //edita empleados    
     public function editatactividad(Request $request)
    {
    //Recibes las variables del formulario
    $id_tipo_actividad= $request->id_tipo_actividad;
    $nombre= $request->nombre;
  
    $tactividad= TipoActividad::find($id_tipo_actividad);
    $tactividad->nombre = $request->nombre;
    $tactividad->save();
    Session::flash('message','Registro Actualizado Correctamente');
    return redirect('/reporte_tactividad');

    }

      //metodo para eliminar 
     public function destroy($id, Request $request)
    {
         if ( $request->ajax() ) { 
              DB::SELECT("UPDATE tipo_actividades set tipo_actividades.activo=0 where $id=id_tipo_actividad");
            Session::flash('message','El Registro se Desactivo Correctamente');
            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }


    public function reactivartactividad($id_tipo_actividad, Request $request)
    {    

    $activo= $request->activo;
    
    if($request->get('activo') == 0){
        $activo= 1;
    }

    $ac= TipoActividad::find($id_tipo_actividad);
    $ac->activo = $activo;
    $ac->save();
    
    Session::flash('message','El Campo se ha Activado Correctamente');
    return redirect('/reporte_tactividad');


    } 

    //Eliminar en cascada

   public function delete_cascada($id_tipo_actividad, Request $request){
  
    //Hacemos una consulta para buscar los datos que tengan relacion con id de tipo de actividad
    $SubActividad = SubActividad::all()->where('id_tipo_actividad','=',$id_tipo_actividad);

    //Hacemos una consulta para buscar los datos que tengan relacion con id de tipo de actividad
    $actividades = Actividad::all()->where('id_tipo_actividad','=',$id_tipo_actividad);

    //Guardamos en ARRAYS  y los contamos 
    $count = count($SubActividad);
    $count2 = count($actividades);
    //Usamos un If para comparar si el rsultado viene null o diferente de 0 
     if ($count > 0) 
     {
        //recorremos un Subtotal  con Foreach y eliminamos los registroa que tengan  id_tipo_actividad
        foreach ($SubActividad as $i) {
            SubActividad::destroy($i->id_sub_actividad);
        }
     }

     if ($count2 > 0) 
     {
        //recorremos un actividades  con Foreach y eliminamos los registroa que tengan  id_tipo_actividad
        foreach ($actividades as $i) {
            Actividad::destroy($i->id_actividad);
        }
     }
      
      //Eliminamos la Tabla directa           
     TipoActividad::find($id_tipo_actividad)->delete();

   Session::flash('message','Se Elimino Correctamente el Registro');
   return redirect('/reporte_tactividad');
   }
    
}
