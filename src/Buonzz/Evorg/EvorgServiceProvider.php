<?php namespace Buonzz\Evorg;

use Illuminate\Support\ServiceProvider;

class EvorgServiceProvider extends ServiceProvider {

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
	public function boot()
	{
		$this->package('buonzz/evorg');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('evorg', function(){
			return new Evorg;
		});
		$this->app['config']->package('buonzz/evorg', __DIR__.'/../../../../../config');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
