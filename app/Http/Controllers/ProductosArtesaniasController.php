<?php

namespace App\Http\Controllers;

use App\ProductosArtesanias;
use Illuminate\Http\Request;
use Session;
use App\Usuario;
use DB;
use Image;


class ProductosArtesaniasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!session::has('admin')) {
            return Redirect('/login');
        }
        $artesanias = ProductosArtesanias::get();
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
        $id_tipo_usuario = $user[0]->id_tipo_usuario;

        $avatar = Usuario::where('id_usuario', '=', '14')->get();

        return view('artesanias.index', compact('imguser', 'id_tipo_usuario', 'artesanias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!session::has('admin')) {
            return Redirect('/login');
        }
        $user = Session::get('admin');
        $imguser = $user[0]->avatar;
        $id_tipo_usuario = $user[0]->id_tipo_usuario;
        $tipoartesania = DB::SELECT("SELECT id_tipo_artesanias, nombre FROM tipo_artesanias");

        $avatar = Usuario::where('id_usuario', '=', '14')->get();
        return view('artesanias.alta', compact('imguser', 'id_tipo_usuario', 'tipoartesania'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('foto1')) {
            $file = $request->file('foto1');
            $file2 = $request->file('foto2');
            $file3 = $request->file('foto3');
            $file4 = $request->file('foto4');
            $file->move('productos_artesanias', $file->getClientOriginalName());
            if ($request->hasFile('foto2')) {
                $file2->move('productos_artesanias', $file2->getClientOriginalName());
            }
            if ($request->hasFile('foto3')) {
                $file3->move('productos_artesanias', $file3->getClientOriginalName());
            }
            if ($request->hasFile('foto4')) {
                $file4->move('productos_artesanias', $file4->getClientOriginalName());
            }
            \App\ProductosArtesanias::create([

                'nombre' => ($request['name']),
                'caracteristicas' => ($request['caracteristicas']),
                'medidas' => ($request['medidas']),
                'id_tipo_artesanias' => ($request['id_tipo_artesanias']),
                'descripcion' => ($request['descripcion']),
                'foto1' => ($request['nombrefoto1']),
                'foto2' => ($request['nombrefoto2']),
                'foto3' => ($request['nombrefoto3']),
                'foto4' => ($request['nombrefoto4']),

            ]);

            return redirect('artesaniasp');
        } else if ($request->hasFile('foto2')) {
            $file = $request->file('foto1');
            $file2 = $request->file('foto2');
            $file3 = $request->file('foto3');
            $file4 = $request->file('foto4');
            $file2->move('productos_artesanias', $file2->getClientOriginalName());
            if ($request->hasFile('foto1')) {
                $file->move('productos_artesanias', $file->getClientOriginalName());
            }
            if ($request->hasFile('foto3')) {
                $file3->move('productos_artesanias', $file3->getClientOriginalName());
            }
            if ($request->hasFile('foto4')) {
                $file4->move('productos_artesanias', $file4->getClientOriginalName());
            }
            \App\ProductosArtesanias::create([

                'nombre' => ($request['name']),
                'caracteristicas' => ($request['caracteristicas']),
                'medidas' => ($request['medidas']),
                'id_tipo_artesanias' => ($request['id_tipo_artesanias']),
                'descripcion' => ($request['descripcion']),
                'foto1' => ($request['nombrefoto1']),
                'foto2' => ($request['nombrefoto2']),
                'foto3' => ($request['nombrefoto3']),
                'foto4' => ($request['nombrefoto4']),

            ]);

            return redirect('artesaniasp');
        } else if ($request->hasFile('foto3')) {
            $file = $request->file('foto1');
            $file2 = $request->file('foto2');
            $file3 = $request->file('foto3');
            $file4 = $request->file('foto4');
            $file3->move('productos_artesanias', $file3->getClientOriginalName());
            if ($request->hasFile('foto2')) {
                $file2->move('productos_artesanias', $file2->getClientOriginalName());
            }
            if ($request->hasFile('foto1')) {
                $file->move('productos_artesanias', $file->getClientOriginalName());
            }
            if ($request->hasFile('foto4')) {
                $file4->move('productos_artesanias', $file4->getClientOriginalName());
            }
            \App\ProductosArtesanias::create([

                'nombre' => ($request['name']),
                'caracteristicas' => ($request['caracteristicas']),
                'medidas' => ($request['medidas']),
                'id_tipo_artesanias' => ($request['id_tipo_artesanias']),
                'descripcion' => ($request['descripcion']),
                'foto1' => ($request['nombrefoto1']),
                'foto2' => ($request['nombrefoto2']),
                'foto3' => ($request['nombrefoto3']),
                'foto4' => ($request['nombrefoto4']),

            ]);

            return redirect('artesaniasp');
        } else if ($request->hasFile('foto4')) {
            $file = $request->file('foto1');
            $file2 = $request->file('foto2');
            $file3 = $request->file('foto3');
            $file4 = $request->file('foto4');
            $file4->move('productos_artesanias', $file4->getClientOriginalName());
            if ($request->hasFile('foto2')) {
                $file2->move('productos_artesanias', $file2->getClientOriginalName());
            }
            if ($request->hasFile('foto3')) {
                $file3->move('productos_artesanias', $file3->getClientOriginalName());
            }
            if ($request->hasFile('foto1')) {
                $file->move('productos_artesanias', $file->getClientOriginalName());
            }
            \App\ProductosArtesanias::create([

                'nombre' => ($request['name']),
                'caracteristicas' => ($request['caracteristicas']),
                'medidas' => ($request['medidas']),
                'id_tipo_artesanias' => ($request['id_tipo_artesanias']),
                'descripcion' => ($request['descripcion']),
                'foto1' => ($request['nombrefoto1']),
                'foto2' => ($request['nombrefoto2']),
                'foto3' => ($request['nombrefoto3']),
                'foto4' => ($request['nombrefoto4']),

            ]);

            return redirect('artesaniasp');
        } else {
            \App\ProductosArtesanias::create([

                'nombre' => ($request['name']),
                'caracteristicas' => ($request['caracteristicas']),
                'medidas' => ($request['medidas']),
                'id_tipo_artesanias' => ($request['id_tipo_artesanias']),
                'descripcion' => ($request['descripcion']),
            ]);

            return redirect('artesaniasp');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductosArtesanias  $productosArtesanias
     * @return \Illuminate\Http\Response
     */
    public function show(ProductosArtesanias $productosArtesanias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductosArtesanias  $productosArtesanias
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductosArtesanias $productosArtesanias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductosArtesanias  $productosArtesanias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductosArtesanias $productosArtesanias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductosArtesanias  $productosArtesanias
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductosArtesanias $productosArtesanias)
    {
        //
    }
}
