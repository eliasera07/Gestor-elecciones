<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Models\Frente;
use Illuminate\Http\Request;

class FrenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $frentescreados = Frente::orderBy('ideleccionfrente', 'asc')->paginate(20);
        return view('frente.index', compact('frentescreados'));
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
        return view('frente.create', compact('elecciones'));
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
        'ideleccionfrente' => 'required',
        'nombrefrente' => 'required|unique:frentes,nombrefrente,NULL,id,ideleccionfrente,'.$request->ideleccionfrente,
        'nombrecandidato1' => 'required|unique:frentes,nombrecandidato1,NULL,id,ideleccionfrente,'.$request->ideleccionfrente,
    ]);

    $datosFrente = request()->except('_token');
    
    if($request->hasFile('fotofrente')){
        $datosFrente['fotofrente']=$request->file('fotofrente')->store('uploads','public');
    }

    Frente::insert($datosFrente);

    return redirect('/frente')->with('success', 'El frente se ha guardado con éxito.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frente  $frente
     * @return \Illuminate\Http\Response
     */
    public function show(Frente $frente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frente  $frente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $frente = Frente::findOrFail($id);
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('frente.edit', compact('frente', 'elecciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frente  $frente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'ideleccionfrente' => 'required',
        'nombrefrente' => 'required|unique:frentes,nombrefrente,NULL,id,ideleccionfrente,'.$request->ideleccionfrente,
        'nombrecandidato1' => 'required|unique:frentes,nombrecandidato1,NULL,id,ideleccionfrente,'.$request->ideleccionfrente,
    ]);

    $existingFrente = Frente::where('ideleccionfrente', $request->ideleccionfrente)
        ->where('nombrefrente', $request->nombrefrente)
        ->where('nombrecandidato1', $request->nombrecandidato1)
        ->where('id', '!=', $id) // Excluye el registro actual
        ->first();

    if ($existingFrente) {
        return redirect('/frente')->with('error', 'Este frente ya está registrado en la misma elección.');
    }

    $datosFrente = request()->except(['_token', '_method']);

    Frente::where('id', $id)->update($datosFrente);

    return redirect('/frente');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frente  $frente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Frente::destroy($id);
        return redirect('frente');
    }
}