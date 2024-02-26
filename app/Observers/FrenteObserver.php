<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Frente; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class FrenteObserver
{
    public function created(Frente $frente)
    {
        $this->logActivity('created', $frente);
    }

    public function updated(Frente $frente)
    {
        $this->logActivity('updated', $frente);
    }

    public function deleted(Frente $frente)
    {
        $this->logActivity('deleted', $frente);
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
