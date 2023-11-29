<?php

namespace App\Providers;

use App\Models\Comite;
use App\Models\Comunicado;
use App\Models\Documentacion;
use App\Models\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\Eleccion;
use App\Models\Frente;
use App\Models\Jurado;
use App\Models\Mesa;
use App\Models\Votante;
use App\Observers\EleccionObserver;
use App\Observers\ComunicadoObserver;
use App\Observers\ComiteObserver;
use App\Observers\DocumentacionObserver;
use App\Observers\FrenteObserver;
use App\Observers\JuradoObserver;
use App\Observers\MesaObserver;
use App\Observers\VotanteObserver;
use App\Observers\LogObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Log::observe(LogObserver::class);
        Eleccion::observe(EleccionObserver::class);
        Comunicado::observe(ComunicadoObserver::class);
        Comite::observe(ComiteObserver::class);
        Documentacion::observe(DocumentacionObserver::class);
        Frente::observe(FrenteObserver::class);
        Jurado::observe(JuradoObserver::class);
        Mesa::observe(MesaObserver::class);
        Votante::observe(VotanteObserver::class);
        Schema::defaultStringLength(191);

        // Repite esto para los demás modelos y observadores
    }
}
