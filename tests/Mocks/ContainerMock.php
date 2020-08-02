<?php

namespace Xenus\Laravel\Tests\Mocks;

use Illuminate\Container\Container;

class ContainerMock extends Container
{
    public $resolved = [];

    /**
     * Resolve the given type
     *
     * @param  mixed  $abstract
     * @param  array  $parameters
     *
     * @return void
     */
    public function make($abstract, array $parameters = [])
    {
        $this->resolved[] = $abstract;
    }
}
