<?php

namespace Xenus\Laravel\Tests\Tests;

use Xenus\Laravel\ConnectionServiceProvider;
use Xenus\Laravel\Tests\Support\SetupConnectionTest;

use Xenus\Connection;

class ConnectionServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupConnectionTest;

    public function test_connection_is_correctly_registered()
    {
        $this->container->config->set('xenus.connection', [
            'host' => 'mongodb://xxx', 'database' => 'xxx'
        ]);

        (new ConnectionServiceProvider($this->container))->register();

        $this->assertTrue(
            $this->container->has(Connection::class)
        );
    }
}
