<?php

namespace Xenus\Laravel\Tests\Stubs;

use Xenus\Connection;
use Xenus\Collection;

class DummyCollection extends Collection
{
    public function __construct()
    {
        parent::__construct(
            new Connection('mongodb://xxx', 'xxx'), ['name' => 'xxx']
        );
    }

    /**
     * Get the event dispatcher
     *
     * @return object
     */
    public function getEventDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * Get the collection resolver
     *
     * @return object
     */
    public function getCollectionResolver()
    {
        return $this->resolver;
    }
}
