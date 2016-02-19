<?php

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use InteractsWithDatabase;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('database.default', 'sqlite');
        $this->app['config']->set('database.connections.sqlite.database', ':memory:');

        $provider = [
            'driver' => 'analogue',
            'model' => Analogue\LaravelAuth\User::class,
        ];

        $this->app['config']->set('auth.providers.analogue', $provider);
        $this->app['config']->set('auth.guards.web.provider', "analogue");
        $this->app['config']->set('auth.guards.api.provider', "analogue");
        
        $this->artisan('migrate');
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(\Analogue\ORM\AnalogueServiceProvider::class);
        $app->register(\Analogue\LaravelAuth\AnalogueAuthServiceProvider::class);

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /** @test */
    public function it_can_bootstrap()
    {
        $this->assertInstanceof(Illuminate\Foundation\Application::class, $this->app);
    }
}
