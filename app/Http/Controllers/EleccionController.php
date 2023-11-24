<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Models\Votante;
use App\Models\Frente;
use App\Models\Mesa;
use App\Models\Comite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
    // Verificar si ya existe una elección con el mismo nombre, motivo y cargo de autoridad
    $existingEleccion = Eleccion::where('nombre', $request->input('nombre'))
        ->where('motivo', $request->input('motivo'))
        ->where('cargodeautoridad', $request->input('cargodeautoridad'))
        ->where('gestioninicio', $request->input('gestioninicio'))
        ->where('gestionfin', $request->input('gestionfin'))
        ->first();

    // Si ya existe una elección con esos valores, mostrar los mensajes de validación
    if ($existingEleccion) {
        $request->validate([
            'nombre' => 'required|unique:eleccions,nombre',
            'motivo' => 'required|unique:eleccions,motivo',
            'cargodeautoridad' => 'required|unique:eleccions,cargodeautoridad',
        ]);
    }

    $datosEleccion = request()->except('_token');

    if ($request->hasFile('convocatoria')) {
        $datosEleccion['convocatoria'] = $request->file('convocatoria')->store('uploads', 'public');
    }

    $datosEleccion['estado'] = $request->input('estado', 1);
    Eleccion::insert($datosEleccion);

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
    return redirect()->route('elecciones.pdf', ['id' => $id]);
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
    return redirect()->route('elecciones.pdf', ['id' => $id]);
}

public function generarBackup()
{
    try {
        
        $backupFileName = 'backup-' . Carbon::now()->format('Y-m-d_His') . '.sql';

        $backupPath = storage_path('app/backups/' . $backupFileName);
        
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);
            
            $structure = DB::select('SHOW CREATE TABLE ' . $tableName)[0]->{'Create Table'};
            
            $data = DB::table($tableName)->get()->toArray();
            
            $sql = "";
            foreach ($data as $row) {
                $values = implode("', '", (array)$row);
                $sql .= "INSERT INTO $tableName VALUES ('$values');\n";
            }

            file_put_contents($backupPath, "-- Table: $tableName\n", FILE_APPEND);
            file_put_contents($backupPath, "$structure;\n", FILE_APPEND);
            file_put_contents($backupPath, "-- Data for $tableName\n", FILE_APPEND);
            file_put_contents($backupPath, "$sql\n", FILE_APPEND);
        }

        return response()->download($backupPath, $backupFileName, ['Content-Type' => 'application/sql']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error al generar el backup: ' . $e->getMessage()]);
    }
}

public function generarPDF($id){

    $registro = Eleccion::findOrFail($id);
    $grafico = Eleccion::find($id);
    
    $nroVotantes = Votante::where('ideleccion', $registro->id)->count();
    
    $frentes = Frente::where('ideleccionfrente', $registro->id)->get();

    $comites = Comite::where('id_eleccion', $registro->id)->get();

    $mesas = Mesa::where('id_de_eleccion', $registro->id)->count();



    if ($frentes->isNotEmpty() && $nroVotantes > 0) {
        $maxVotos = max(
            $frentes->max('votosFrente1'),
            $frentes->max('votosFrente2'),
            $frentes->max('votosFrente3'),
            $frentes->max('votosFrente4')
        );
        
        $frenteGanador = $frentes->first(function ($frente) use ($maxVotos) {
            return $frente->votosFrente1 == $maxVotos
                || $frente->votosFrente2 == $maxVotos
                || $frente->votosFrente3 == $maxVotos
                || $frente->votosFrente4 == $maxVotos;
        });
    }

    //dd($frenteGanador->nombrefrente);

    $frente1 = $grafico->votosfrente1;
    $frente2 = $grafico->votosfrente2;
    $frente3 = $grafico->votosfrente3;
    $frente4 = $grafico->votosfrente4;

    if($frente1 != null && $frente2 != null && $frente3 != null && $frente4 != null){
        $data = [
            'labels' => [$grafico->nombrefrente1, $grafico->nombrefrente2, $grafico->nombrefrente3, $grafico->nombrefrente4],
            'values' => [$frente1, $frente2, $frente3,$frente4],
        ];
    }else if($frente1 != null && $frente2 != null && $frente3 != null){
        $data = [
            'labels' => [$grafico->nombrefrente1, $grafico->nombrefrente2, $grafico->nombrefrente3],
            'values' => [$frente1, $frente2, $frente3],
        ];
    }else if($frente1 != null && $frente2 != null){
        $data = [
            'labels' => [$grafico->nombrefrente1, $grafico->nombrefrente2],
            'values' => [$frente1, $frente2],
        ];
    }else if($frente1 != null){
        $data = [
            'labels' => [$grafico->nombrefrente1],
            'values' => [$frente1],
        ];
    }else{
        $data = [
            'labels' => ['Sin registro de resultados'],
            'values' => [$frente1],
        ];
    }
    $suma=$frente1+$frente2+$frente3+$frente4;
    
    return view('elecciones.reporteEleccion',compact('data', 'registro', 'nroVotantes', 'frenteGanador','suma','comites','mesas'));

}

}