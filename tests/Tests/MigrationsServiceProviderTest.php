<?php

namespace Xenus\Laravel\Tests\Tests;

use Xenus\Laravel\MigrationsServiceProvider;
use Xenus\Laravel\Bridge\Migrations as MigrationsRepository;
use Xenus\Laravel\Tests\Support\SetupMigrationsProviderTest;

class MigrationsServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupMigrationsProviderTest;

    public function test_migrations_repository_is_correctly_registered()
    {
        (new MigrationsServiceProvider($this->container))->register();

        $this->assertInstanceOf(
            MigrationsRepository::class, $this->container->get('migration.repository')
        );
    }
}
