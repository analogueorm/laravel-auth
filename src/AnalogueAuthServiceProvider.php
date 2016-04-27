<?php namespace Analogue\LaravelAuth;

use Auth;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\ServiceProvider;

class AnalogueAuthServiceProvider extends ServiceProvider
{

    /**
     * Tell the AuthManager that we provide an 'analogue' provider.
     */
    public function boot()
    {
        Auth::provider('analogue', function ($app, $config) {
            return new AnalogueUserProvider($app[Hasher::class], $app['analogue'], $config['model']);
        });
    }


    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
