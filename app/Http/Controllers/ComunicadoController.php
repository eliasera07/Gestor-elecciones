<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunicados = Comunicado::where('estado', 1)->get();
        $fechaActual = Carbon::today('America/La_Paz');

        foreach ($comunicados as $comunicado) {
            $fechaFinal = Carbon::parse($comunicado->fin);
            if ($fechaActual->greaterThanOrEqualTo($fechaFinal)) {
                $comunicado->estado = 0;
                $comunicado->save();
            }
        }
        $comunicados = Comunicado::where('estado', 1)
            ->orderBy('inicio', 'asc')
            ->paginate(5);

        return view('comunicado.index', compact('comunicados'));
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comunicado.create');
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
            'pdf' => 'max:2048',
        ], [
            'pdf.max' => 'El archivo PDF no debe superar los 2 MB.',
            'pdf.uploaded' => 'PDF máximo: 2048 KB.',
        ]);        

        $datos = $request->except('_token');
        
        if ($request->hasFile('pdf')) {
            $titulo = Str::slug($request->input('titulo')); 
            $pdfPath = $request->file('pdf')->storeAs('uploads', $titulo . '.pdf', 'public');
            $datos['pdf'] = $pdfPath;
        }
        
        $fechaActual = Carbon::today('America/La_Paz');
        $datos['estado'] = $request->input('estado', 1);
        $datos['inicio'] = $request->input('inicio', $fechaActual);

        Comunicado::create($datos);

        return redirect('/comunicados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function show(Comunicado $comunicado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comunicado=Comunicado::FindOrFail($id);
        return view('comunicado.edit', compact('comunicado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        if ($request->hasFile('pdf')) {
            $titulo = Str::slug($request->input('titulo')) . '-' . $id;
            $pdfPath = $request->file('pdf')->storeAs('uploads', $titulo . '.pdf', 'public');
            $datos['pdf'] = $pdfPath;
        }
        Comunicado::where('id',$id)->update($datos);
        return redirect('/comunicados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comunicado=Comunicado::FindOrFail($id);
        $comunicado-> estado = 0;
        $comunicado->save();
        return redirect('/comunicados');
    }
}
