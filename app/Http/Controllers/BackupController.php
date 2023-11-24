<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function createBackup()
{
    $existingPath = getenv("PATH");

    // Ruta al directorio que contiene mysqldump
    $mysqldumpPath = "/opt/homebrew/bin/mysqldump";
    
    // Agrega la ruta de mysqldump al principio de la variable de entorno PATH
    putenv("PATH=$mysqldumpPath:$existingPath");
    
    // Luego, puedes ejecutar el comando de respaldo
    Artisan::call('backup:run');
    
    // Restaura la variable de entorno PATH a su valor original si es necesario
    putenv("PATH=$existingPath");
  
    $filename = now()->format('Y-m-d-H-i-s') . '.zip';
    $path = storage_path("app/backup/{$filename}");
    dd($path);
    return redirect()->route('backup.download', ['filename' => $filename]);
}

public function downloadBackup($filename)
{
    $path = storage_path("app/backup/{$filename}");
    
    // Verificar la ruta del archivo
    dd($path);

    return response()->download($path);
}

}
