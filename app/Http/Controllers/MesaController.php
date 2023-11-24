<?php

namespace App\Http\Controllers;
use Illuminate\Support\Optional;
use Illuminate\Validation\Rule;
//use Illuminate\Support\Facades\DB;

use DateTime;
use DateInterval;
use App\Models\Eleccion;
use App\Models\Frente;
use App\Models\Votante;
use App\Models\Jurado;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $mesascreadas = Mesa::orderBy('id_de_eleccion', 'asc')->paginate(100);
        return view('mesas.index', compact('mesascreadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $elecciones = Eleccion::where('estado', 1)->get();
    $editar = false; // Establecer a false para modo de creación
    return view('mesas.create', compact('elecciones', 'editar'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $idDeEleccion = $request->input('id_de_eleccion');
    $numeroMesas = $request->input('numeroMesas');
    $carrera = $request->input('carreramesa');

    // Encuentra el número más alto de mesa para esta elección
    $ultimaMesa = Mesa::where('id_de_eleccion', $idDeEleccion)->max('numeromesa');

    // Ajusta el contador para iniciar desde la última mesa + 1
    $mesaActual = $ultimaMesa ? $ultimaMesa + 1 : 1;

    // Encuentra el número total de votantes registrados para esta elección
    $votantes = Votante::where('ideleccion', $idDeEleccion)->orderBy('apellidoPaterno')->get();
    $totalVotantes = $votantes->count();

    // Validar si hay votantes registrados
    if ($totalVotantes == 0) {
        // No hay votantes, redirigir con un mensaje personalizado
        return redirect('/mesas')->with('error', 'No hay votantes registrados en esta elección. Seleccione otra elección que tenga votantes.');
    }

    // Validación
    $request->validate([
        'id_de_eleccion' => [
            'required',
            Rule::unique('mesas')->where(function ($query) use ($request, $carrera) {
                return $query->where('id_de_eleccion', $request->input('id_de_eleccion'))
                    ->where('carreramesa', $carrera);
            }),
        ],
        'carreramesa' => 'required',
    ]);

    // Obtén todos los números de mesa para esta elección
    $numerosDeMesaExistente = Mesa::where('id_de_eleccion', $idDeEleccion)->pluck('numeromesa')->toArray();

    // Encuentra el tipo de votantes de la elección
    $eleccion = Eleccion::find($idDeEleccion);
    $tipoVotantes = strtolower($eleccion->tipodevotantes); // Convertir a minúsculas

    // Lógica de asignación de mesas
    if ($totalVotantes <= 99 && $numeroMesas > 0) {
        // Caso: Menos o igual a 99 votantes, crea la cantidad de mesas indicadas por el usuario
        for ($i = 1; $i <= $numeroMesas; $i++) {
            // Encuentra el próximo número de mesa disponible
            $mesaActual = $this->obtenerProximoNumeroMesa($numerosDeMesaExistente);

            $datosMesas = $request->except('_token', 'numeroMesas');
            $datosMesas['numeromesa'] = $mesaActual;
            $datosMesas['id_de_eleccion'] = $idDeEleccion;

            // Otras asignaciones que puedan necesitar aquí

            Mesa::insert($datosMesas);

            // Agrega el número de mesa actual a la lista
            $numerosDeMesaExistente[] = $mesaActual;
        }
    } elseif ($totalVotantes > 99) {
        // Caso: Más de 99 votantes, asigna mesas según la lógica actual
        // Obtén la última mesa asignada en la misma elección y carrera
        $ultimaMesaAsignada = Mesa::where('id_de_eleccion', $idDeEleccion)
            ->where('carreramesa', $carrera)
            ->max('numeromesa');

        // Ajusta el contador para iniciar desde la última mesa + 1
        $mesaActual = $ultimaMesaAsignada ? $ultimaMesaAsignada + 1 : $mesaActual;

        // Lógica específica para el tipo "General"
        if ($tipoVotantes == 'general') {
            $votantesEstudiantes = $votantes->where('tipoVotante', 'estudiante')->where('carrera', $carrera);
            $votantesDocentes = $votantes->where('tipoVotante', 'docente')->where('carrera', $carrera);
            $votantesAdministrativos = $votantes->where('tipoVotante', 'administrativo')->where('carrera', $carrera);

            // Asignar mesas para estudiantes
            $mesaActual = $this->asignarMesasPorTipo($mesaActual, $votantesEstudiantes, $numeroMesas, $idDeEleccion, 'estudiante', $carrera, $request);

            $mesaActual = $this->asignarMesasParaDocentes($mesaActual, $votantesDocentes, $idDeEleccion, $request, $carrera);

            $mesaActual = $this->asignarMesasPorTipo($mesaActual, $votantesAdministrativos, $numeroMesas, $idDeEleccion, 'administrativo', $carrera, $request);
        } else {
            // Caso: Otros tipos de votantes, asigna mesas según la lógica actual
            $mesaActual = $this->asignarMesasPorTipo($mesaActual, $votantes, $numeroMesas, $idDeEleccion, '', $carrera, $request);
        }
    }

    return redirect('/mesas')->with('success', 'Las mesas se han guardado con éxito.');
}
    
    // Función actualizada para asignar mesas por tipo
    private function asignarMesasPorTipo($mesaActual, $votantes, $numeroMesas, $idDeEleccion, $tipoVotante, $carrera, $request)
{
    $votantesTipo = $votantes->where('tipoVotante', $tipoVotante);

    // Verificar si hay votantes del tipo especificado
    if ($votantesTipo->count() > 0) {
        for ($i = 1; $i <= $numeroMesas; $i++) {
            $datosMesas = $request->except('_token', 'numeroMesas');
            $datosMesas['numeromesa'] = $mesaActual;
            $datosMesas['id_de_eleccion'] = $idDeEleccion;
            $datosMesas['votantemesa'] = $tipoVotante;

            // Asignar el apellido del primer votante a la columna votantesenmesa
            $primerVotante = $votantesTipo->slice(($i - 1) * ceil($votantesTipo->count() / $numeroMesas))->first();

            // Asignar el apellido del último votante a la columna votantesenmesa
            $ultimoVotante = $votantesTipo->slice(($i - 1) * ceil($votantesTipo->count() / $numeroMesas), ceil($votantesTipo->count() / $numeroMesas))->last();

            if ($primerVotante && $ultimoVotante) {
                $datosMesas['votantesenmesa'] = "De {$primerVotante->apellidoPaterno} Hasta {$ultimoVotante->apellidoPaterno}";
            }

            // Asigna la cantidad correcta de votantes a la mesa
            $votantesAsignados = min(ceil($votantesTipo->count() / $numeroMesas), $votantesTipo->count() - (($i - 1) * ceil($votantesTipo->count() / $numeroMesas)));
            $datosMesas['numerodevotantes'] = $votantesAsignados;

            Mesa::insert($datosMesas);

            $mesaActual++;
        }
    }

    return $mesaActual;
}
    
private function asignarMesasParaDocentes($mesaActual, $votantesDocentes, $idDeEleccion, $request, $carrera)
{
    // Verificar si hay votantes docentes con la carrera especificada
    $votantesDocentesCarrera = $votantesDocentes->where('carrera', $carrera);

    if ($votantesDocentesCarrera->count() > 0) {
        $datosMesas = $request->except('_token', 'numeroMesas');
        $datosMesas['numeromesa'] = $mesaActual;
        $datosMesas['id_de_eleccion'] = $idDeEleccion;
        $datosMesas['votantemesa'] = 'docente';

        // Obtener el primer y último docente
        $primerDocente = $votantesDocentesCarrera->first();
        $ultimoDocente = $votantesDocentesCarrera->last();

        // Asignar el apellido del primer votante a la columna votantesenmesa
        // Asignar el apellido del último votante a la columna votantesenmesa
        if ($primerDocente && $ultimoDocente) {
            $datosMesas['votantesenmesa'] = "De {$primerDocente->apellidoPaterno} Hasta {$ultimoDocente->apellidoPaterno}";
        }

        // Asigna la cantidad correcta de votantes a la mesa
        $datosMesas['numerodevotantes'] = $votantesDocentesCarrera->count();

        Mesa::insert($datosMesas);

        // Incrementar el número de mesa después de insertar los datos
        $mesaActual++;
    }

    return $mesaActual;
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
    $mesas = Mesa::findOrFail($id);
    $elecciones = Eleccion::where('estado', 1)->get();
    $editar = true; // Indica que estamos en modo de edición

    return view('mesas.edit', compact('mesas', 'elecciones', 'editar'));
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

    public function generateJurados($id)
{
    $mesa = Mesa::find($id);

    if (!$mesa) {
        return redirect('/mesas')->with('error', 'Mesa no encontrada');
    }

    // Obtén la cantidad de jurados que deseas generar
    $cantidadSuplentes = 1;
    $cantidadTitulares = 2;
    $cantidadPresidente = 2;

    // Obtén la elección asociada a la mesa
    $eleccion = Eleccion::find($mesa->id_de_eleccion);

    if (!$eleccion) {
        return redirect('/mesas')->with('error', 'No se encontró la elección asociada a esta mesa.');
    }

    // Verificar si el tipo de votantes es "General"
    if (strtolower($eleccion->tipodevotantes) === 'general') {
        // Generar jurados de tipo 'Docente'
        $this->generateJuradosByType($mesa->numeromesa, $eleccion->id, 'docente', $cantidadSuplentes, $cantidadTitulares, $cantidadPresidente);

        // Generar jurados de tipo 'Estudiante'
        $this->generateJuradosByType($mesa->numeromesa, $eleccion->id, 'estudiante', 1, 1, 0);
    } else {
        // Generar jurados sin tener en cuenta el tipo de votante
        $this->generateJuradosByType($mesa->numeromesa, $eleccion->id, null, $cantidadSuplentes, $cantidadTitulares, $cantidadPresidente);
    }

    return redirect('/mesas/' . $id . '/lista-jurados')->with('success', 'Se han generado los jurados con éxito.');
}

// Función para generar jurados por tipo
private function generateJuradosByType($idMesa, $idEleccion, $tipoVotante, $cantidadSuplentes, $cantidadTitulares, $cantidadPresidente)
{
    // Verificar la cantidad actual de jurados asignados a la mesa y elección
    $juradosAsignados = Jurado::where('idmesa', $idMesa)
        ->where('iddeeleccion', $idEleccion)
        ->count();

    // Calcular la cantidad máxima de jurados que se pueden asignar
    $cantidadMaxima = 5 - $juradosAsignados;

    // Si no hay espacio para más jurados, no hacer más asignaciones
    if ($cantidadMaxima <= 0) {
        return;
    }

    $votantesQuery = Votante::where('ideleccion', $idEleccion);

    // Si se especifica un tipoVotante, agregar la condición
    if ($tipoVotante !== null) {
        $votantesQuery->whereRaw('LOWER(tipoVotante) = ?', [$tipoVotante]);
    }

    $votantes = $votantesQuery
        ->whereNotIn('codSis', function ($query) use ($idEleccion) {
            $query->select('codSis')
                ->from('jurados')
                ->where('iddeeleccion', $idEleccion);
        })
        ->whereNotIn('CI', function ($query) use ($idEleccion) {
            $query->select('CI')
                ->from('jurados')
                ->where('iddeeleccion', $idEleccion);
        })
        ->inRandomOrder()
        ->limit(min($cantidadMaxima, $cantidadSuplentes + $cantidadTitulares + $cantidadPresidente))
        ->get();

    $votantes = $votantes->shuffle();
    
    $tiposJurado = ['Suplente', 'Titular', 'Presidente'];

    $i = 0;

    foreach ($votantes as $votante) {
        // Obtener el tipo de jurado de manera segura
        $tipoJurado = isset($tiposJurado[$i]) ? $tiposJurado[$i] : null;
    
        // Ajuste para el nombre del presidente
        if ($tipoJurado === 'Presidente') {
            $nombreJurado = $tipoJurado;
        } else {
            $nombreJurado = $tipoJurado === null ? 'Jurado' : $tipoJurado . ' ' . ucfirst($tipoVotante);
        }
    
        Jurado::create([
            'iddeeleccion' => $votante->ideleccion,
            'idmesa' => $idMesa,
            'nombres' => $votante->nombres,
            'apellidoPaterno' => $votante->apellidoPaterno,
            'apellidoMaterno' => $votante->apellidoMaterno,
            'codSis' => $votante->codSis,
            'CI' => $votante->CI,
            'tipoJurado' => $nombreJurado,
        ]);
    
        $i++;
    
        if ($i >= count($tiposJurado) || $i >= ($cantidadSuplentes + $cantidadTitulares + $cantidadPresidente)) {
            break;
        }
    }
}
    
    

public function listaJurados($id)
{
    $mesa = Mesa::find($id);

    if (!$mesa) {
        return redirect('/mesas')->with('error', 'Mesa no encontrada');
    }

    // Obtén los jurados de esta mesa ordenados por tipo
    $jurados = Jurado::where('iddeeleccion', $mesa->id_de_eleccion)
        ->where('idmesa', $mesa->numeromesa)
        ->orderBy('tipojurado', 'asc')
        ->get();

    // Obtén el nombre de la elección
    $eleccion = Eleccion::find($mesa->id_de_eleccion);

    return view('mesas.lista-jurados', compact('jurados', 'eleccion'));
}

public function visualizaracta($id)
    {
        //date_default_timezone_set('America/La_Paz');
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['error' => 'Mesa no encontrada'], 404);
        }

        // Obtener elección relacionada
        $eleccion = Eleccion::find($mesa->id_de_eleccion);
        
        setlocale(LC_TIME, 'es_ES');
        $fechaFormateada = strftime("%d  de %B de %Y", strtotime($eleccion->fecha));
        setlocale(LC_TIME, '');
        
        $horaActual = new DateTime();
        $horaActual->sub(new DateInterval('PT2H'));
        $horaActual = $horaActual->format('H:i');
        
        $frentes = Frente::where('ideleccionfrente', $mesa->id_de_eleccion)->get();
        $jurados = Jurado::where('iddeeleccion', $mesa->id_de_eleccion)
        ->where('idmesa', $mesa->numeromesa)
        ->orderBy('tipojurado', 'asc')
        ->get();

        return view('mesas.acta', compact('mesa', 'eleccion', 'frentes', 'jurados','horaActual','fechaFormateada'));
    }
    public function pdf($id)
    {
        
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['error' => 'Mesa no encontrada'], 404);
        }

        // Obtener elección relacionada
        $eleccion = Eleccion::find($mesa->id_de_eleccion);
        
        //Obtiene la fecha y cambia el formato a dia mes, año
        setlocale(LC_TIME, 'es_ES');
        $fechaFormateada = strftime("%d de %B de %Y", strtotime($eleccion->fecha));
        setlocale(LC_TIME, '');
        //Obtiene la hora y reduce 2 horas
        $horaActual = new DateTime();
        $horaActual->sub(new DateInterval('PT2H'));
        $horaActual = $horaActual->format('H:i');
        // Obtener los frentes relacionados con la elección
        $frentes = Frente::where('ideleccionfrente', $mesa->id_de_eleccion)->get();
        $jurados = Jurado::where('iddeeleccion', $mesa->id_de_eleccion)
        ->where('idmesa', $mesa->numeromesa)
        ->orderBy('tipojurado', 'asc')
        ->get();
        $pdf = PDF::loadView('mesas.actapdf', compact('mesa', 'eleccion', 'frentes', 'jurados','horaActual','fechaFormateada'));
        return $pdf->stream();
    }

}