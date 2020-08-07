<?php

namespace Tests;

use App\User;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    protected $user;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function signIn($user = null)
    {
        if(!$user) {
            $user = factory(User::class)->create();
        }
        $this->user = $user;
        $this->actingAs($this->user);

        return $this;
    }
}
