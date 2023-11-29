<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Comite; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class ComiteObserver
{
    public function created(Comite $comite)
    {
        $this->logActivity('created', $comite);
    }

    public function updated(Comite $comite)
    {
        $this->logActivity('updated', $comite);
    }

    public function deleted(Comite $comite)
    {
        $this->logActivity('deleted', $comite);
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
