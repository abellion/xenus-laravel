<?php

namespace Xenus\Laravel\Tests\Mocks;

use Xenus\Collection;

class CollectionMock extends Collection
{
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
