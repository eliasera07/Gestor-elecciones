<?php

namespace App\Observers;


use App\Models\Log;
use App\Models\Eleccion; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class EleccionObserver
{
    public function created(Eleccion $eleccion)
    {
        $this->logActivity('created', $eleccion);
    }

    public function updated(Eleccion $eleccion)
    {
        $this->logActivity('updated', $eleccion);
    }

    public function deleted(Eleccion $eleccion)
    {
        $this->logActivity('deleted', $eleccion);
    }

    protected function logActivity($action, $model)
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'table_name' => $model->getTable(),
            'record_id' => $model->id,
            'old_data' => json_encode($model->getOriginal()), 
            'new_data' => json_encode($model->getAttributes()), 
        ]);
    }
}
