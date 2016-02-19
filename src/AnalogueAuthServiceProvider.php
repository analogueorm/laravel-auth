<?php namespace Analogue\LaravelAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Hashing\Hasher;

class AnalogueAuthServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        //	
        //dd($this->app['auth']);
        $this->app['auth']->provider('analogue', function ($app, $config) {
            return new AnalogueUserProvider(
                $app[Hasher::class],
                $app['analogue'],
                $config['model']
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
