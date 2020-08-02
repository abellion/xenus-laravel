<?php

namespace Xenus\Laravel\Tests\Support;

use Xenus\Connection;

trait SetupFailedJobsProviderTest
{
    use SetupTestsHooks, SetupApplication;

    private $setup = [
        'createApplication', 'registerConnection', 'registerQueueFailer'
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
     * Register the queue failer
     *
     * @return void
     */
    private function registerQueueFailer()
    {
        $this->container->singleton('queue.failer', function () {
            return null;
        });
    }
}
