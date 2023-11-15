<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Eleccion;
use App\Models\Votante;
use App\Models\Frente;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->tipo);

        $tipo = $request->input('tipo');
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        
        $fechas = compact('tipo', 'fecha_inicio', 'fecha_fin');
        $request->session()->put('fechas', $fechas);

        if($request->tipo != null){
            $registros = Eleccion::whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])->get();
        
            $nroVotantesPorRegistro = [];
            $frentesG= [];

            foreach ($registros as $registro) {
                $nroVotantes = Votante::where('ideleccion', $registro->id)->count();
                $nroVotantesPorRegistro[$registro->id] = $nroVotantes;
            
                $frentes = Frente::where('ideleccionfrente', $registro->id)->get();
            
                if ($frentes->isNotEmpty() && $nroVotantes > 0 ) {
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

                    $frentesG[$registro->id] = $frenteGanador;
                } else {
                    $frentesG[$registro->id] = null;
                }
            }

            $request->session()->put('registros', $registros);

            if($request->tipo == 'Reporte por frentes'){
            
                $vista = 'reporte';
    
            }else if($request->tipo  == 'Numero de votos'){
    
                $vista = 'reporteVotos';
    
            }

            return view('elecciones.'.$vista, [
                'fechas' => $fechas,
                'registros' => $registros,
                'nroVotantesPorRegistro'=> $nroVotantesPorRegistro,
                'frentesG' => $frentesG,
                'fechas' => $fechas
            ]);

        }else{
            $registros = null;
        }

        return view('elecciones.reporte', [
            'fechas' => $fechas,
            'registros' => $registros,
        ]);        
    }

    public function reporteGrafico(Request $request, $registroId)
    {
        $registros = $request->session()->get('registros');
        $fechas = $request->session()->get('fechas');
        
        $nroVotantesPorRegistro = [];
        $frentesG= [];
        $grafico = Eleccion::find($registroId);
        foreach ($registros as $registro) {
            $nroVotantes = Votante::where('ideleccion', $registro->id)->count();
            $nroVotantesPorRegistro[$registro->id] = $nroVotantes;
        
            $frentes = Frente::where('ideleccionfrente', $registro->id)->get();
        
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
                $frentesG[$registro->id] = $frenteGanador;
            } else {

                $frentesG[$registro->id] = null;
            }
        }

        //dd($nroVotantes);
        //dd($registroId);
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
        
        if($fechas['tipo'] == 'Reporte por frentes'){
            
            $vista = 'reporteGrafico';

        }else if($fechas['tipo']  == 'Numero de votos'){

            $vista = 'reporteVotosGrafico';

        }

        return view('elecciones.' . $vista, compact('data', 'registros', 'nroVotantesPorRegistro', 'frentesG', 'fechas'));
    }        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}