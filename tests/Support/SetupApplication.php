<?php

namespace Xenus\Laravel\Tests\Support;

use Illuminate\Container\Container;
use Illuminate\Config\Repository as Config;

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
    }
}
