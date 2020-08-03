<?php

namespace Xenus\Laravel\Tests\Support;

use Illuminate\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcherContract;

trait SetupCollectionsProviderTest
{
    use SetupTestsHooks, SetupApplication;

    private $setup = [
        'createApplication', 'registerEventDispatcher', 'registerContainer'
    ];

    /**
     * Register the event dispatcher
     *
     * @return void
     */
    private function registerEventDispatcher()
    {
        $this->container->instance(EventDispatcherContract::class, new EventDispatcher());
    }

    /**
     * Register the container
     *
     * @return void
     */
    private function registerContainer()
    {
        $this->container->instance(ContainerContract::class, $this->container);
    }
}
