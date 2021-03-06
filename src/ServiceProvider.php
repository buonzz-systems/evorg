<?php namespace Buonzz\Evorg;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();

        // create the index for next month every 28th
        $this->app->booted(function () {

            $schedule = $this->app->make(Schedule::class);
            $schedule->command('evorg:create_schema')->monthlyOn(28, '1:00');

            

        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        $this->app->bind('evorg', function(){
            return new Evorg;
        });

        $this->register_commands();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/evorg.php';

        $this->publishes([$configPath => config_path('evorg.php')]);

        $this->mergeConfigFrom($configPath, 'evorg');
    }

    private function register_commands(){
        $this->app->singleton('command.buonzz.evorg.create_schema', function($app) {
            return new \Buonzz\Evorg\Commands\CreateSchema();
        });
        $this->commands('command.buonzz.evorg.create_schema');

       $this->app->singleton('command.buonzz.evorg.reset', function($app) {
            return new \Buonzz\Evorg\Commands\ResetCommand();
        });
        $this->commands('command.buonzz.evorg.reset');

    }
}
