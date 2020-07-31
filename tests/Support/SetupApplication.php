<?php

namespace Xenus\Laravel\Tests\Support;

use Illuminate\Container\Container;
use Illuminate\Config\Repository as Config;

use Illuminate\Contracts\Config\Repository as ConfigContract;

trait SetupApplication
{
    private $container;

    /**
     * Create the container
     *
     * @return void
     */
    private function createApplication()
    {
        $this->container = new Container();

        $this->container->instance(
            'config', new Config()
        );

        $this->container->alias(
            'config', ConfigContract::class
        );
    }
}
