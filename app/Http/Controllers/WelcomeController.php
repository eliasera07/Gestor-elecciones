<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunicado;

class WelcomeController extends Controller
{
    public function index()
    {
        $datos['comunicados'] = Comunicado::where('estado', 1)->paginate(10);
        return view('welcome', $datos);
    }   
}
