<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
//use Laravel\Dusk\DuskServiceProvider;
use Carbon\Carbon;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    /*public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('es');
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));
         $zona_horaria=Carbon::now();
            $hora_zh=$zona_horaria->toTimeString();
            $hora  = date("g:i a", strtotime($hora_zh));
            $mes = $zona_horaria->formatLocalized('%B');
            $zh = Carbon::now('UTC');

       // View::composer(['layouts.partials.sidebar'],'App\Http\ViewComposers\TareasComposer');
        View::composer('views.layouts.partials.sidebar', function ($view) {
            $view->with('zona_horaria', $zona_horaria);
        });

    }*/

public function boot()
{
    $zona_horaria=Carbon::now();
    $hora_zh=$zona_horaria->toTimeString();
    $hora  = date("g:i a", strtotime($hora_zh));
    view()
    ->share('zona_horaria', $zona_horaria);

}
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
        if ($this->app->environment('local', 'testing')) {
         //   $this->app->register(DuskServiceProvider::class);
        }

    }
}
