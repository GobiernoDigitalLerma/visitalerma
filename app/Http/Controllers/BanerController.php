<?php

namespace App\Http\Controllers;
use App\Baner;
use App\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;
use App\Usuario;use Illuminate\Database\Eloquent\Model;
class BanerController extends Controller
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

        $data= DB::table('baners')
        ->select(['baners.id_banner','baners.nombre','baners.fecha_inicio','baners.fecha_fin','baners.descripcion','baners.ruta','actividades.nombre as activa'])

        ->join('actividades','actividades.id_actividad','=','baners.id_actividad')
        ->where('baners.activo','=','1')
        ->get();
        
        return view('banner.index',compact('imguser','id_tipo_usuario'))->with('data',$data);

        
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
        

       $date =DB::SELECT("SELECT * FROM actividades where activo=1");
        return view('banner.create', compact('date','imguser','id_tipo_usuario'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /////////////////////////////////////////////////////////////////
        $this->validate($request,[
            'fecha_inicio' =>'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'nombre' => 'required',
            'descripcion' => 'required',
            'ruta' => 'required',
            'id_actividad' => 'required',
            ]);  
        ////////////////////////////////////////////////////////////////
            
        $image = $request->file('ruta');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('banner/uploads'), $new_name);

       
        $banner = new Baner([
            'nombre' => $request->get('nombre'),
            'fecha_inicio' => $request->get('fecha_inicio'),
            'fecha_fin' => $request->get('fecha_fin'),
            'descripcion' => $request->get('descripcion'),
            'ruta' => $new_name,
            'id_actividad' => $request->get('id_actividad'),  
        ]);
        $banner->save();
        return redirect('/ban')->with(Session::flash('message','Registro Guardado Correctamente'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Baner  $baner
     * @return \Illuminate\Http\Response
     */
    public function show(Baner $baner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Baner  $baner
     * @return \Illuminate\Http\Response
     */
    public function edit($id_banner)
    {
	if(!session::has('admin')){
           return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;
  
        $avatar=Usuario::where('id_usuario','=','14')->get();

        $actividad = DB::SELECT("SELECT id_actividad,nombre FROM actividades where activo=1");

        $data = DB::SELECT("SELECT * FROM banners WHERE id_banner='$id_banner'");

        return view('banner.edit', compact('data','actividad','imguser','id_tipo_usuario'));
    }
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Baner  $baner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /////////////////////////////////////////////////////////////////
        $this->validate($request,[
            'fecha_inicio' =>'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'nombre' => 'required',
            'descripcion' => 'required',
            'id_actividad' => 'required',
            ]);  
        ////////////////////////////////////////////////////////////////
        
        $id_banner=$request['id_banner'];
        $new_name = $request->hidden_image;
        $image = $request->file('ruta');
        if($image != '')
        {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('banner/uploads'), $new_name);
        }
        else
        {
        }
 
        $form_data = array(
            'nombre'       =>   $request->nombre,
            'fecha_inicio'             =>   $request->fecha_inicio,
            'fecha_fin'             =>   $request->fecha_fin,
            'descripcion'       =>   $request->descripcion,
            'ruta'            =>   $new_name,
            'id_actividad'           =>   $request->id_actividad
        );

        Baner::findOrFail($id_banner)->update($form_data);
        return redirect('ban')->with(Session::flash('message','Registro Editado Correctamente'));
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  \App\Baner  $baner
     * @return \Illuminate\Http\Response
     */
      public function destroy($id, Request $request)
    {
         if ( $request->ajax() ) { 
              DB::SELECT("UPDATE baners set baners.activo=0 where $id=id_banner");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('actividad')->with('errors','Opps ocurrio algun error');
    }

}
