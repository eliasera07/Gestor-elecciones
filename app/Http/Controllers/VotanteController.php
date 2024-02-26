<?php

namespace App\Http\Controllers;
use App\Models\Eleccion;
use App\Models\Votante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class VotanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    // Obtener todos los votantes y ordenar por apellidoPaterno de manera ascendente
    $votantes = Votante::where('estado', 1)
        ->when($request->input('eleccion'), function ($query) use ($request) {
            return $query->where('ideleccion', $request->input('eleccion'));
        })
        ->orderBy('apellidoPaterno', 'asc')
        ->paginate(500);

    // Obtener todas las elecciones para el menú desplegable
    $elecciones = Eleccion::all();

    // Obtener el ID de la elección seleccionada
    $eleccionId = $request->input('eleccion');

    return view('votante.index', compact('votantes', 'elecciones', 'eleccionId'));
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
        return view('votante.create', compact('elecciones'));
        
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
        'ideleccion' => 'required',
        'codSis' => 'required|unique:votantes,codSis,NULL,id,ideleccion,'.$request->ideleccion,
        'CI' => 'required|unique:votantes,CI,NULL,id,ideleccion,'.$request->ideleccion,
    ]);

    // Verifica si ya existe un votante con el mismo CI y codSis en la misma elección
    $existingVotante = Votante::where('ideleccion', $request->ideleccion)
        ->where('codSis', $request->codSis)
        ->where('CI', $request->CI)
        ->first();

    if ($existingVotante) {
        return redirect('/votante')->with('error', 'Este votante ya está registrado en la misma elección.');
    }

    // Si no existe un votante con los mismos datos en la misma elección, procede a registrar al votante
    $datosVotante = request()->except('_token');

    Votante::insert($datosVotante);

    return redirect('/votante')->with('success', 'El votante se ha guardado con éxito.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Votante  $votante
     * @return \Illuminate\Http\Response
     */
    public function show(Votante $votante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Votante  $votante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $votante = Votante::findOrFail($id);
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('votante.edit', compact('votante', 'elecciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Votante  $votante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'ideleccion' => 'required',
        'codSis' => 'required|unique:votantes,codSis,NULL,id,ideleccion,'.$request->ideleccion,
        'CI' => 'required|unique:votantes,CI,NULL,id,ideleccion,'.$request->ideleccion,
    ]);

    $existingVotante = Votante::where('ideleccion', $request->ideleccion)
        ->where('codSis', $request->codSis)
        ->where('CI', $request->CI)
        ->where('id', '!=', $id) // Excluye el registro actual
        ->first();

    if ($existingVotante) {
        return redirect('/votante')->with('error', 'Este votante ya está registrado en la misma elección.');
    }

    $datosVotante = request()->except(['_token', '_method']);

    Votante::where('id', $id)->update($datosVotante);

    return redirect('/votante');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Votante  $votante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Votante::destroy($id);
        return redirect('votante');
    }

   

public function showCarga(){
    
    $elecciones = Eleccion::where('estado', 1)->get();
    return view('votante.carga', compact('elecciones'));
}


    /**
     * Process the uploaded CSV file to import voters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importCsv(Request $request)
{
    $request->validate([
        'ideleccion' => 'required',
        'cargarListaCSV' => 'required|file|mimes:csv,txt',
    ]);

    $file = $request->file('cargarListaCSV');

    $handle = fopen($file->getPathname(), 'r');

    // Variable de control para omitir la primera fila
    $skipFirstRow = true;

    if ($handle !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            // Omitir la primera fila
            if ($skipFirstRow) {
                $skipFirstRow = false;
                continue;
            }

            $existingVotante = Votante::where('ideleccion', $request->ideleccion)
                ->where(function ($query) use ($row) {
                    $query->where('codSis', $row[3])
                        ->orWhere('CI', $row[4]);
                })
                ->first();

            if ($existingVotante) {
                continue;
            }

            Votante::create([
                'ideleccion' => $request->ideleccion,
                'nombres' => $row[0],
                'apellidoPaterno' => $row[1],
                'apellidoMaterno' => $row[2],
                'codSis' => $row[3],
                'CI' => $row[4],
                'tipoVotante' => $row[5],
                'carrera' => $row[6],
                'profesion' => $row[7],
                'cargoAdministrativo' => $row[8],
                'facultad' => $row[9],
                'celular' => $row[10],
                'email' => $row[11],
            ]);
        }

        fclose($handle);
    }

    return redirect('/votante')->with('success', 'Votantes importados exitosamente');
}


public function filter(Request $request)
{
    // Validación de datos
    $request->validate([
        'eleccion' => 'required|exists:eleccions,id',
    ]);

    // Obtener el ID de la elección seleccionada
    $eleccionId = $request->input('eleccion');

    // Obtener los votantes de la elección seleccionada y ordenar por apellidoPaterno
    $votantes = Votante::where('ideleccion', $eleccionId)
        ->orderBy('apellidoPaterno', 'asc')
        ->get();

    // Obtener todas las elecciones para el menú desplegable
    $elecciones = Eleccion::all();

    return view('votante.index', compact('votantes', 'elecciones'))
        ->with('eleccionId', $eleccionId);
}

}