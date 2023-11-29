<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\User;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::latest()->paginate(20); // Puedes ajustar la paginación según tus necesidades
        $usuariosRegistrados = User::all(); // Obtén todos los usuarios registrados

        return view('logs.index', compact('logs', 'usuariosRegistrados'));
    }

    public function filter(Request $request)
    {
        // Validación de datos
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'nombreusuario' => 'nullable|exists:users,id',
            'query' => 'nullable|string',
        ]);

        // Obtener los parámetros de búsqueda
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $userId = $request->input('nombreusuario');
        $query = $request->input('query');

        // Construir la consulta basada en los parámetros de búsqueda
        $logsQuery = Log::query();

        if ($startDate) {
            $logsQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $logsQuery->whereDate('created_at', '<=', $endDate);
        }

        if ($userId) {
            $logsQuery->where('user_id', $userId);
        }

        if ($query) {
            $logsQuery->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('action', 'LIKE', "%$query%")
                             ->orWhere('table_name', 'LIKE', "%$query%");
            });
        }

        // Obtener los resultados paginados
        $logs = $logsQuery->latest()->paginate(20);

        // Obtén todos los usuarios registrados para el menú desplegable
        $usuariosRegistrados = User::all();

        return view('logs.index', compact('logs', 'usuariosRegistrados'))
            ->with('query', $query); // Pasa la consulta para mantenerla en el formulario
    }
}
