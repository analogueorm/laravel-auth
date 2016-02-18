<?php namespace Analogue\LaravelAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\AuthManager;

class AnalogueAuthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	public function boot()
	{
		//	
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app[AuthManager::class]->provider('analogue', function($app, $config) {
			return new AnalogueUserProvider(
				$app['Illuminate\Contracts\Hashing\Hasher'],
				$app['analogue'],
				$config['model']
			);
		});
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
