<?php

namespace Xenus\Laravel\Tests\Tests;

use Xenus\Laravel\ConnectionServiceProvider;
use Xenus\Laravel\Tests\Support\SetupConnectionProviderTest;

use Xenus\Connection;

class ConnectionServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupConnectionProviderTest;

    public function test_connection_is_correctly_registered()
    {
        $this->container->config->set('database.connections.mongodb', [
            'host' => 'mongodb://xxx', 'database' => 'xxx'
        ]);

        (new ConnectionServiceProvider($this->container))->register();

        $this->assertTrue(
            $this->container->has(Connection::class)
        );
    }
}
