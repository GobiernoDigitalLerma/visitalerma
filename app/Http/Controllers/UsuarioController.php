<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use DB;
use Image;
use alert;
use Session;
use Redirect;
use App\PWAdownload;

class UsuarioController extends Controller
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

        $avatar = Usuario::where('id_usuario','=','14')->get();

        $usuario = DB::SELECT("SELECT * from tipo_user WHERE activo =1");

       /*  $usuario = Usuario::all()->where('tipo_user',1); */

        return view('usuarios.index',compact('usuario','imguser','id_tipo_usuario'));
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

        $tipousuario = DB::SELECT("SELECT id_tipo_usuario,nombre FROM tipo_usuarios WHERE activo=1");
        return view('usuarios.alta',compact('tipousuario','imguser','id_tipo_usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'avatar.uploaded' => 'Tu archivo debe pesar menos de 1MB',
        ];
        $this->validate($request,
        [
            'name'=>'required|regex:/^[A-Z,a-z]/u',
            'ap'=>'required|regex:/^[A-Z,a-z]/u',
            'am'=>'required|regex:/^[A-Z,a-z]/u',
            'correo' => 'required|unique:usuarios,correo',
            'tipo_user'=>'required',
            'avatar'=>'required',
        ], $messages);


       $file=$request->file('avatar');

       $file->move('usuarios',$file->getClientOriginalName());

        \App\Usuario::create([

        'nombre'=>($request['name']),
        'ap'=>($request['ap']),
        'am'=>($request['am']),
        'correo'=>($request['correo']),
        'telefono'=>($request['telefono']),
        'password'=>($request['password']),
        'id_tipo_usuario'=>($request['tipo_user']),
        'avatar'=>$file->getClientOriginalName()
        ]);
        Session::flash('message','Registro Guardado Correctamente');
        return redirect('usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
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

        $avatar=Usuario::where('id_usuario','=','14')->get();

        $tipousuario = DB::SELECT("SELECT id_tipo_usuario,nombre FROM tipo_usuarios where activo=1");
        $users = DB::SELECT("SELECT * FROM tipo_user WHERE id_usuario='$id'");

        return view('usuarios.edit',compact('users','tipousuario','imguser','id_tipo_usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $messages = [
            'avatar.uploaded' => 'Tu archivo debe pesar menos de 1MB',
        ];
        $this->validate($request,
        [
            'name'=>'required|regex:/^[A-Z,a-z]/u',
            'ap'=>'required|regex:/^[A-Z,a-z]/u',
            'am'=>'required|regex:/^[A-Z,a-z]/u',
            'correo' => 'required|email',
            'tipo_user'=>'required',
            'avatar'=>'required',
        ],$messages);

        if($request->hasFile('avatar')){
        $file=$request->file('avatar');
        $file->move('usuarios',$file->getClientOriginalName());

        $id=$request['id'];

        $a=Usuario::find($id);
        $a->nombre=$request['name'];
        $a->ap=$request['ap'];
        $a->am=$request['am'];
        $a->correo=$request['correo'];
        $a->telefono=$request['telefono'];
        $a->id_tipo_usuario=$request['tipo_user'];
        $a->avatar=$file->getClientOriginalName();
        $a->save();
        return redirect('usuario');
        }else{
        $id=$request['id'];

        $a=Usuario::find($id);
        $a->nombre=$request['name'];
        $a->ap=$request['ap'];
        $a->am=$request['am'];
        $a->correo=$request['correo'];
        $a->telefono=$request['telefono'];
        $a->id_tipo_usuario=$request['tipo_user'];
        $a->avatar=$request['avatar2'];
        $a->save();
        Session::flash('message','Registro Actualizado Correctamente');
        return redirect('usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        if ( $request->ajax() ) {

            DB::SELECT("DELETE FROM usuarios WHERE id_usuario = '$id'");

            return response(['msg' => 'Producto Eliminado', 'status' => 'success']);
        }
         return redirect('usuario')->with('errors','Opps ocurrio algun error');
    }

    public function quehacer()
    {

          $imgs = DB::SELECT('SELECT a.`id_actividad` AS id ,a.activo,a.`nombre`, f.`foto`,SUBSTR(a.descripcion,1,100) AS detalle, RAND() r
          FROM foto_actividades AS f
          INNER JOIN actividades AS a
          ON a.`id_actividad` = f.`id_actividad`
          WHERE a.secciones = 1
          AND f.tipo_foto = 2
          AND f.extendida = 2
          AND a.activo = 1
          ORDER BY r DESC');


        $index = array(
            "quehacerindex" => $imgs,

        );

        return response()->json($index, 200);
    }

    public function downloadPWA(Request $r)
    {
        PWAdownload::create($r->all());
        return "guardado";
    }
    public function checkpwa($ip)
    {
      $ip = PWAdownload::where('ipublic', '=', $ip)->get();
      $cuantos = count($ip);
      return response()->json(["total" => $cuantos]);

    }
}
