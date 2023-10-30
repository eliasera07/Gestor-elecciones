<?php

namespace App\Http\Controllers;
use Illuminate\Support\Optional;

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
        //
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('mesas.create', compact('elecciones'));
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
        'id_de_eleccion' => 'required',
    ]);

    $idDeEleccion = $request->input('id_de_eleccion');

    // Encuentra el último número de mesa registrado para esta elección
    $ultimoNumeroMesa = Mesa::where('id_de_eleccion', $idDeEleccion)
        ->max('numeromesa');

    $nuevoNumeroMesa = $ultimoNumeroMesa + 1;
    
    $datosMesas = request()->except('_token');
    $datosMesas['numeromesa'] = $nuevoNumeroMesa;

    Mesa::insert($datosMesas);

    return redirect('/mesas')->with('success', 'La mesa se ha guardado con éxito.');
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
        //
        $mesas = Mesa::findOrFail($id);
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('mesas.edit', compact('mesas', 'elecciones'));
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
        $request->validate([
            'id_de_eleccion' => 'required',
        ]);
    
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
    $votantes = Votante::where('ideleccion', $mesa->id_de_eleccion)->inRandomOrder()->limit($cantidadSuplentes + $cantidadTitulares + $cantidadPresidente)->get();

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