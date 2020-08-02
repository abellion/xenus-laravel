<?php

namespace Xenus\Laravel\Tests\Tests\Bridge;

use Xenus\Laravel\Bridge\CollectionResolver;
use Xenus\Laravel\Tests\Mocks\ContainerMock;

class CollectionResolverTest extends \PHPUnit\Framework\TestCase
{
    public function test_collection_resolver_correctly_resolves_collections()
    {
        $cr = new CollectionResolver(
            $cm = new ContainerMock()
        );

        $cr->resolve(
            'some_collection'
        );

        $this->assertContains(
            'some_collection', $cm->resolved
        );
    }
}
