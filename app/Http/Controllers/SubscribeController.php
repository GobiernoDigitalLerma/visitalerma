<?php

namespace App\Http\Controllers;

use App\registropush;
use Illuminate\Http\Request;
use Session;
use App\Usuario;
use App\Actividad;
use App\Notifications\push;


class SubscribeController extends Controller
{
    public function subscribe($ip, Request $request)
    {       
          $user = registropush::create([
              'ip' => $ip,
          ]);
        $user->updatePushSubscription($request->input('endpoint'),$request->input('keys.p256dh'),$request->input('keys.auth'));
        return "guardado";
    }

    public function sendNotification(Request $request)
    {
      dd($request);
        $this->validateNotification($request);

        $user = registropush::all();
        // dd($user);
        $title = $request->title;
        $body = $request->mensaje;
        // foreach ($user as $push) {
        //   $push->notify(new \App\Notifications\push($title, $body));
        // }


        \Notification::send($user, new push($title, $body));
        //$encuestado->notify(new \App\Notifications\push($title, $body));
        return response()->json([
          'success' => true
        ]);

      }

      public function notificaciones()
      {
          if(!session::has('admin')){
            return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
        $id_tipo_usuario = $user[0]->id_tipo_usuario;

        $avatar = Usuario::where('id_usuario','=','14')->get();

        $usuario = \DB::SELECT("SELECT * from tipo_user WHERE activo =1");
        $actividades = Actividad::select('id_actividad', 'nombre','secciones')->whereIn('secciones' , [1,3])
                                  ->where('fecha_inicio', '>', date('Y-m-d'))
                                  ->get();
        
      /*  $usuario = Usuario::all()->where('tipo_user',1); */

        return view('notificaciones',compact('usuario','imguser','id_tipo_usuario','actividades'));
     }


    public function validateNotification($request)
    {
        return  $request->validate([
          'actividad' => 'required',
          'title' => 'required',
          'mensaje' => 'required',
      ]);
    }
      
      
}
