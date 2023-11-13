<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Models\Votante;
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
    $elecciones = Eleccion::findOrFail($id);
    
    // Agrega la lógica para obtener las carreras por facultad
    $carrerasPorFacultad = []; // Asegúrate de obtener las carreras correctas aquí
    
    return view('elecciones.edit', compact('elecciones', 'carrerasPorFacultad'));
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

    public function mostrarPrevisualizacion($id) {
        $eleccion = Eleccion::findOrFail($id);
        $numVotantes = Votante::where('ideleccion', $id)->count();
    
        return view('elecciones.previsualizacion', compact('eleccion', 'numVotantes'));
    }
    
    public function registroResultados($id) {
        $eleccion = Eleccion::find($id);
        $frentes = Frente::where('ideleccionfrente', $id)->get();
        
        return view('elecciones.registroResultados', compact('eleccion', 'frentes'));
    }

    public function guardarResultados(Request $request, $id)
{
    // Obtener la elección por su ID
    $eleccion = Eleccion::findOrFail($id);

    // Iterar sobre los frentes y guardar los datos en la base de datos
    for ($i = 1; $i <= 4; $i++) { // Asumiendo un máximo de 4 frentes
        $nombreFrenteKey = 'nombrefrente' . $i;
        $votosFrenteKey = 'votosfrente' . $i;

        // Obtener el nombre y los votos del frente desde el formulario
        $nombreFrente = $request->input($nombreFrenteKey);
        $votosFrente = $request->input($votosFrenteKey);

        // Guardar los datos en la base de datos
        $eleccion->$nombreFrenteKey = $nombreFrente;
        $eleccion->$votosFrenteKey = $votosFrente;
    }

    // Guardar la elección actualizada
       $eleccion->save();

    // Redirigir a la vista de elecciones u otra vista según sea necesario
       return redirect('/elecciones');
}

public function editarRegistroResultados($id)
{
    $eleccion = Eleccion::findOrFail($id);

    return view('elecciones.editarResultados', compact('eleccion'));
}

public function guardarEdicionResultados(Request $request, $id)
{
    // Obtener la elección por su ID
    $eleccion = Eleccion::findOrFail($id);

    // Iterar sobre los frentes y actualizar los datos en la base de datos
    for ($i = 1; $i <= 4; $i++) { // Asumiendo un máximo de 4 frentes
        $nombreFrenteKey = 'nombrefrente' . $i;
        $votosFrenteKey = 'votosfrente' . $i;

        // Obtener el nombre y los votos del frente desde el formulario
        $nombreFrente = $request->input($nombreFrenteKey);
        $votosFrente = $request->input($votosFrenteKey);

        // Actualizar los datos en la base de datos
        $eleccion->$nombreFrenteKey = $nombreFrente;
        $eleccion->$votosFrenteKey = $votosFrente;
    }

    // Guardar la elección actualizada
    $eleccion->save();

    // Redirigir a la vista de elecciones u otra vista según sea necesario
    return redirect('/elecciones');
}


}