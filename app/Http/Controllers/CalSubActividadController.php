<?php

namespace App\Http\Controllers;

use App\CalSubActividad;
use Illuminate\Http\Request;

class CalSubActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, 'es_MX.UTF-8');
        $fecha_actual=date('Y-m-d');
        //$hora_actual=strftime("%H:%M:%S");
        \App\CalSubActividad::create([
        'calificacion'=>($request['calf']),
        'idsa'=>($request['id_sub']),
        'fecha'=>($fecha_actual),
        
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CalSubActividad  $calSubActividad
     * @return \Illuminate\Http\Response
     */
    public function show(CalSubActividad $calSubActividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalSubActividad  $calSubActividad
     * @return \Illuminate\Http\Response
     */
    public function edit(CalSubActividad $calSubActividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CalSubActividad  $calSubActividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalSubActividad $calSubActividad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CalSubActividad  $calSubActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalSubActividad $calSubActividad)
    {
        //
    }
}
