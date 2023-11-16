<?php

namespace App\Http\Controllers;
use Illuminate\Support\Optional;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Models\Eleccion;
use App\Models\Votante;
use App\Models\Jurado;
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
        // Validación
        $request->validate([
            'id_de_eleccion' => [
                'required',
                Rule::unique('mesas')->where(function ($query) use ($request) {
                    return $query->where('id_de_eleccion', $request->input('id_de_eleccion'));
                }),
            ],
        ]);
    
        $idDeEleccion = $request->input('id_de_eleccion');
    
        // Encuentra el tipo de votantes de la elección
        $eleccion = Eleccion::find($idDeEleccion);
        $tipoVotantes = strtolower($eleccion->tipodevotantes); // Convertir a minúsculas
    
        // Encuentra el número total de votantes registrados para esta elección
        $votantes = Votante::where('ideleccion', $idDeEleccion)->orderBy('apellidoPaterno')->get();
        $totalVotantes = $votantes->count();
    
        // Calcula la cantidad de votantes por mesa
        $cantidadMesas = ceil($totalVotantes / 100); // 100 votantes por mesa
        $votantesPorMesa = ceil($totalVotantes / $cantidadMesas);
    
        // Lógica de asignación de mesas
        if ($totalVotantes <= 99) {
            // Caso: Menos o igual a 99 votantes, crea una sola mesa
            $datosMesas = request()->except('_token');
            $datosMesas['numeromesa'] = 1; // Número de mesa
            $datosMesas['numerodevotantes'] = $totalVotantes; // Asigna todos los votantes
            $datosMesas['id_de_eleccion'] = $idDeEleccion; // Asigna el id de la elección
    
            // Asignar el apellido del primer y último votante a la columna votantesenmesa
            $primerVotante = $votantes->first();
            $ultimoVotante = $votantes->last();
    
            if ($primerVotante && $ultimoVotante) {
                $datosMesas['votantesenmesa'] = "De {$primerVotante->apellidoPaterno} Hasta {$ultimoVotante->apellidoPaterno}";
            }
    
            // Asignar el tipo de votantes a la columna votantemesa
            $datosMesas['votantemesa'] = $primerVotante->tipoVotante;
    
            Mesa::insert($datosMesas);
        } else {
            // Caso: Más de 99 votantes, asigna mesas equitativamente
    
            // Lógica específica para el tipo "General"
            if ($tipoVotantes == 'general') {
                $votantesEstudiantes = $votantes->where('tipoVotante', 'estudiante');
                $votantesDocentes = $votantes->where('tipoVotante', 'docente');
    
                $mesaActual = 1;
    
                // Asignar mesas para estudiantes
                for ($i = 0; $i < $cantidadMesas; $i++) {
                    $datosMesas = request()->except('_token');
                    $datosMesas['numeromesa'] = $mesaActual;
                    $datosMesas['numerodevotantes'] = $votantesPorMesa;
                    $datosMesas['id_de_eleccion'] = $idDeEleccion; // Asigna el id de la elección
                    $datosMesas['votantemesa'] = 'estudiante'; // Cambiado a la columna correcta
    
                    // Asignar el apellido del primer votante a la columna votantesenmesa
                    $primerVotante = $votantesEstudiantes->slice($i * $votantesPorMesa)->first();
    
                    // Asignar el apellido del último votante a la columna votantesenmesa
                    $ultimoVotante = $votantesEstudiantes->slice($i * $votantesPorMesa, $votantesPorMesa)->last();
    
                    if ($primerVotante && $ultimoVotante) {
                        $datosMesas['votantesenmesa'] = "De {$primerVotante->apellidoPaterno} Hasta {$ultimoVotante->apellidoPaterno}";
                    }
    
                    Mesa::insert($datosMesas);
    
                    $mesaActual++;
                }
    
                // Asignar una mesa para todos los docentes (solo si hay docentes registrados)
                if ($votantesDocentes->count() > 0) {
                    $datosMesas = request()->except('_token');
                    $datosMesas['numeromesa'] = $mesaActual; // Se asigna una nueva mesa
                    $datosMesas['numerodevotantes'] = $votantesDocentes->count();
                    $datosMesas['id_de_eleccion'] = $idDeEleccion; // Asigna el id de la elección
                    $datosMesas['votantemesa'] = 'docente'; // Cambiado a la columna correcta
    
                    // Asignar el apellido del primer votante a la columna votantesenmesa
                    $primerVotanteDocente = $votantesDocentes->first();
    
                    // Asignar el apellido del último votante a la columna votantesenmesa
                    $ultimoVotanteDocente = $votantesDocentes->last();
    
                    if ($primerVotanteDocente && $ultimoVotanteDocente) {
                        $datosMesas['votantesenmesa'] = "De {$primerVotanteDocente->apellidoPaterno} Hasta {$ultimoVotanteDocente->apellidoPaterno}";
                    }
    
                    Mesa::insert($datosMesas);
                }
            } else {
                // Caso: Otros tipos de votantes, asigna mesas según la lógica actual
                $mesaActual = 1;
    
                for ($i = 0; $i < $cantidadMesas; $i++) {
                    $datosMesas = request()->except('_token');
                    $datosMesas['numeromesa'] = $mesaActual;
                    $datosMesas['numerodevotantes'] = $votantesPorMesa;
                    $datosMesas['id_de_eleccion'] = $idDeEleccion; // Asigna el id de la elección
                    $datosMesas['votantemesa'] = ''; // Cambiado a la columna correcta (puedes asignar un valor según tu lógica)
    
                    // Asignar el apellido del primer votante a la columna votantesenmesa
                    $primerVotante = $votantes->slice($i * $votantesPorMesa)->first();
    
                    // Asignar el apellido del último votante a la columna votantesenmesa
                    $ultimoVotante = $votantes->slice($i * $votantesPorMesa, $votantesPorMesa)->last();
    
                    if ($primerVotante && $ultimoVotante) {
                        $datosMesas['votantesenmesa'] = "De {$primerVotante->apellidoPaterno} Hasta {$ultimoVotante->apellidoPaterno}";
                    }
    
                    Mesa::insert($datosMesas);
    
                    $mesaActual++;
                }
            }
        }

    return redirect('/mesas')->with('success', 'Las mesas se han guardado con éxito.');
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
    $cantidadTitulares = 1;
    $cantidadPresidente = 1;

    // Obtén la elección asociada a la mesa
    $eleccion = Eleccion::find($mesa->id_de_eleccion);

    if (!$eleccion) {
        return redirect('/mesas')->with('error', 'No se encontró la elección asociada a esta mesa.');
    }

    // Verificar si la elección no es de tipo "General"
    if ($eleccion->tipodevotantes !== 'General') {
        // Si no es de tipo "General", asigna aleatoriamente los 5 jurados
        $this->generateJuradosRandomly($mesa->numeromesa, $eleccion->id, $cantidadSuplentes + $cantidadTitulares + $cantidadPresidente);

        return redirect('/mesas/' . $id . '/lista-jurados')->with('success', 'Se han generado los jurados con éxito.');
    }

    // Generar jurados de tipo 'Docente'
    $this->generateJuradosByType($mesa->numeromesa, $eleccion->id, 'docente', $cantidadSuplentes, $cantidadTitulares, $cantidadPresidente);

    // Generar jurados de tipo 'Estudiante'
    $this->generateJuradosByType($mesa->numeromesa, $eleccion->id, 'estudiante', 1, 1, 0);

    // Asignar los jurados que faltan en caso de elección no general
    $this->assignAdditionalJurados($mesa->numeromesa, $eleccion->id, $cantidadSuplentes, $cantidadTitulares, $cantidadPresidente);

    return redirect('/mesas/' . $id . '/lista-jurados')->with('success', 'Se han generado los jurados con éxito.');
}

// Nueva función para asignar jurados adicionales en caso de elección no general
private function assignAdditionalJurados($idMesa, $idEleccion, $cantidadSuplentes, $cantidadTitulares, $cantidadPresidente)
{
    $totalJurados = $cantidadSuplentes + $cantidadTitulares + $cantidadPresidente;
    $juradosActuales = Jurado::where('idmesa', $idMesa)->count();

    // Calcular cuántos jurados faltan asignar
    $faltanAsignar = $totalJurados - $juradosActuales;

    if ($faltanAsignar > 0) {
        $this->generateJuradosRandomly($idMesa, $idEleccion, $faltanAsignar);
    }
}

// Función para generar jurados aleatoriamente
private function generateJuradosRandomly($idMesa, $idEleccion, $cantidadJurados)
{
    $votantes = Votante::where('ideleccion', $idEleccion)
        ->inRandomOrder()
        ->limit($cantidadJurados)
        ->get();

    // Contadores para cada tipo de jurado
    $contadorSuplentes = 0;
    $contadorTitulares = 0;
    $contadorPresidente = 0;

    $i = 0; // Contador general

    foreach ($votantes as $votante) {
        // Ajuste para el nombre del presidente
        $tipoJurado = '';
        $nombreJurado = '';

        // Asignar tipo de jurado según disponibilidad
        if ($contadorSuplentes < 2) {
            $tipoJurado = 'Suplente';
            $nombreJurado = 'Suplente ' . ucfirst(strtolower($votante->tipoVotante));
            $contadorSuplentes++;
        } elseif ($contadorTitulares < 2) {
            $tipoJurado = 'Titular';
            $nombreJurado = 'Titular ' . ucfirst(strtolower($votante->tipoVotante));
            $contadorTitulares++;
        } elseif ($contadorPresidente < 1) {
            $tipoJurado = 'Presidente';
            $nombreJurado = 'Presidente';
            $contadorPresidente++;
        }

        // Crear el jurado
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

        // Incrementar el contador general
        $i++;

        // Detener la asignación si se alcanza la cantidad necesaria para cada tipo de jurado
        if ($contadorSuplentes >= 2 && $contadorTitulares >= 2 && $contadorPresidente >= 1) {
            break;
        }
    }

    // Mensaje de depuración
    dd("Se asignaron $i jurados: $contadorSuplentes suplentes, $contadorTitulares titulares, $contadorPresidente presidente");
}

// Función para generar jurados por tipo
private function generateJuradosByType($idMesa, $idEleccion, $tipoVotante, $cantidadSuplentes, $cantidadTitulares, $cantidadPresidente)
{
    $query = Votante::where('ideleccion', $idEleccion);

    if ($tipoVotante) {
        $query->whereRaw('LOWER(tipoVotante) = ?', [$tipoVotante]);
    }

    $votantes = $query->inRandomOrder()
        ->limit($cantidadSuplentes + $cantidadTitulares + $cantidadPresidente)
        ->get();

    $votantes = $votantes->shuffle();

    $tiposJurado = ['Suplente', 'Titular', 'Presidente'];

    $i = 0;

    foreach ($votantes as $votante) {
        $tipoJurado = $tiposJurado[$i];

        // Ajuste para el nombre del presidente
        if ($tipoJurado === 'Presidente') {
            $nombreJurado = $tipoJurado;
        } else {
            $nombreJurado = $tipoJurado . ' ' . ucfirst($tipoVotante);
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

        if ($i >= ($cantidadSuplentes + $cantidadTitulares + $cantidadPresidente)) {
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


}