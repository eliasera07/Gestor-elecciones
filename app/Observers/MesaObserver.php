<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Mesa; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class MesaObserver
{
    public function created(Mesa $mesa)
    {
        $this->logActivity('created', $mesa);
    }

    public function updated(Mesa $mesa)
    {
        $this->logActivity('updated', $mesa);
    }

    public function deleted(Mesa $mesa)
    {
        $this->logActivity('deleted', $mesa);
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
