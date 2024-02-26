<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Jurado; // Ajusta el modelo según sea necesario
use Illuminate\Support\Facades\Auth;

class JuradoObserver
{
    public function created(Jurado $jurado)
    {
        $this->logActivity('created', $jurado);
    }

    public function updated(Jurado $jurado)
    {
        $this->logActivity('updated', $jurado);
    }

    public function deleted(Jurado $jurado)
    {
        $this->logActivity('deleted', $jurado);
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
