<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Models\Frente;
use Illuminate\Http\Request;

class EleccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eleccionescreadas = Eleccion::where('estado', 1)
        ->orderBy('id', 'asc')
        ->paginate(20);

         return view('elecciones.index', compact('eleccionescreadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('elecciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|unique:eleccions,nombre',
            'motivo' => 'required|unique:eleccions,motivo',
            'cargodeautoridad' => 'required|unique:eleccions,cargodeautoridad',
        ]);

        $datosEleccion = request()->except('_token');

        if($request->hasFile('convocatoria')){
            $datosEleccion['convocatoria']=$request->file('convocatoria')->store('uploads','public');
        }

        $datosEleccion['estado'] = $request->input('estado', 1);
        Eleccion::insert($datosEleccion);

        if($request->hasFile('convocatoria')){
            $datosEleccion['convocatoria']=$request->file('convocatoria')->store('uploads','public');
        }
        return redirect('/elecciones')->with('success', 'La elección se ha guardado con éxito.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eleccion  $eleccion
     * @return \Illuminate\Http\Response
     */
    public function show(Eleccion $eleccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eleccion  $eleccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $elecciones=Eleccion::FindOrFail($id);
        return view('elecciones.edit', compact('elecciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eleccion  $eleccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosEleccion = request()->except(['_token','_method']);
        Eleccion::where('id','=',$id)->update($datosEleccion);

        $elecciones=Eleccion::FindOrFail($id);
        return redirect('/elecciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eleccion  $eleccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Eleccion::destroy($id);
        return redirect('elecciones');

    }

    public function archivar($id)
    {
        $eleccion = Eleccion::findOrFail($id);
        $eleccion->estado = 0;
        $eleccion->save();

        return redirect('/elecciones');
    }

    public function showBoleta($id) {
        $eleccion = Eleccion::find($id);
        $frentes = Frente::where('ideleccionfrente', $id)->get();
    
        return view('elecciones.boleta', compact('eleccion', 'frentes'));
    }
}