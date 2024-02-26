<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Comunicado; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class ComunicadoObserver
{
    public function created(Comunicado $comunicado)
    {
        $this->logActivity('created', $comunicado);
    }

    public function updated(Comunicado $comunicado)
    {
        $this->logActivity('updated', $comunicado);
    }

    public function deleted(Comunicado $comunicado)
    {
        $this->logActivity('deleted', $comunicado);
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
