<?php

namespace Xenus\Laravel\Tests\Tests;

use Xenus\Laravel\CollectionsServiceProvider;
use Xenus\Laravel\Tests\Stubs\DummyCollection;
use Xenus\Laravel\Tests\Support\SetupCollectionsProviderTest;

class CollectionsServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use SetupCollectionsProviderTest;

    public function test_collections_are_correctly_registered()
    {
        (new CollectionsServiceProvider($this->container))->setCollections([DummyCollection::class])->register();

        $this->assertNotNull(
            $this->container->make(DummyCollection::class)->getEventDispatcher()
        );

        $this->assertNotNull(
            $this->container->make(DummyCollection::class)->getCollectionResolver()
        );
    }
}
