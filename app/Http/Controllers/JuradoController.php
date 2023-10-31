<?php

namespace App\Http\Controllers;

use App\Models\Jurado;
use Illuminate\Http\Request;

class JuradoController extends Controller
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
        return view('jurados.create');
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
        $datosJurado = request()->except('_token');
    
        // Inserta los datos en la tabla votantes
        Jurado::insert($datosJurado);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurado  $jurado
     * @return \Illuminate\Http\Response
     */
    public function show(Jurado $jurado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurado  $jurado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    // Recupera el jurado por su ID
    $jurados = Jurado::find($id);

    // Verifica si el jurado existe
    if (!$jurados) {
        return redirect('/elecciones')->with('error', 'Jurado no encontrado');
    }

    // Retorna la vista del formulario de edición con el jurado
    return view('jurados.edit', compact('jurados'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurado  $jurado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosJurado = $request->except(['_token', '_method']);
   
        Jurado::where('id', $id)->update($datosJurado);
    
        $jurados = Jurado::findOrFail($id);
    
        return redirect('/mesas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurado  $jurado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurado $id)
    {
        //
        Jurado::destroy($id);
        return redirect('comite');
    }
}
