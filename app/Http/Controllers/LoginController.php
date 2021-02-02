<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Login.login');
    }

    public function validarusuario(Request $request)
    {

        $user = $request->email;
        $password = $request->password;

        $user0 = $user;
        $password0 = $password;

        $user = DB::table("usuarios")->select("nombre")
                ->where([
                    ["correo","=",$user],
                    ["password","=",$password],
                ])->count();

        $datauser = DB::table("usuarios")->where([
                    ["correo","=",$user0],
                    ["password","=",$password0],
                ])->get();
        
    if($user > 0){
        
        Session::put('admin',$datauser);

        return redirect('/admin')->with('messages', 'Bienvenido!');
        
    }else{
        
        return redirect('/login')->with('messages', 'Credenciales incorrectas');
    }
    }

    public function logout(Request $request){
        
    session()->forget('admin');
    return Redirect('/login')->with('messages','Sesion cerrada exitosamente');

    }
}
