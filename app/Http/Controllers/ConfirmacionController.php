<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmacionController extends Controller
{
    
    public function store(Request $request)
    {
        // Procesa el formulario aquí
    
        // Después de procesar el formulario con éxito, redirige al usuario a la página de confirmación
        return redirect()->route('confirmacion')->with('success', 'El registro ha sido completado con éxito');
    }
    public function index()
{
    return view('/home');
}

}
