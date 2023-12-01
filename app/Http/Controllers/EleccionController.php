<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Models\Votante;
use App\Models\Frente;
use App\Models\Mesa;
use App\Models\Jurado;
use App\Models\Comite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use TCPDF;
use PDO;

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
        $id = $request->input('id');
        $pdfPath = $request->file('convocatoria')->storeAs('uploads', $id . '.pdf', 'public');
        $datosEleccion['convocatoria'] = $pdfPath;
    }    

    $datosEleccion['estado'] = $request->input('estado', 1);
    $datosEleccion['estadoRegistro'] = $request->input('estadoRegistro', 0);
    $eleccion = Eleccion::create($datosEleccion);

    if ($request->hasFile('convocatoria')) {
        $pdfPath = $request->file('convocatoria')->storeAs('uploads', $eleccion->id . '.pdf', 'public');

        $eleccion->update(['convocatoria' => $pdfPath]);
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
        
        Eleccion::where('id',$id)->update($datosEleccion);

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
        if($eleccion->estadoRegistro == 1){
            
            $eleccion->estado = 0;
            $eleccion->save();

            $frentes = Frente::where('ideleccionfrente', $eleccion->id)->get();
            foreach ($frentes as $frente) {
                $frente->estado = 0;
                $frente->save();
            }

            $votantes = Votante::where('ideleccion', $eleccion->id)->get();
            foreach ($votantes as $votante) {
                $votante->estado = 0;
                $votante->save();
            }

            $mesas = Mesa::where('id_de_eleccion', $eleccion->id)->get();
            foreach ($mesas as $mesa) {
                $mesa->estadoR = 0;
                $mesa->save();
            }

            $comites = Comite::where('id_eleccion', $eleccion->id)->get();
            foreach ($comites as $comite) {
                $comite->estado = 0;
                $comite->save();
            }

            $jurados = Jurado::where('iddeeleccion', $eleccion->id)->get();
            foreach ($jurados as $jurado) {
                $jurado->estado = 0;
                $jurado->save();
            }
        }
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
    $eleccion->votosblancoselec = $request->input('votosblancoselec');
    $eleccion->votosnuloselec = $request->input('votosnuloselec');

    $eleccion->estadoRegistro = 1;
    // Guardar la elección actualizada
       $eleccion->save();

    // Redirigir a la vista de elecciones u otra vista según sea necesario
    return redirect()->route('elecciones1.pdf', ['id' => $id]);
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

    $eleccion->votosblancoselec = $request->input('votosblancoselec');
    $eleccion->votosnuloselec = $request->input('votosnuloselec');

    $eleccion->estadoRegistro = 1;
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
        $tableNames = array_map('current', json_decode(json_encode($tables), true));

        // Si existe la tabla 'users', muévela al principio del array
        if (($key = array_search('users', $tableNames)) !== false) {
            unset($tableNames[$key]);
            array_unshift($tableNames, 'users');
        }

        foreach ($tableNames as $tableName) {
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


public function mostrarFormCargarBackup()
{
    return View::make('elecciones.cargabackup');
}


public function cargarBackup(Request $request)
{
    try {
        // Obtén el archivo de respaldo desde la solicitud
        $archivoBackup = $request->file('archivo_backup');

        // Nombre del archivo de respaldo
        $backupFileName = 'backup-' . Carbon::now()->format('Y-m-d_His') . '.sql';

        // Ruta completa del archivo de respaldo
        $backupPath = storage_path('app/backups/' . $backupFileName);

        // Mover el archivo de respaldo a la ubicación deseada
        $archivoBackup->move(storage_path('app/backups'), $backupFileName);

        // Abrir y leer el contenido del archivo de respaldo
        $sql = file_get_contents($backupPath);

        // Eliminar todas las tablas existentes
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tableName = reset($table);
            DB::unprepared("DROP TABLE IF EXISTS $tableName;");
        }

        // Ejecutar las instrucciones SQL en la base de datos
        DB::unprepared($sql);

        return redirect('/elecciones');
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error al restaurar la base de datos: ' . $e->getMessage()]);
    }
}


public function generarPDF1($id){

    $registro = Eleccion::findOrFail($id);
    $grafico = Eleccion::find($id);
    
    $nroVotantes = Votante::where('ideleccion', $registro->id)->count();
    $frentes = Frente::where('ideleccionfrente', $registro->id)->get(); 

    $votantes = Votante::where('ideleccion', $registro->id)
        ->orderByRaw("CASE WHEN tipoVotante = 'Administrativo' THEN 1 WHEN tipoVotante = 'Docente' THEN 2 ELSE 3 END")
        ->orderBy('apellidoPaterno')
        ->get();
    
    $comites = Comite::where('id_eleccion', $registro->id)->orderBy('apellidoPaterno')->get();

    $mesas = Mesa::where('id_de_eleccion', $registro->id)->count();

    //dd($frenteGanador->nombrefrente);

    $frente1 = $grafico->votosfrente1;
    $nombreFrente1 = $grafico->nombrefrente1;
    $frente2 = $grafico->votosfrente2;
    $nombreFrente2 = $grafico->nombrefrente2;
    $frente3 = $grafico->votosfrente3;
    $nombreFrente3 = $grafico->nombrefrente3;
    $frente4 = $grafico->votosfrente4;
    $nombreFrente4 = $grafico->nombrefrente4;

    $votosFrentes = [
        $frente1 => $nombreFrente1,
        $frente2 => $nombreFrente2,
        $frente3 => $nombreFrente3,
        $frente4 => $nombreFrente4,
    ];

    $maxVotos = max(array_keys($votosFrentes));
    $frenteGanador = $votosFrentes[$maxVotos];


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
    
    return view('elecciones.ReporteEleccion',compact('data', 'registro', 'nroVotantes', 'frenteGanador','suma','comites','mesas','votantes','frentes'));

}

public function generarPDF($id){

    $registro = Eleccion::findOrFail($id);
    $grafico = Eleccion::find($id);
    
    $nroVotantes = Votante::where('ideleccion', $registro->id)->count();
    $frentes = Frente::where('ideleccionfrente', $registro->id)->get(); 

    $votantes = Votante::where('ideleccion', $registro->id)
    ->orderByRaw("CASE WHEN tipoVotante = 'Administrativo' THEN 1 WHEN tipoVotante = 'Docente' THEN 2 ELSE 3 END")
    ->orderBy('apellidoPaterno')
    ->get();

    $mesasTotal = Mesa::where('id_de_eleccion',$registro->id)->get(); 

    $comites = Comite::where('id_eleccion', $registro->id)->orderBy('apellidoPaterno')->get();

    $mesas = Mesa::where('id_de_eleccion', $registro->id)->count();

    $jurados = Jurado::where('iddeeleccion',$registro->id)->get(); 

    //dd($frenteGanador->nombrefrente);

    $frente1 = $grafico->votosfrente1;
    $nombreFrente1 = $grafico->nombrefrente1;
    $frente2 = $grafico->votosfrente2;
    $nombreFrente2 = $grafico->nombrefrente2;
    $frente3 = $grafico->votosfrente3;
    $nombreFrente3 = $grafico->nombrefrente3;
    $frente4 = $grafico->votosfrente4;
    $nombreFrente4 = $grafico->nombrefrente4;

    $votosFrentes = [
        $frente1 => $nombreFrente1,
        $frente2 => $nombreFrente2,
        $frente3 => $nombreFrente3,
        $frente4 => $nombreFrente4,
    ];

    $maxVotos = max(array_keys($votosFrentes));
    $frenteGanador = $votosFrentes[$maxVotos];


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

    /*$options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    $dompdf = new Dompdf($options);

    $html = view('elecciones.historialPDF', compact('data', 'registro', 'nroVotantes', 'frenteGanador', 'suma', 'comites', 'mesas','votantes','frentes','mesasTotal','jurados'))->render();
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    // Obtener el contenido del PDF como una cadena
    $output = $dompdf->output();

    // Guardar el contenido en un archivo en el storage
    $filename = 'eleccion_' . $registro->id . '.pdf';
    Storage::put('public/pdfs/' . $filename, $output);*/


    //$dompdf->stream('reporte_eleccion_' . $registro->id . '.pdf', array('Attachment' => 0));

    
    return view('elecciones.historialPDF',compact('data', 'registro', 'nroVotantes', 'frenteGanador','suma','comites','mesas','votantes','frentes','mesasTotal','jurados'));

}

public function historial()
    {
        $elecciones = Eleccion::where('estado', 0)
        ->orderBy('id', 'asc')
        ->paginate(200);

        $query= null;

        /*$datosElecciones = [];
        foreach ($elecciones as $eleccion) {
            $datosElecciones[] = $this->generarPDFHistorial($eleccion->id);
        }*/

    return view('elecciones.historialEleccion', compact('elecciones','query'/*,'datosElecciones'*/));
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');

        $eleccionesT = Eleccion::where('estado', 0)
            ->orderBy('id', 'asc')
            ->paginate(200);

        $resultados = collect();

        foreach ($eleccionesT as $eleccion) {
            // Verificar si hay resultados en alguna de las tablas relacionadas
            if (
                Eleccion::where('id', $eleccion->id)->get()->filter(function ($item) use ($query) {
                    return stripos(implode(' ', $item->getAttributes()), $query) !== false;
                })->isNotEmpty() ||
                Frente::where('ideleccionfrente', $eleccion->id)->get()->filter(function ($item) use ($query) {
                    return stripos(implode(' ', $item->getAttributes()), $query) !== false;
                })->isNotEmpty() ||
                Votante::where('ideleccion', $eleccion->id)->get()->filter(function ($item) use ($query) {
                    return stripos(implode(' ', $item->getAttributes()), $query) !== false;
                })->isNotEmpty() ||
                Mesa::where('id_de_eleccion', $eleccion->id)->get()->filter(function ($item) use ($query) {
                    return stripos(implode(' ', $item->getAttributes()), $query) !== false;
                })->isNotEmpty() ||
                Comite::where('id_eleccion', $eleccion->id)->get()->filter(function ($item) use ($query) {
                    return stripos(implode(' ', $item->getAttributes()), $query) !== false;
                })->isNotEmpty() ||
                Jurado::where('iddeeleccion', $eleccion->id)->get()->filter(function ($item) use ($query) {
                    return stripos(implode(' ', $item->getAttributes()), $query) !== false;
                })->isNotEmpty()
            ) {
                // Si hay resultados en alguna de las tablas relacionadas, agregar la elección
                $resultados->push($eleccion);
            }
        }

        //dd($resultados);
        /*$directorio = public_path('storage/pdfs');

        $archivosPDF = glob($directorio . '/*.pdf');

        $resultados = [];

        foreach ($archivosPDF as $archivoPDF) {
            $contenido = file_get_contents($archivoPDF);
            if (stripos($contenido, $query) !== false) {
                $resultados[] = $archivoPDF;
            }
        }*/

        //return response()->json(['resultados' => $resultados, 'query' => $query]);
        return view('elecciones.historialEleccion', ['resultados' => $resultados, 'query' => $query]);
    }


}