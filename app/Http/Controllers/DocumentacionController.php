<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentacion;
use App\Models\Eleccion;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DocumentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$documentaciones = Documentacion::with('idEleccionD')->get();
        $fechaActual = Carbon::today('America/La_Paz');
        $documentaciones = Documentacion::with('eleccion')->where('estado', 1)
            ->orderBy('inicio', 'asc')
            ->paginate(5);
        return view('documentacion.index', compact('documentaciones'));
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('documentacion.create', compact('elecciones'));
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
        'titulo' => 'required',
        'pdf' => 'max:2048'
    ],[
        'pdf.max' => 'El archivo PDF no debe superar los 2 MB.',
        'pdf.uploaded' => 'PDF máximo: 2048 KB.',
    ]);        

    $datos = request()->except('_token');

    if ($request->hasFile('pdf')) {
        $titulo = Str::slug($request->input('titulo')); 
        $pdfPath = $request->file('pdf')->storeAs('uploads', $titulo . '.pdf', 'public');
        $datos['pdf'] = $pdfPath;
    }

    $fechaActual = Carbon::today('America/La_Paz');
    $datos['estado'] = $request->input('estado', 1);
    $datos['inicio'] = $request->input('inicio', $fechaActual);

    Documentacion::insert($datos);

    return redirect('/documentaciones')->with('success', 'El documento se ha guardado con éxito.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function show(Documentacion $documentacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentacion=Documentacion::FindOrFail($id);
        $elecciones = Eleccion::where('estado', 1)->get();
        return view('documentacion.edit', compact('documentacion','elecciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {

    $request->validate([
        'titulo' => 'required|max:255',
        'idEleccionD' => 'required',
        'pdf' => 'max:2048',
        ], [
            'pdf.max' => 'El archivo PDF no debe superar los 2 MB.',
            'pdf.uploaded' => 'PDF máximo: 2048 KB.',
    ]); 

    if ($request->hasFile('pdf')) {
        $titulo = Str::slug($request->input('titulo')) . '-' . $id;
        $pdfPath = $request->file('pdf')->storeAs('uploads', $titulo . '.pdf', 'public');
        $request->merge(['pdf' => $pdfPath]);
    }

    Documentacion::where('id', $id)->update($request->except(['_token', '_method']));

    return redirect('/documentaciones');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentacion=Documentacion::FindOrFail($id);
        $documentacion-> estado = 0;
        $documentacion->save();
        return redirect('/documentaciones');
    }
}