<?php

namespace Xenus\Laravel\Bridge;

use Illuminate\Contracts\Container\Container;

use Xenus\CollectionResolver as CollectionResolverContract;

class CollectionResolver implements CollectionResolverContract
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Resolve the given collection
     *
     * @param  string $collection
     *
     * @return Xenus\Collection
     */
    public function resolve(string $collection)
    {
        return $this->container->make($collection);
    }
}
