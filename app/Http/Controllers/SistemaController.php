<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Session;
use Redirect;

class SistemaController extends Controller
{
  public function admin(){
  	
  	if(!session::has('admin')){
  		return Redirect('/login');
  	}
  	$user = Session::get('admin');
  	$imguser = $user[0]->avatar;
	$id_tipo_usuario = $user[0]->id_tipo_usuario;

  	$avatar=Usuario::where('id_usuario','=','14')->get();
  	//return $avatar[0]->avatar;
  	return view('home', compact('imguser','id_tipo_usuario'));
  }

}
