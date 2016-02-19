<?php

use Analogue\LaravelAuth\User;

class AuthTest extends TestCase 
{
    /** @test */
    public function it_can_create_and_loggin_a_user()
    {
        $auth = $this->app['auth'];

        $user = new User;
        $user->name='analogue';
        $user->email='analogue@test.com';
        $user->password=bcrypt('analogue');

        $this->app['analogue']->mapper($user)->store($user);
        
        $this->assertNotNull($user->id);

        $auth->attempt(['email' =>'analogue@test.com', 'password' => 'analogue']);

        $loggedUser = $auth->user();

        $this->assertInstanceOf(User::class, $loggedUser);
    }
}
