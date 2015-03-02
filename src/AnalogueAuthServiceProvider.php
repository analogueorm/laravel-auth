<?php namespace Analogue\LaravelAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\AuthManager;

class AnalogueAuthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->app[AuthManager::class]->extend('analogue', function ($app) {
			
			return new AnalogueUserProvider(
				$app['Illuminate\Contracts\Hashing\Hasher'],
				$app['config']['auth.model']
			);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
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
