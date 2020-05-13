<?php

namespace Milestone\Sdds;

use Illuminate\Support\ServiceProvider;

class SDDSServiceProvider extends ServiceProvider
{

    private static $root = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(app()->runningInConsole()){
            $this->publishConfig();
            $this->loadMigrations();
        } else {
            $this->loadViews();
            $this->loadRoutes();
        }
    }


    private static function getRoot($folder = null,$file = null){
        $path = ($folder ? ("$folder" . DIRECTORY_SEPARATOR) : "") . ($file ? "$file" : '');
        return self::$root . $path;
    }
    private function publishConfig(){ $this->publishes([self::getRoot('config','sdds.php') => config_path('/')]); }
    private function loadMigrations(){ $this->loadMigrationsFrom(self::getRoot('migrations')); }
    private function loadViews(){ $this->loadViewsFrom(self::getRoot('views'), 'SDDS'); }
    private function loadRoutes(){ $this->loadRoutesFrom(self::getRoot('routes','web.php')); }
}
