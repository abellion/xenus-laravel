<?php

namespace Xenus\Laravel\Tests\Tests\Support;

use ReflectionProperty;

use Xenus\Laravel\Support\CollectionExtender;
use Xenus\Laravel\Tests\Support\SetupCollectionExtenderTest;

class CollectionExtenderTest extends \PHPUnit\Framework\TestCase
{
    use SetupCollectionExtenderTest;

    public function test_a_collection_is_correctly_extended()
    {
        $ce = new CollectionExtender($this->container);

        $ce->extend(
            $this->collection
        );

        $this->assertNotNull(
            $this->collection->getEventDispatcher()
        );

        $this->assertNotNull(
            $this->collection->getCollectionResolver()
        );
    }
}
