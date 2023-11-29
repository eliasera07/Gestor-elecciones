<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Votante; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class VotanteObserver
{
    public function created(Votante $votante)
    {
        $this->logActivity('created', $votante);
    }

    public function updated(Votante $votante)
    {
        $this->logActivity('updated', $votante);
    }

    public function deleted(Votante $votante)
    {
        $this->logActivity('deleted', $votante);
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
