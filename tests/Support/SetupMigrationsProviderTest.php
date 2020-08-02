<?php

namespace Xenus\Laravel\Tests\Support;

use Xenus\Connection;

trait SetupMigrationsProviderTest
{
    use SetupTestsHooks, SetupApplication;

    private $setup = [
        'createApplication', 'registerConnection', 'registerMigrationsRepository'
    ];

    /**
     * Register the Xenus connection in the container
     *
     * @return void
     */
    private function registerConnection()
    {
        $this->container->singleton(Connection::class, function () {
            return new Connection(getenv('MONGODB_URI'), getenv('MONGODB_DATABASE'));
        });
    }

    /**
     * Register the migrations repository
     *
     * @return void
     */
    private function registerMigrationsRepository()
    {
        $this->container->singleton('migration.repository', function () {
            return null;
        });
    }
}
