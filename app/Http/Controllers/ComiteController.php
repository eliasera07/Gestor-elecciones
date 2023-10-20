<?php

namespace App\Http\Controllers;
use App\Models\Eleccion;
use App\Models\Comite;
use App\Models\Votante;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comitecreado = Comite::orderBy('id_eleccion', 'asc')->paginate(20);

        return view('comite.index', compact('comitecreado'));
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
        return view('comite.create', compact('elecciones'));
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
        $datosComite = request()->except('_token');
    
        // Inserta los datos en la tabla votantes
        Comite::insert($datosComite);
    
        return redirect('/comite')->with('success', 'El miembro del comite se ha guardado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function show(Comite $comite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comite = Comite::findOrFail($id);
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('comite.edit', compact('comite', 'elecciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
    $datosComite = $request->except(['_token', '_method']);
   
    Comite::where('id', $id)->update($datosComite);

    $elecciones = Eleccion::where('estado', 1)->get();

    $comite = Comite::findOrFail($id);

    return redirect('/comite');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Comite::destroy($id);
        return redirect('comite');
    }
}