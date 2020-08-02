<?php

namespace Xenus\Laravel\Support;

use Illuminate\Contracts\Container\Container;

use Xenus\Collection;

class CollectionExtender
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Extend the given collection by adding the laravel bridges
     *
     * @param  Collection $collection
     *
     * @return Collection
     */
    public function extend(Collection $collection)
    {
        foreach (['EventDispatcher', 'CollectionResolver'] as $bridge) {
            $collection->{'set' . $bridge}(
                $this->container->make('Xenus\\Laravel\\Bridge\\' . $bridge)
            );
        }

        return $collection;
    }
}
