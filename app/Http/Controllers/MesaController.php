<?php

namespace App\Http\Controllers;
use Illuminate\Support\Optional;
use Illuminate\Validation\Rule;

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
        $mesascreadas = Mesa::orderBy('id_de_eleccion', 'asc')->paginate(20);
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
    $totalVotantes = Votante::where('ideleccion', $idDeEleccion)->count();

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
        Mesa::insert($datosMesas);
    } else {
        // Caso: Más de 99 votantes, asigna mesas equitativamente

        // Lógica específica para el tipo "General"
        if ($tipoVotantes == 'general') {
            // Calcula el número total de votantes por tipo (estudiante y docente)
            $totalVotantesEstudiantes = Votante::where('ideleccion', $idDeEleccion)
                ->where('tipoVotante', 'estudiante')->count();
            $totalVotantesDocentes = Votante::where('ideleccion', $idDeEleccion)
                ->where('tipoVotante', 'docente')->count();

            // Asignar mesas para estudiantes
            for ($i = 1; $i <= $cantidadMesas; $i++) {
                $datosMesas = request()->except('_token');
                $datosMesas['numeromesa'] = $i;
                $datosMesas['numerodevotantes'] = ceil($totalVotantesEstudiantes / $cantidadMesas);
                $datosMesas['id_de_eleccion'] = $idDeEleccion; // Asigna el id de la elección
                $datosMesas['votantemesa'] = 'estudiante'; // Cambiado a la columna correcta
                Mesa::insert($datosMesas);
            }

            // Asignar una mesa para todos los docentes (solo si hay docentes registrados)
            if ($totalVotantesDocentes > 0) {
                $datosMesas = request()->except('_token');
                $datosMesas['numeromesa'] = $cantidadMesas + 1; // Se asigna una nueva mesa
                $datosMesas['numerodevotantes'] = $totalVotantesDocentes;
                $datosMesas['id_de_eleccion'] = $idDeEleccion; // Asigna el id de la elección
                $datosMesas['votantemesa'] = 'docente'; // Cambiado a la columna correcta
                Mesa::insert($datosMesas);
            }
        } else {
            // Caso: Otros tipos de votantes, asigna mesas según la lógica actual
            for ($i = 1; $i <= $cantidadMesas; $i++) {
                $datosMesas = request()->except('_token');
                $datosMesas['numeromesa'] = $i;
                $datosMesas['numerodevotantes'] = $votantesPorMesa;
                $datosMesas['id_de_eleccion'] = $idDeEleccion; // Asigna el id de la elección
                $datosMesas['votantemesa'] = ''; // Cambiado a la columna correcta (puedes asignar un valor según tu lógica)
                Mesa::insert($datosMesas);
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
    $cantidadSuplentes = 3;
    $cantidadTitulares = 3;
    $cantidadPresidente = 1;

    // Obtén los votantes disponibles para esta mesa
    $votantes = Votante::where('ideleccion', $mesa->id_de_eleccion)
        ->whereNotIn('codSis', Jurado::where('iddeeleccion', $mesa->id_de_eleccion)->pluck('codSis'))
        ->whereNotIn('CI', Jurado::where('iddeeleccion', $mesa->id_de_eleccion)->pluck('CI'))
        ->inRandomOrder()
        ->limit($cantidadSuplentes + $cantidadTitulares + $cantidadPresidente)
        ->get();

    // Baraja los votantes aleatoriamente
    $votantes = $votantes->shuffle();

    $i = 0;
    $tiposJurado = ['Suplente', 'Titular', 'Titular', 'Suplente', 'Titular', 'Suplente', 'Presidente'];

    // Itera sobre los votantes para asignarlos como jurados
    foreach ($votantes as $votante) {
        $tipoJurado = $tiposJurado[$i];

        // Crea una nueva entrada en la tabla de jurados
        Jurado::create([
            'iddeeleccion' => $votante->ideleccion,
            'idmesa' => $mesa->numeromesa,
            'nombres' => $votante->nombres,
            'apellidoPaterno' => $votante->apellidoPaterno,
            'apellidoMaterno' => $votante->apellidoMaterno,
            'codSis' => $votante->codSis,
            'CI' => $votante->CI,
            'tipoJurado' => $tipoJurado,
        ]);

        $i++;
    }

    return redirect('/mesas/' . $id . '/lista-jurados')->with('success', 'Se han generado los jurados con éxito.');
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