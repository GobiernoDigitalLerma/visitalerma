<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MapaController extends Controller
{
    public function index()
    {
        $actividades = DB::table("actividades")
                        ->join("tipo_actividades", "tipo_actividades.id_tipo_actividad", "=", "actividades.id_tipo_actividad")
                        ->join("ubicacion_actividades", "ubicacion_actividades.id_ubicacion_actividad", "=", "actividades.idu")
                        ->join("foto_actividades", "foto_actividades.id_actividad", "=", "actividades.id_actividad")
                        ->select(
                            "actividades.id_actividad as xdn",
                            "actividades.nombre",
                            "actividades.descripcion",
                            "actividades.artista",
                            "actividades.horario_detalle",
                            "actividades.fecha_inicio",
                            "actividades.fecha_fin_actividad",
                            "tipo_actividades.nombre as tipo",
                            "ubicacion_actividades.nombre as ubicacion",
                            "ubicacion_actividades.fx",
                            "ubicacion_actividades.fy",
                            "foto_actividades.foto",
                            "foto_actividades.video"
                        )
                        ->where([
                            ["actividades.secciones", "=", 3],
                            ["actividades.activo", "=", 1],
                            ["foto_actividades.extendida", "=", 2]
                        ])
                        ->get();

        return view('Map.index',compact("actividades"));
    }
}
