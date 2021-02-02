<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\artesano;
use App\Usuario;
use DB;
use Session;



class artesanoController extends Controller
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

        $artesano=DB::select("select * from artesanos");
        return view('Artesanos.index',compact('artesano','imguser','id_tipo_usuario'));
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

        return view('Artesanos.alta',compact('imguser','id_tipo_usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $nombre=request('nombre');
            $direccion=request('direccion');
            $telefono=request('telefono');
            $contacto=request('contacto');
            $correo=request('correo');
            $logros=request('logros');
            $premios=request('premios');
            $historias=request('historias');
            $id_tipo_artesanias=request('id_tipo_artesanias');
	DB::INSERT("insert into artesanos(nombre,direccion,telefono,contacto,correo,logros,premios,historias,id_tipo_artesanias)
 value ('$nombre','$direccion',$telefono,'$contacto','$correo','$logros','$premios','$historias','$id_tipo_artesanias')");
	           

         return  redirect('artesanos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_art)
    {
    	if(!session::has('admin')){
            return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
		$id_tipo_usuario = $user[0]->id_tipo_usuario;
        $avatar=Usuario::where('id_usuario','=','14')->get();

       $art= DB::select("select * from artesanos where id_art=$id_art");
       return view('Artesanos.modificacion',compact('art','imguser','id_tipo_usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         	$id_art=request('id_art');
            $nombre=request('nombre');
            $direccion=request('direccion');
            $telefono=request('telefono');
            $contacto=request('contacto');
            $correo=request('correo');
            $logros=request('logros');
            $premios=request('premios');
            $historias=request('historias');
            $id_tipo_artesanias=request('id_tipo_artesanias');
	DB::UPDATE("update artesanos set nombre='$nombre',direccion='$direccion',telefono=$telefono,contacto='$contacto',
		correo='$correo',logros='$logros',premios='$premios',historias='$historias',id_tipo_artesanias='$id_tipo_artesanias' where id_art=$id_art");
      

         return  redirect('artesanos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $request->ajax() ) { 
              DB::SELECT("UPDATE resena_actividades set resena_actividades.activo=0 where $id=id_resena_actividad");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');

    }
}
