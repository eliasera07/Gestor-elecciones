<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mesascreadas = Mesa::orderBy('id_de_eleccion', 'asc')->paginate(20);
        return view('mesas.index', compact('mesascreadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('mesas.create', compact('elecciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'id_de_eleccion' => 'required',
    ]);

    $idDeEleccion = $request->input('id_de_eleccion');

    // Encuentra el último número de mesa registrado para esta elección
    $ultimoNumeroMesa = Mesa::where('id_de_eleccion', $idDeEleccion)
        ->max('numeromesa');

    $nuevoNumeroMesa = $ultimoNumeroMesa + 1;
    
    $datosMesas = request()->except('_token');
    $datosMesas['numeromesa'] = $nuevoNumeroMesa;

    Mesa::insert($datosMesas);

    return redirect('/mesas')->with('success', 'La mesa se ha guardado con éxito.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function show(Mesa $mesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $mesas = Mesa::findOrFail($id);
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('mesas.edit', compact('mesas', 'elecciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'id_de_eleccion' => 'required',
        ]);
    
        $datosMesas = request()->except(['_token', '_method']);
    
        Mesa::where('id', $id)->update($datosMesas);
    
        return redirect('/mesas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Mesa::destroy($id);
        return redirect('mesas');
    }
}
