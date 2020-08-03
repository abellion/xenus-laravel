<?php

namespace Xenus\Laravel\Tests\Support;

use Xenus\Laravel\Tests\Stubs\DummyCollection;

use Illuminate\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcherContract;

trait SetupCollectionExtenderTest
{
    use SetupTestsHooks, SetupApplication;

    private $setup = [
        'createApplication', 'registerEventDispatcher', 'registerContainer', 'createCollection'
    ];

    private $collection;

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

    /**
     * Create a collection
     *
     * @return void
     */
    private function createCollection()
    {
        $this->collection = new DummyCollection();
    }
}
