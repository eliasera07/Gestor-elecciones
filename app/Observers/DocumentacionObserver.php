<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Documentacion; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class DocumentacionObserver
{
    public function created(Documentacion $documentacion)
    {
        $this->logActivity('created', $documentacion);
    }

    public function updated(Documentacion $documentacion)
    {
        $this->logActivity('updated', $documentacion);
    }

    public function deleted(Documentacion $documentacion)
    {
        $this->logActivity('deleted', $documentacion);
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
